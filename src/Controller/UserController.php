<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/user/{id}/edit', name:'user.edit')]
    public function edit(User $user, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success','L\'utilisateur a bien été modifié');
            return $this->redirectToRoute('user.index');
        }
        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
}