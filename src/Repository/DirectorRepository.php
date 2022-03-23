<?php

namespace App\Repository;

use App\Entity\Director;
use App\Repository\Exception;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Director|null find($id, $lockMode = null, $lockVersion = null)
 * @method Director|null findOneBy(array $criteria, array $orderBy = null)
 * @method Director[]    findAll()
 * @method Director[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DirectorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Director::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Director $entity, bool $flush = true): void
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
    public function remove(Director $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function createDirectors(int $film_id, string $name): string
    {
        try {
            //Insert Director:
            $this->getEntityManager()
                ->getConnection()
                ->insert('director' , [
                    'id' => is_null($this->getDirectorLastId()[1]) ? 1 : $this->getDirectorLastId()[1]+1,
                    'name' => $name,
                ])
            ;
            //Insert relation Director-Film:
            $this->getEntityManager()->getConnection()
                ->insert('director_film', [
                    'director_id' => $this->getDirectorLastId()[1],
                    'film_id' => $film_id,
            ]);
        } catch (Exception $e) {
            echo 'Error [createDirector]: '.$e->getMessage()."\n";
        }

        return "New director ".$this->getDirectorLastId()[1]."added!";
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function getDirectorLastId(): array
    {
        $queryBuilder = $this->createQueryBuilder('d');
        $queryBuilder->select('max(d.id)');

        return $queryBuilder->getQuery()->getSingleResult();
    }
}
