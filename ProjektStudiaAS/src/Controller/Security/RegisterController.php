<?php

namespace App\Controller\Security;

use App\Controller\DefaultController;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\DatabaseService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends DefaultController
{
    /**
     * @var UserPasswordHasherInterface
     */
    private UserPasswordHasherInterface $passwordHasher;

    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * @var DatabaseService
     */
    private DatabaseService $databaseService;

    /**
     * @param UserPasswordHasherInterface $passwordHasher
     * @param UserRepository $userRepository
     * @param DatabaseService $databaseService
     */
    public function __construct(
        UserPasswordHasherInterface $passwordHasher,
        UserRepository $userRepository,
        DatabaseService $databaseService
    ){
        $this->passwordHasher = $passwordHasher;
        $this->userRepository = $userRepository;
        $this->databaseService = $databaseService;
    }

    /**
     * @param Request $request
     * @return Response
     */
    #[Route('/register', name: 'app_register', methods: ['GET', 'POST'])]
    public function index(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $user = new User();
            $user->setName($request->request->get('_username'));
            $user->setEmail($request->request->get('_email'));
            $user->setRoles(['ROLE_USER']);

            if ($this->userRepository->findOneBy(['name' => $user->getName()])) {
                $this->addFlash('error', 'Username already exist');
                return $this->redirectToRoute('app_register');
            }

            if ($this->userRepository->findOneBy(['email' => $user->getEmail()])) {
                $this->addFlash('error', 'User with this email already exist');
                return $this->redirectToRoute('app_register');
            }

            if ($request->request->get('_password') !== $request->request->get('_repeat_password')) {
                $this->addFlash('error', 'Password and repeat password are not the same');
                return $this->redirectToRoute('app_register');
            }

            $password = $this->passwordHasher->hashPassword($user, $request->request->get('_password'));
            $user->setPassword($password);

            $this->userRepository->save($user, true);
            return $this->redirectToRoute('home_index');
        }

        return $this->render(
            'security/register.html.twig', [
                'error' => $error ?? null,
            ]
        );
    }
}
