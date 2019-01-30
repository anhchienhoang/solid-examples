<?php

namespace SRP\After;

class ProductQueryRepository
{
    protected $pdo;

    protected $productViewMapper;

    public function __construct(\PDO $pdo, ProductViewMapper $productViewMapper)
    {
        $this->pdo = $pdo;
        $this->productViewMapper = $productViewMapper;
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
            $products[] = $this->productViewMapper->map($row);
        }
        $stmt->closeCursor();

        return $products;
    }
}

class ProductViewMapper {
    /**
     * @var string
     */
    private $publicDir;
    /**
     * @var string
     */
    private $imageDir;
    /**
     * @var string
     */
    private $noImage;
    /**
     * @var Filesystem
     */
    private $filesystem;
    /**
     * @param string     $publicDir
     * @param string     $imageDir
     * @param string     $noImage
     * @param Filesystem $filesystem
     */
    public function __construct(string $publicDir, string $imageDir, string $noImage, Filesystem $filesystem)
    {
        $this->publicDir = $publicDir;
        $this->imageDir = $imageDir;
        $this->noImage = $noImage;
        $this->filesystem = $filesystem;
    }

    public function map(array $data): ProductView
    {
        $images = null !== $data['images'] ? json_decode($data['images']) : [];
        $defaultImage = $this->noImage;
        if (count($images) > 0) {
            array_walk($images, function ($item) {
                $thumbnail = 'thumb_'.$item->image;
                if ($this->filesystem->exists($this->publicDir.'/'.$this->imageDir.'/'.$thumbnail)) {
                    $image = $thumbnail;
                } else {
                    $image = $item->image;
                }
                $item->origin = $this->imageDir.'/'.$item->image;
                $item->image = $this->imageDir.'/'.$image;
            });
            $firstImage = $images[0];
            $defaultImage = $firstImage->image;
        }

        return new ProductView(
            $data['id'],
            $data['name'],
            $data['price'],
            $data['description'],
            $images,
            $defaultImage
        );
    }
}

class ProductView {
    public function __construct($id, $name, $price, $description, $images, $defaultImage)
    {
    }
}
