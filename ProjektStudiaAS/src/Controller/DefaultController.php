<?php

namespace App\Controller;

use App\Service\DefaultService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
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
     * @param DefaultService $defaultService
     * @param LoggerInterface $loggerInterface
     */
    public function __construct(
        DefaultService    $defaultService,
        LoggerInterface   $loggerInterface
    )
    {
        $this->defaultService = $defaultService;
        $this->loggerInterface = $loggerInterface;
    }
}
