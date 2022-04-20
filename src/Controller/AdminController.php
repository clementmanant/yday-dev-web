<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/patients/{page?1}/{nbre?24}', name: 'patients')]
    public function patients(ManagerRegistry $doctrine, $page, $nbre): Response
    {
        $repository = $doctrine->getRepository(User::class);
        $nbUsers = $repository->count([]);
        $nbPages = ceil($nbUsers / $nbre);
        $users = $repository->findBy([], [], $nbre, ($page - 1) * $nbre);
        return $this->render('admin/patients.html.twig', [
            'users' => $users,
            'nbPages' => $nbPages,
            'page' => $page,
            'nbre' => $nbre
        ]);
    }
}
