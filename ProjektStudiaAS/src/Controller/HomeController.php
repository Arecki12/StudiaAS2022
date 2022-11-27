<?php

namespace App\Controller;

use App\Service\DefaultService;
use App\Service\Room\ProductService;
use Psr\Log\LoggerInterface;
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
     * @param ProductService $productService
     */
    public function __construct(
        DefaultService    $defaultService,
        LoggerInterface   $loggerInterface,
        ProductService $productService
    )
    {
        $this->defaultService = $defaultService;
        $this->loggerInterface = $loggerInterface;
        $this->productService = $productService;
    }


    #[Route('/', name:'home_index')]
    public function index(): Response
    {
        $availableRooms = $this->productService->getAvailableRooms();
        return $this->render('home/index.html.twig', [
            'availableRooms' => $availableRooms
        ]);
    }

    #[Route('/show/{id}', name:'home_show_product')]
    public function show($id): Response
    {
        $room = $this->productService->getProduct($id);
        return $this->render('home/show.html.twig', [
            'room' => $room
        ]);
    }
}
