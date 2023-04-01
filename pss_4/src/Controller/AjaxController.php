<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AjaxController extends AbstractController
{
    public function __construct(
        private ProductRepository $productRepository
    )
    {
    }

    #[Route('/ajax/search', name: 'ajax_search', methods: ['POST'])]
    public function searchProducts(Request $request): Response
    {
        $search = $request->toArray()['search'] ?? '';
        $products = $this->productRepository->searchProductsByName($search);

        return $this->render('home/products.html.twig', [
            'currentPage' => 1,
            'availableRooms' => $products
        ]);
    }

}