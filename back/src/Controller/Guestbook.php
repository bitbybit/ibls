<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use App\Entity;
use App\Repository;

class Guestbook
{

    /** @var EntityManager  */
    protected $em;

    /** @var Repository\Ibls\GuestbookRepository */
    private $repository;

    /** @var Request */
    private $request;

    /**
     * Guestbook constructor.
     * @param RequestStack $request_stack
     * @param EntityManager $em_ibls
     */
    public function __construct(
        RequestStack $request_stack,
        EntityManager $em_ibls
    )
    {
        $this->request = $request_stack->getCurrentRequest();
        $this->em = $em_ibls;
        $this->repository = $em_ibls->getRepository(Entity\Ibls\Guestbook::class);
    }

    /**
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        $limit = $this->request->query->get('limit');
        $offset = $this->request->query->get('offset');

        if (null === $limit || null === $offset) {
            throw new BadRequestHttpException;
        }

        return new JsonResponse([
            'messages' => $this->repository->getMessages(
                (int)$limit,
                (int)$offset
            ),
            'count' => $this->repository->getCount(),
        ], 200, [
            'Access-Control-Allow-Origin' => '*',
        ]);
    }

    /**
     * @return JsonResponse
     * @throws \Exception
     */
    public function add(): JsonResponse
    {
        $name = $this->request->request->get('name');
        $email = $this->request->request->get('email');
        $text = $this->request->request->get('message');

        try {
            $message = new Entity\Ibls\Guestbook;

            $message
                ->setName($name)
                ->setEmail($email)
                ->setMessage($text)
            ;

            $this->em->persist($message);
            $this->em->flush();

            return new JsonResponse([
                'result' => 'ok',
            ],200, [
                'Access-Control-Allow-Origin' => '*',
            ]);
        } catch(ORMException $e) {

            return new JsonResponse([
                'result' => 'error',
            ],200, [
                'Access-Control-Allow-Origin' => '*',
            ]);

        }
    }

}
