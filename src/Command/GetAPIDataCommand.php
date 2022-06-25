<?php

namespace App\Command;

use App\Entity\Post;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;


#[AsCommand(
    name: 'getAPIData',
    description: 'Wykonuje zadanie 1'
)]
class GetAPIDataCommand extends Command
{
    private $clientInterface;
    private $entityManager;

    public function __construct(HttpClientInterface $clientInterface, EntityManagerInterface $entityManager)
    {
        $this->clientInterface = $clientInterface;
        $this->entityManager = $entityManager;

        parent::__construct();
    }
    
    protected function configure(): void
    {
        // Use in-build functions to set name, description and help

        $this
            ->setDescription('This command runs your custom task');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $postRepo = $this->entityManager->getRepository(Post::class);
        $userRepo = $this->entityManager->getRepository(User::class);

        if($postRepo->count([]) == 0 && $userRepo->count([]) == 0)
        {
            $this->getPosts();
            $this->getUsers();
            $this->entityManager->flush();

            $io = new SymfonyStyle($input,$output);
            $io->success('Pobrano dane z API');
        }else
        {
            $io = new SymfonyStyle($input,$output);
            $io->success('Dane zostały wcześniej pobrane');
        }

        return Command::SUCCESS;
    }

    public function getPosts()
    {
        $posts = $this->clientInterface->request(
            'GET',
            'https://jsonplaceholder.typicode.com/posts'
        );

        $postsArray= $posts->toArray();
        foreach($postsArray as $post)
        {
            $newPost = new Post();
            $newPost->setUserId($post['userId']);
            $newPost->setTitle($post['title']);
            $newPost->setBody($post['body']);
            $this->entityManager->persist($newPost);
        }
    }

    public function getUsers()
    {
        $users = $this->clientInterface->request(
            'GET',
            'https://jsonplaceholder.typicode.com/users'
        );


        $userValues = $users->toArray();

        foreach($userValues as $uservalue)
        {
            $user = new User();

            $user->setName($uservalue['name']);
            
            
            $this->entityManager->persist($user);
        }
         
    }

}
