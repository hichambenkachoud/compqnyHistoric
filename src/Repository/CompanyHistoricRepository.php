<?php

namespace App\Repository;

use App\Entity\CompanyHistoric;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CompanyHistoric|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyHistoric|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyHistoric[]    findAll()
 * @method CompanyHistoric[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyHistoricRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompanyHistoric::class);
    }

}
