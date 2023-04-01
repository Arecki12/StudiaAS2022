<?php

namespace App\Service\Room;

use App\Entity\Product;
use App\Repository\OrderRepository;
use App\Repository\ProductPriceRepository;
use App\Repository\ProductRepository;
use App\Repository\ProductTypeRepository;
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
        ProductPriceRepository $productPriceRepository,
        ProductTypeRepository  $productTypeRepository,
        OrderRepository        $orderRepository,
    )
    {
        $this->loggerInterface = $loggerInterface;
        $this->databaseService = $databaseService;
        $this->parameterBag = $parameterBag;
        $this->security = $security;
        $this->productRepository = $productRepository;
        $this->productPriceRepository = $productPriceRepository;
        $this->productTypeRepository = $productTypeRepository;
        $this->orderRepository = $orderRepository;
    }

    public function getAvailableRooms(): array
    {
        return $this->productRepository->findAll();
    }

    public function getProduct($id): ?array
    {
        $product = $this->productRepository->find($id);
        $productType = $product->getProductType();
        $productPrices = $this->productPriceRepository->findOneBy(['product' => $product]);

        $availableRoom = $this->orderRepository->findOneBy(['product' => $product]);

        if (!empty($availableRoom)) {
            $availableRoom = $availableRoom->getEndDatetime()->format('Y-m-d');
        } else {
            $availableRoom = null;
        }
        return [
            'product' => $product,
            'productPrices' => $productPrices,
            'productType' => $productType,
            'availableFrom' => $availableRoom,
        ];
    }
}
