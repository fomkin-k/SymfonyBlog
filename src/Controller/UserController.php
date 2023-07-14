<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UserType;
use App\Entity\User;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserRepository;

class UserController extends AbstractController
{
    #[Route('/admin/users', name: 'admin_users')]
    public function admin_users(UserRepository $userRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $users = $userRepository->findBy([], ['fullName' => 'ASC']);

        return $this->render('users/admin.html.twig', [
            'controller_name' => 'UserController',
            'users'=>$users,
        ]);
    }

    #[Route('/profile/edit', name: 'edit_user')]
    public function edit_user( #[CurrentUser] User $user, Request $request, EntityManagerInterface $entityManager): Response
    {

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_posts', ['login' => $user->getLogin()]);
        }

        return $this->render('users/edit.html.twig', [
            'form' => $form->createView(),
        ]);

    }
}
