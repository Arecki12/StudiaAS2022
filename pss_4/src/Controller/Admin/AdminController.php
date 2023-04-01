<?php

namespace App\Controller\Admin;

use App\Controller\DefaultController;
use App\Repository\ProductPriceRepository;
use App\Repository\ProductRepository;
use App\Repository\ProductTypeRepository;
use App\Repository\UserRepository;
use App\Service\DefaultService;
use JetBrains\PhpStorm\Pure;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class AdminController extends DefaultController
{
    /**
     * @var DefaultService
     */
    protected DefaultService $defaultService;

    public function __construct(
        DefaultService         $defaultService,
        LoggerInterface        $loggerInterface,
        Security               $security,
        UserRepository         $usersRepository,
        ProductRepository      $productRepository,
        ProductPriceRepository $productPriceRepository,
        ProductTypeRepository  $productTypeRepository
    )
    {
        $this->defaultService = $defaultService;
        $this->loggerInterface = $loggerInterface;
        $this->security = $security;
        $this->usersRepository = $usersRepository;
        $this->productRepository = $productRepository;
        $this->productPriceRepository = $productPriceRepository;
        $this->productTypeRepository = $productTypeRepository;
        parent::__construct($defaultService, $loggerInterface, $security);
    }

    /**
     * @return Response
     */
    #[Route('/admin', name: 'admin_dashboard_index')]
    public function dashboard(): Response
    {
        if (!$this->getUser() || !in_array('ROLE_ADMIN', $this->getUser()->getRoles())) {
            return $this->json([
                'message' => 'Access denied',
                'code' => 403
            ], 403);
        }

        $users = $this->usersRepository->findAll();
        $products = $this->productRepository->findAll();

        return $this->render('admin/index.html.twig', [
            'users' => $users,
            'products' => $products,
        ]);
    }

    #[Route('/edit-user/{id}', name: 'admin_edit_user_index', requirements: ['id' => '\d+'])]
    public function editUser(Request $request, int $id): Response
    {
        if (!$this->getUser() || !in_array('ROLE_ADMIN', $this->getUser()->getRoles())) {
            return $this->json([
                'message' => 'Access denied',
                'code' => 403
            ], 403);
        }
        $user = $this->usersRepository->find($id);
        if ($request->isMethod('POST')) {
            $user->setEditedBy($this->getUser()->getName());
            $user->setEmail($request->get('_email'));
            $user->setName($request->get('_username'));
            $user->setUpdatedAt(new \DateTime());
            if ($request->get('_grantAdmin') == 'on') {
                $user->setRoles(["ROLE_USER", "ROLE_ADMIN"]);
            } else {
                $user->setRoles(["ROLE_USER"]);
            }
            $this->usersRepository->save($user, true);
            return $this->redirectToRoute('admin_dashboard_index');
        }
        return $this->render('admin/edit.html.twig', [
            'user' => $user
        ]);
    }

    #[Route('/edit-room/{id}', name: 'admin_edit_room_index', requirements: ['id' => '\d+'])]
    public function editRoom(Request $request, int $id): Response
    {
        if (!$this->getUser() || !in_array('ROLE_ADMIN', $this->getUser()->getRoles())) {
            return $this->json([
                'message' => 'Access denied',
                'code' => 403
            ], 403);
        }
        $product = $this->productRepository->find($id);
        if ($request->isMethod('POST')) {
            $product->setDescription($request->get('_description'));
            $product->setName($request->get('_name'));
            $product->setShortDescription($request->get('_shortDescription'));
            $product->setProductType($this->productTypeRepository->find($request->get('_productType')));
            $this->productRepository->save($product, true);
            return $this->redirectToRoute('admin_dashboard_index');
        }

        return $this->render('admin/edit_room.html.twig', [
            'product' => $product,
            'productTypes' => $this->productTypeRepository->findAll(),
            'productTypeId' => $product->getProductType()->getId(),
            'productPrices' => $this->productPriceRepository->findBy(['product' => $product])
        ]);
    }


}