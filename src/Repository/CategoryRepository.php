<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    private PaginatorInterface $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Category::class);
        $this->paginator = $paginator;
    }

    public function getFiveFirstCategory(): QueryBuilder
    {
        return $this->createQueryBuilder('c')
            ->andWhere("c.is_parent_category = true");
    }

    public function search(string $name): array
    {
        return $this->createQueryBuilder("c")
            ->where("c.name LIKE :name")
            ->select("c.name", "c.id")
            ->setParameter(':name', "%$name%")
            ->getQuery()
            ->getResult();
    }

    /**
     * Récupere les produits en lien avec une recherche
     * @param SearchData $search
     * @return PaginationInterface
     */
    public function findSearch(SearchData $search): PaginationInterface
    {
        $query = $this->getSearchQuery($search)->getQuery();
        return $this->paginator->paginate(
            $query,
            $search->page,
            8
        );
    }

    private function getSearchQuery(SearchData $search): QueryBuilder
    {
        $query = $this
            ->createQueryBuilder("p")
            ->select("c", "p")
            ->join("p.categories", "c");

        if (!empty($search->q)) {
            $query = $query
                ->andWhere("p.name LIKE :q")
                ->setParameter("q", "%{$search->q}%");
        }

        if (!empty($search->min)) {
            $query = $query
                ->andWhere("p.price >= :min")
                ->setParameter("min", $search->min);
        }

        if (!empty($search->max)) {
            $query = $query
                ->andWhere("p.price <= :max")
                ->setParameter("max", $search->max);
        }

        if (!empty($search->promo)) {
            $query = $query
                ->andWhere("p.is_on_sale = 1");
        }

        if (!empty($search->categories)) {
            $query = $query
                ->andWhere("c.id IN (:categories)")
                ->setParameter("categories", $search->categories);
        }

        return $query;
    }
}
