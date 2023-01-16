<?php

namespace App\Service\Room;

use App\Entity\Product;
use App\Repository\ProductPriceRepository;
use App\Repository\ProductRepository;
use App\Service\DatabaseService;
use App\Service\DefaultService;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Security\Core\Security;

class ProductService extends DefaultService
{

    private ProductRepository $productRepository;

    private ProductPriceRepository $productPriceRepository;

    public function __construct(
        LoggerInterface        $loggerInterface,
        DatabaseService        $databaseService,
        ParameterBagInterface  $parameterBag,
        Security               $security,
        ProductRepository      $productRepository,
        ProductPriceRepository $productPriceRepository
    )
    {
        $this->loggerInterface = $loggerInterface;
        $this->databaseService = $databaseService;
        $this->parameterBag = $parameterBag;
        $this->security = $security;
        $this->productRepository = $productRepository;
        $this->productPriceRepository = $productPriceRepository;
    }

    public function getAvailableRooms(): array
    {
        return $this->productRepository->findAll();
    }

    public function getProduct($id): ?array
    {
        $product = $this->productRepository->find($id);
        $productPrices = $this->productPriceRepository->findBy(['product' => $product]);

        return [
            'product' => $product,
            'productPrices' => $productPrices
        ];
    }
}
