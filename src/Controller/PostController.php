<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use App\Entity\User;

class PostController extends AbstractController
{
    #[Route('/posts/edit/{id}', name: 'app_post_edit')]
    public function edit_post(Post $post, #[CurrentUser] User $user, Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('POST_EDIT', $post);

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_posts', ['login' => $user->getLogin()]);
        }

        return $this->render('post/edit.html.twig', [
            'form' => $form->createView(),
        ]);


    }

    #[Route('/posts/delete/{id}', name: 'app_post_delete')]
    public function delete_post(Post $post, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('POST_DELETE', $post);
        $post->setDeletedAt(new \DateTime());

        $entityManager ->persist($post);
        $entityManager->flush();

        return  $this->redirectToRoute('app_user_posts',[
            'login' => $post->getAuthor()->getLogin(),
        ]);
    }

    #[Route('/posts/create', name: 'app_post_create')]
    public function create_post(#[CurrentUser] User $user, Request $request, EntityManagerInterface $entityManager)
    {
        
        $timezone = new \DateTimeZone('Europe/Moscow');
        $currentDateTime = new \DateTime();
        $currentDateTime->setTimezone($timezone);


        $post = new Post();
        $post->setAuthor($user);
        $post->setPublishedAt($currentDateTime);
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_posts', ['login' => $user->getLogin()]);
        }

        return $this->render('post/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
