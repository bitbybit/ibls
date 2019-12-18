<?php declare(strict_types=1);

namespace App;

use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity;
use App\Repository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;

class REST
{

    /** @var EntityManager  */
    protected $em;

    /** @var Repository\Ibls\GuestbookRepository */
    private $repository;

    /**
     * REST constructor.
     * @param EntityManager $em_ibls
     */
    public function __construct(
        EntityManager $em_ibls
    )
    {
        $this->em = $em_ibls;
        $this->repository = $em_ibls->getRepository(Entity\Ibls\Guestbook::class);
    }

    public function listMessages(int $limit, int $offset): JsonResponse
    {
        return new JsonResponse([
            'messages' => $this->repository->getMessages(
                $limit,
                $offset
            ),
            'count' => $this->repository->getCount(),
        ], 200, [
            'Access-Control-Allow-Origin' => '*',
        ]);
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $text
     * @return JsonResponse
     * @throws \Exception
     */
    public function addMessage(string $name, string $email, string $text): JsonResponse
    {
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
