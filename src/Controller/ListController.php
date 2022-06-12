<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListController extends AbstractController
{
    private $postRepository;
    private $userRepository;
    private $em;

    public function __construct(PostRepository $postRepository, UserRepository $userRepository, EntityManagerInterface $em)
    {
        $this->postRepository = $postRepository;
        $this->userRepository = $userRepository;
        $this->em = $em;
    }

    #[Route('/lista', name: 'app_list')]
    public function index(): Response
    {
        $posts = $this->postRepository->findAll();
        $users = $this->userRepository->findAll();

        return $this->render('list.html.twig',[
            'posts' => $posts,
            'users' => $users
        ]);
    }

    #[Route('/lista/delete/{id}', methods: ['GET', 'DELETE'], name: 'delete')]
    public function delete($id): Response
    {
        
        $post = $this->postRepository->find($id);
        $this->em->remove($post);
        $this->em->flush();

        return $this->redirectToRoute('app_list');
    }
}
