<?php

namespace App\Service;

use App\Entity\Statistics\CronSettings;
use App\Repository\Statistics\CronSettingsRepository;
use Doctrine\ORM\NonUniqueResultException;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class DefaultService
{

    /**
     * @param LoggerInterface $loggerInterface
     * @param DatabaseService $databaseService
     * @param ParameterBagInterface $parameterBag
     * @param Security $security
     */
    public function __construct(
        public LoggerInterface          $loggerInterface,
        public DatabaseService          $databaseService,
        protected ParameterBagInterface $parameterBag,
        protected Security              $security,
    )
    {

    }


    /**
     * @return string
     */
    public function getRootDir(): string
    {
        return $this->parameterBag->get('kernel.project_dir') . '/';
    }

    /**
     * @return string
     */
    public function getPublicDir(): string
    {
        return $this->getRootDir() . 'public/';
    }

    /**
     * @return string
     */
    public function getFileDir(): string
    {
        return $this->getRootDir() . 'uploads/files/';
    }

    /**
     * @return UserInterface|null
     */
    public function getUser(): ?UserInterface
    {
        return $this->security->getUser();
    }

    /**
     * @return int|null
     */
    public function getUserIdentifier(): ?int
    {
        $user = $this->getUser();
        if ($user instanceof UserInterface) {
            return $user->getUserIdentifier();
        }
        return null;
    }

}