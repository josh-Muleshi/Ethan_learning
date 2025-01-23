<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name:'user.index')]
    public function index(): Response
    {
        $number = random_int(1,100);
        return $this->render('user/index.html.twig', ['number' => $number]);
    }
}