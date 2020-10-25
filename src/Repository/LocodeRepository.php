<?php

namespace App\Repository;

use App\Entity\Locode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Locode|null find($id, $lockMode = null, $lockVersion = null)
 * @method Locode|null findOneBy(array $criteria, array $orderBy = null)
 * @method Locode[]    findAll()
 * @method Locode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocodeRepository extends ServiceEntityRepository
{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManagerInterface $em, ManagerRegistry $registry)
    {
        $this->em = $em;

        parent::__construct($registry, Locode::class);
    }

    public function findByCode($code) {
        return $this->createQueryBuilder('l')
            ->where('l.Country = :val1')
            ->orWhere('l.Location = :val2')
            ->setParameters(['val1' => $code, 'val2' => $code])
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(100)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByNameWoDiacritics($nameWoDiacritics) {
        return $this->createQueryBuilder('l')
            ->where('l.NameWoDiacritics LIKE :val1')
            ->setParameters(['val1' => '%' . $nameWoDiacritics . '%'])
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(100)
            ->getQuery()
            ->getResult()
            ;
    }

    public function clearDb() {
        $cmd = $this->em->getClassMetadata(Locode::class);
        $connection = $this->em->getConnection();
        $statement = $connection->prepare("TRUNCATE " . $cmd->getTableName());
        $statement->execute();
    }

    // /**
    //  * @return Locode[] Returns an array of Locode objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Locode
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
