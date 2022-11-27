<?php

namespace App\Service;

use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Security\Core\Security;

class UploadService extends DefaultService
{
   public function __construct(LoggerInterface $loggerInterface, DatabaseService $databaseService, ParameterBagInterface $parameterBag, Security $security, ProductRepository $roomRepository)
   {
       $this->loggerInterface = $loggerInterface;
       $this->databaseService = $databaseService;
       $this->parameterBag = $parameterBag;
       $this->security = $security;
       $this->roomRepository = $roomRepository;
   }

   public function uploadImageForRoom($image, $room) {
        $room = $this->roomRepository->find($room);
   }

    /**
     * @throws Exception
     */
    public function uploadImage(string $image, string $path): string
   {
       $image = str_replace('data:image/png;base64,', '', $image);
       $image = str_replace(' ', '+', $image);
       $data = base64_decode($image);
       $file = $path . uniqid() . '.png';
       $success = file_put_contents($file, $data);

       if (!$success) {
           throw new Exception('Unable to save the file.');
       }

       return $file;
   }
}