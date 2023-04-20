<?php

namespace App\Repository;

use App\Entity\Produit;
<<<<<<< HEAD
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
=======
use App\Form\ProduitCriteria;
use Doctrine\Persistence\ManagerRegistry;
use Ttskch\PaginatorBundle\Doctrine\Slicer;
use Ttskch\PaginatorBundle\Doctrine\Counter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
>>>>>>> 38fcca06cc387d979196fcb40902c48b781a6505

/**
 * @extends ServiceEntityRepository<Produit>
 *
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }

    public function save(Produit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Produit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
<<<<<<< HEAD

=======
    public function sliceByCriteria(ProduitCriteria $criteria)
    {
        $qb = $this->createQueryBuilderFromCriteria($criteria);
        $slicer = new Slicer($qb);

        return $slicer($criteria);
    }

    public function countByCriteria(ProduitCriteria $criteria)
    {
        $qb = $this->createQueryBuilderFromCriteria($criteria);
        $counter = new Counter($qb);

        return $counter($criteria);
    }

    private function createQueryBuilderFromCriteria(ProduitCriteria $criteria)
    {
        return $this->createQueryBuilder('f')
            ->orWhere('f.nom like :query')
            ->orWhere('f.description like :query')
            ->setParameter('query', '%' . str_replace('%', '\%', $criteria->query) . '%');
    }
>>>>>>> 38fcca06cc387d979196fcb40902c48b781a6505
    //    /**
    //     * @return Produit[] Returns an array of Produit objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Produit
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
