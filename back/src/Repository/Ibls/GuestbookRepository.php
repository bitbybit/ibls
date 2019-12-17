<?php declare(strict_types=1);

namespace App\Repository\Ibls;

use App\Entity\Ibls\Guestbook;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

class GuestbookRepository extends EntityRepository
{

    /**
     * Select messages
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getMessages(int $limit, int $offset): array
    {
        $query = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('m')
            ->from(Guestbook::class, 'm')
            ->orderBy('m.date', 'DESC')
            ->addOrderBy('m.id', 'DESC')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
        ;

        return $query->getQuery()->getArrayResult();
    }

    /**
     * Count messages
     * @return int
     */
    public function getCount(): int
    {
        $query = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('COUNT(m)')
            ->from(Guestbook::class, 'm')
        ;

        try {
            return (int)$query->getQuery()->getSingleResult(Query::HYDRATE_SINGLE_SCALAR);
        } catch(NoResultException | NonUniqueResultException $e) {
            return 0;
        }
    }

}
