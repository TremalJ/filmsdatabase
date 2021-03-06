<?php

namespace App\Repository;

use App\Entity\Actor;
use App\Repository\Exception;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Actor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Actor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Actor[]    findAll()
 * @method Actor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Actor::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Actor $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Actor $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function createActors(int $film_id, string $name): string
    {
        try {
            //Insert Actor:
            $this->getEntityManager()
                ->getConnection()
                ->insert('actor' , [
                    'id' => is_null($this->getActorLastId()[1]) ? 1 : $this->getActorLastId()[1]+1,
                    'name' => $name,
                ])
            ;
            //Insert relation Actor-Film:
            $this->getEntityManager()->getConnection()
                ->insert('actor_film', [
                    'actor_id' => $this->getActorLastId()[1],
                    'film_id' => $film_id,
                ]);
        } catch (Exception $e) {
            echo 'Error [createActor]: '.$e->getMessage()."\n";
        }

        return "New actor ".$this->getActorLastId()[1]."added!";
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function getActorLastId(): array
    {
        $queryBuilder = $this->createQueryBuilder('a');
        $queryBuilder->select('max(a.id)');

        return $queryBuilder->getQuery()->getSingleResult();
    }
}
