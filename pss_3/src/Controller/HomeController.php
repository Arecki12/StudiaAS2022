<?php

namespace App\Controller;

use App\Repository\ProductPriceRepository;
use App\Repository\ProductRepository;
use App\Service\DefaultService;
use App\Service\Room\ProductService;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends DefaultController
{

    /**
     * @var DefaultService
     */
    protected DefaultService $defaultService;

    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $loggerInterface;

    /**
     * @var ProductService
     */
    private ProductService $productService;

    /**
     * @param DefaultService $defaultService
     * @param LoggerInterface $loggerInterface
     * @param ProductRepository $productRepository
     * @param ProductPriceRepository $productPriceRepository
     */
    public function __construct(
        DefaultService    $defaultService,
        LoggerInterface   $loggerInterface,
        ProductRepository $productRepository,
        ProductPriceRepository $productPriceRepository
    )
    {
        $this->defaultService = $defaultService;
        $this->loggerInterface = $loggerInterface;
        $this->productRepository = $productRepository;
        $this->productPriceRepository = $productPriceRepository;
    }


    #[Route('/', name:'home_index')]
    #[Route('/{page}', name:'home_index_paginated', requirements: ['page' => '\d+',])]
    public function index(?int $page): Response
    {
        $page = max($page, 1);
        $limit = 6;
        $products = $this->productRepository->getProductsList($page, $limit);
        $pages = ceil(count($this->productRepository->findAll()) / $limit);

        return $this->render('home/index.html.twig', [
            'currentPage' => $page,
            'availableRooms' => $products,
            'pages' => $pages
        ]);

    }

}
