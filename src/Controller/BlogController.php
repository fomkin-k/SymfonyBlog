<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Repository\PostRepository;

class BlogController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function homepage(UserRepository $userRepository): Response
    {
        // $users=$userRepository->findAll();
        $users = $userRepository->findBy([], ['fullName' => 'ASC']);
        return $this->render('blog/homepage.html.twig',[
            'blog_title'=>'Symfony Blog',
            'users'=>$users,
        ]);
    }

    #[Route('/blog/{login}',name: 'app_user_posts')]
    public function user_posts($login, PostRepository $postRepository, UserRepository $userRepository): Response
    {
        $author=$userRepository->findOneUserByLogin($login);
        $userPosts=$postRepository->findAllUserPosts($author);
        return $this->render('blog/user_posts.html.twig',[
            'userPosts'=>$userPosts,
        ]);
    }

    #[Route('/blog/{login}/posts/{id}',name: 'app_post_show')]
    public function post_show($login, $id, PostRepository $postRepository, UserRepository $userRepository): Response
    {
        $userRepository->findOneUserByLogin($login);
        $post=$postRepository->findOnePostById($id);

        return $this->render('blog/post_show.html.twig',[
            'post'=>$post,
        ]);
    }
    
}