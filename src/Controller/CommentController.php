<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CommentRepository;
use App\Entity\Post;

class CommentController extends AbstractController
{
    #[Route('/posts/{id}/comments', name: 'app_show_comments')]
    public function show_comments(Post $post, CommentRepository $commentRepository): Response
    {
        $comments=$commentRepository->findAllPostComments($post);
        return $this->render('comment/show_comments.html.twig', [
            'comments'=>$comments,
        ]);
    }

    // #[Route('/posts/{id}/comments', name: 'app_comment_create')]
    // public function create_comment(): Response
    // {
    //     return $this->render('comment/index.html.twig', [
    //         'controller_name' => 'CommentController',
    //     ]);
    // }

    // #[Route('/comment', name: 'app_comment_edit')]
    // public function edit_comment(): Response
    // {
    //     return $this->render('comment/index.html.twig', [
    //         'controller_name' => 'CommentController',
    //     ]);
    // }

    // #[Route('/comment', name: 'app_comment_delete')]
    // public function delete_comment(): Response
    // {
    //     return $this->render('comment/index.html.twig', [
    //         'controller_name' => 'CommentController',
    //     ]);
    // }

    // #[Route('/comment', name: 'app_comment')]
    // public function reply_comment(): Response
    // {
    //     return $this->render('comment/index.html.twig', [
    //         'controller_name' => 'CommentController',
    //     ]);
    // }
}
