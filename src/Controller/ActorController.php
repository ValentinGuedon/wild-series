<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/actor', name: 'app_actor')]
class ActorController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('actor/index.html.twig', [
            'controller_name' => 'ActorController',
        ]);
    }

    #[Route('/{id}', name: '_show')]#
    public function show(): Response
    {
        return $this->render('actor/show.html.twig', [
            'controller_name' => 'ActorController',
        ]);
    }
}
