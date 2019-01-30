<?php

namespace SRP\Before;

class ProductQueryRepository
{
    protected $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function fetchAll(int $page, int $perPage): array
    {
        $offset = ($page - 1) * $perPage;
        $stmt = $this->pdo->prepare('SELECT * FROM `products` LIMIT :offset,:perPage');
        $stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        $products = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $products[] = $this->mapData($row);
        }
        $stmt->closeCursor();

        return $products;
    }

    private function mapData(array $row): ProductView
    {
        return new ProductView(
            $row['id'],
            $row['name'],
            (float) $row['price'],
            $row['description']
        );
    }
}

class ProductView {
    public function __construct($id, $name, $price, $description)
    {
    }
}
