<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/')]
    public function homepage(): Response
    {
        $titles = [
            'Gangsta\'s Paradise - Coolio',
            'Waterfalls - TLC',
            'Creep - Radiohead',
            'Kiss from a Rose - Seal',
            'On Bended Knee - Boyz II Men',
            'Fantasy - Mariah Carey',
        ];
        return $this->render('blog/homepage.html.twig',[
            'blog_title'=>'My blog',
            'titles' => $titles,
        ]);
    }

    private function getPosts(): array
    {
        // temporary fake "mixes" data
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
        // temporary fake "mixes" data
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
        // temporary fake "mixes" data
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