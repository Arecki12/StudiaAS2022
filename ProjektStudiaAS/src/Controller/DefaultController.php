<?php

namespace App\Controller;

use App\Service\DefaultService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

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

    private Security $security;

    /**
     * @param DefaultService $defaultService
     * @param LoggerInterface $loggerInterface
     */
    public function __construct(
        DefaultService    $defaultService,
        LoggerInterface   $loggerInterface,
        Security $security
    )
    {
        $this->defaultService = $defaultService;
        $this->loggerInterface = $loggerInterface;
        $this->security = $security;
    }

    public function getUser(): ?UserInterface
    {
        return $this->security->getUser();
    }
}
