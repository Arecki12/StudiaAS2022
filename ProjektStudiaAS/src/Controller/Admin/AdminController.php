<?php

namespace App\Controller\Admin;

use App\Controller\DefaultController;
use App\Service\DefaultService;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends DefaultController
{
    /**
     * @var DefaultService
     */
    protected DefaultService $defaultService;

    /**
     * @param DefaultService $defaultService
     */
    #[Pure] public function __construct(DefaultService $defaultService)
    {
        $this->defaultService = $defaultService;
    }

    /**
     * @return Response
     */
    #[Route('/admin', name:'admin_dashboard_index')]
    public function dashboard(): Response
    {
        return $this->render('admin/index.html.twig');
    }


}