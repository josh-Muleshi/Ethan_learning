<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name:'user.index')]
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        return $this->render('user/index.html.twig', ['users' => $users]);
    }

    #[Route('/user/{id}', name:'user.show')]
    public function show(int $id, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($id);
        return $this->render('user/show.html.twig', ['user' => $user]);
    }
}