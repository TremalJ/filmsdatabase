<?php

namespace App\Repository;

use App\Entity\Film;
use App\Repository\ClassMetadata;
use App\Repository\Exception;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Film|null find($id, $lockMode = null, $lockVersion = null)
 * @method Film|null findOneBy(array $criteria, array $orderBy = null)
 * @method Film[]    findAll()
 * @method Film[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilmRepository extends ServiceEntityRepository
{
    /** @var ClassMetadata */
    private $c;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Film::class);
        $this->c = $this->getEntityManager()->getClassMetadata(Film::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Film $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function createFilm(array $film): string
    {
        foreach ($film as $key => $c) {
            if (!$this->c->hasField($key)) {
                unset($film[$key]);
            }
        }

        try {
            $film['id'] = $this->getFilmLastId()[1]+1;
            $id = $this->getEntityManager()->getConnection()
                ->insert('film', $film);
        } catch (Exception $e) {
            echo 'Error [createFilm]: '.$e->getMessage()."\n";
        }

        return $this->getFilmLastId()[1];
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function getFilmLastId(): array
    {
        $queryBuilder = $this->createQueryBuilder('f');
        $queryBuilder->select('max(f.id)');

        return $queryBuilder->getQuery()->getSingleResult();
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Film $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

}
