<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use App\REST;

class Guestbook
{

    /** @var Request */
    private $request;

    /** @var REST */
    protected $REST;

    /**
     * Guestbook constructor.
     * @param RequestStack $request_stack
     * @param REST $REST
     */
    public function __construct(
        RequestStack $request_stack,
        REST $REST
    )
    {
        $this->request = $request_stack->getCurrentRequest();
        $this->REST = $REST;
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

        return $this->REST->listMessages((int)$limit, (int)$offset);
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

        return $this->REST->addMessage($name, $email, $text);
    }

}
