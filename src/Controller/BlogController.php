<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function homepage(): Response
    {
        $users=$this->getUsers();
        return $this->render('blog/homepage.html.twig',[
            'blog_title'=>'Symfony Blog',
            'users'=>$users,
        ]);
    }

    #[Route('/{login}',name: 'app_user_posts')]
    public function user_posts($login=''): Response
    {
        $posts=$this->getPosts();
        $user_posts=[];
        for($i=0,$size = count($posts); $i < $size; $i++){
            if($posts[$i]['author']==$login){
            array_push($user_posts,$posts[$i]);
            }
        }
        $users=$this->getUsers();
        for($i=0,$size = count($users); $i < $size; $i++){
            if($users[$i]['login']==$login){
            $user=$users[$i];
            }
        }
        return $this->render('blog/user_posts.html.twig',[
            'user'=>$user,
            'user_posts'=>$user_posts,
        ]);
    }

    #[Route('/{login}/posts/{id}',name: 'app_post_show')]
    public function post_show($login='',$id): Response
    {
        $posts=$this->getPosts();
        $user_posts=[];
        for($i=0,$size = count($posts); $i < $size; $i++){
            if($posts[$i]['author']==$login){
            array_push($user_posts,$posts[$i]);
            }
        }
        for($i=0,$size = count($user_posts); $i < $size; $i++){
            if($user_posts[$i]['id']==$id){
                $post=$user_posts[$i];
            }
        }
        $users=$this->getUsers();
        for($i=0,$size = count($users); $i < $size; $i++){
            if($users[$i]['login']==$login){
            $user=$users[$i];
            }
        }
        return $this->render('blog/post_show.html.twig',[
            'user'=>$user,
            'post'=>$post,
        ]);
    }
    private function getPosts(): array
    {
        return [
            [
                'id'=>1,
                'title' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit',
                'topic'=>'Vae',
                'summary' => 'In hac habitasse platea dictumst. Pellentesque et sapien pulvinar consectetur.',
                'text' => 'Praesent id fermentum lorem. Ut est lorem, fringilla at accumsan nec, euismod at nunc. Aenean mattis sollicitudin mattis. Nullam pulvinar vestibulum bibendum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce nulla purus, gravida ac interdum ut, blandit eget ex. Duis a luctus dolor.',
                'author'=>'Petrov',
                //'createdAt' => new \DateTime('13-02-2023 10:14:11'),
                'createdAt' =>'13-02-2023 10:14:11',
                'deleted_at'=>null,

            ],
            [
                'id'=>2,
                'title' => 'Pellentesque vitae velit ex',
                'topic'=>'Lorem',
                'summary' => 'Curabitur aliquam euismod dolor non ornare. ',
                'text' => 'Integer auctor massa maximus nulla scelerisque accumsan. Aliquam ac malesuada ex. Pellentesque tortor magna, vulputate eu vulputate ut, venenatis ac lectus. Praesent ut lacinia sem. Mauris a lectus eget felis mollis feugiat. Quisque efficitur, mi ut semper pulvinar, urna urna blandit massa, eget tincidunt augue nulla vitae est.',
                'author'=>'Ivanov',
                //'createdAt' => new \DateTime('12-02-2023 17:48:59'),
                'createdAt' =>'13-02-2023 10:14:11',
                'deleted_at'=>null,
            ],
            [
                'id'=>3,
                'title' => 'Mauris dapibus risus quis suscipit vulputate',
                'topic'=>'Pellentesque',
                'summary' => 'Silva de secundus galatae demitto quadra. Potus sensim ad ferox abnoba.',
                'text' => 'Aliquam pulvinar interdum massa, vel ullamcorper ante consectetur eu. Vestibulum lacinia ac enim vel placerat. Integer pulvinar magna nec dui malesuada, nec congue nisl dictum. Donec mollis nisl tortor, at congue erat consequat a. Nam tempus elit porta, blandit elit vel, viverra lorem. Sed sit amet tellus tincidunt, faucibus nisl in, aliquet libero.',
                'author'=>'Petrov',
                //'createdAt' => new \DateTime('11-02-2023 08:29:19'),
                'createdAt' =>'13-02-2023 10:14:11',
                'deleted_at'=>null,
            ],
        ];
    }

    private function getUsers(): array
    {
        return [
            [
                'id'=>1,
                'login' => 'Ivanov',
                'full_name' => 'Иванов Иван Иванович',
                'email' => 'Ivanov@gmail.com',
                'is_admin' => 1,
            ],
            [
                'id'=>2,
                'login' => 'Petrov',
                'full_name' => 'Петров Пётр Петрович',
                'email' => 'Petrov@gmail.com',
                'is_admin' => 0,
            ],
            [
                'id'=>3,
                'login' => 'Sidorov',
                'full_name' => 'Сидоров Сидор Сидорович',
                'email' => 'Sidorov@gmail.com',
                'is_admin' => 0,
            ],
        ];
    }

    private function getComments(): array
    {
        return [
            [
                'id'=>1,
                'author' => 'Ivanov',
                'text' => 'Nam tempus elit porta, blandit elit vel, viverra lorem.',
                //'createdAt' => new \DateTime('11-02-2023 06:29:19'),
                'createdAt' =>'13-02-2023 10:14:11',
                'deleted_at'=>null,
                'post_id'=>1,
            ],
            [
                'id'=>2,
                'author' => 'Petrov',
                'text' => 'Morbi vulputate metus vel ipsum finibus, ut dapibus massa feugiat.',
                //'createdAt' => new \DateTime('9-02-2023 08:29:19'),
                'createdAt' =>'13-02-2023 10:14:11',
                'deleted_at'=>null,
                'post_id'=>1,
            ],
            [
                'id'=>3,
                'author' => 'Sidorov',
                'text' => 'Ut posuere aliquet tincidunt. Aliquam erat volutpat. ',
                //'createdAt' => new \DateTime('10-02-2023 08:29:19'),
                'createdAt' =>'13-02-2023 10:14:11',
                'deleted_at'=>null,
                'post_id'=>1,
            ],
        ];
    }
}