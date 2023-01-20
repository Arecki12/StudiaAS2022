<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Transaction;
use App\Repository\OrderRepository;
use App\Repository\ProductPriceRepository;
use App\Repository\ProductRepository;
use App\Repository\TransactionRepository;
use App\Service\DefaultService;
use App\Service\Room\ProductService;
use Cassandra\Date;
use DateTime;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class RoomController extends DefaultController
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
        ProductService $productService,
        ProductRepository $productRepository,
        Security          $security,
        OrderRepository $orderRepository,
        TransactionRepository $transactionRepository,
    )
    {
        $this->defaultService = $defaultService;
        $this->loggerInterface = $loggerInterface;
        $this->productService = $productService;
        $this->productRepository = $productRepository;
        $this->orderRepository = $orderRepository;
        $this->transactionRepository = $transactionRepository;
        parent::__construct($defaultService, $loggerInterface, $security);
    }


    #[Route('/show/{id}', name:'home_show_product', requirements: ['id' => '\d+'])]
    public function show($id): Response
    {
        $room = $this->productService->getProduct($id);

        return $this->render('home/show.html.twig', [
            'room' => $room,
        ]);
    }

    /**
     * @throws \Exception
     */
    #[Route('/book/{id}', name: 'book_product', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function book(Request $request, $id): Response
    {
        $product = $this->productRepository->find($id);

        $order = new Order();
        $order->setProduct($product);
        $order->setOrderHash(bin2hex(random_bytes(16)));
        $order->setStartDatetime((new DateTime($request->request->get('dateFrom'))));

        $endDate = new DateTime($request->request->get('dateFrom'));
        $endDate->add(new \DateInterval('P1D'));
        $order->setEndDatetime($endDate);
        $order->setUser($this->getUser());

        $this->orderRepository->save($order, true);

        $transaction = new Transaction();
        $transaction->setCreatedAt(new DateTime());
        $transaction->setOrder($order);
        $transaction->setAmount(2);
        $transaction->setCurrency('PLN');
        $transaction->setPaymentType("Ukryta");

        $this->transactionRepository->save($transaction, true);

        return $this->render('home/success-book.html.twig', [
            'order' => $order,
        ]);
    }

}
