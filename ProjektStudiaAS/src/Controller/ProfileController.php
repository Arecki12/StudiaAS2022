<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use App\Repository\ProductPriceRepository;
use App\Repository\TransactionRepository;
use App\Repository\UserRepository;
use App\Service\DefaultService;
use App\Service\Room\ProductService;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class ProfileController extends DefaultController
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
     */
    public function __construct(
        DefaultService    $defaultService,
        LoggerInterface   $loggerInterface,
        OrderRepository   $orderRepository,
        Security          $security,
        TransactionRepository $transactionRepository,
    )
    {
        $this->defaultService = $defaultService;
        $this->loggerInterface = $loggerInterface;
        $this->orderRepository = $orderRepository;
        $this->transactionRepository = $transactionRepository;
        $this->security = $security;
        parent::__construct($defaultService, $loggerInterface, $security);
    }


    #[Route('/profile', name:'profile_index')]
    public function index(): Response
    {
        if ($this->getUser()) {
            $user = $this->getUser();
            $orders = $this->orderRepository->findBy(['user' => $this->getUser()]);
            foreach ($orders as $order) {
                $transactions[] = $this->transactionRepository->findOneBy(['order' => $order]);
            }

            return $this->render('home/profile.html.twig', [
                'orders' => $orders,
                'transactions' => $transactions ?? [],
            ]);
        } else {
            return $this->redirectToRoute('app_login', [], 301);
        }
    }

}
