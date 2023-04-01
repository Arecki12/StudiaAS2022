<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Psr\Log\LoggerInterface;

class DatabaseService
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param EntityManagerInterface $entityManager
     * @param LoggerInterface $logger
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        LoggerInterface        $logger
    )
    {
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    /**
     * @param $databaseRecord
     * @return bool
     */
    public function deleteRecord($databaseRecord): bool
    {
        try {
            $this->entityManager->persist($databaseRecord);
            $this->entityManager->remove($databaseRecord);
            $this->entityManager->flush();
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            return false;
        }

        return true;
    }

    /**
     * @param $databaseRecord
     * @return bool
     */
    public function saveRecord($databaseRecord): bool
    {
        try {
            $this->entityManager->persist($databaseRecord);
            $this->entityManager->flush();
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            return false;
        }

        return $databaseRecord->getId();
    }
}