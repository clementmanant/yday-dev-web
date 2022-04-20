<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil/{id}', name: 'app_profil')]
    public function index(User $user): Response
    {
        if ($this->getUser() !== $user) {
            return $this->redirectToRoute('homepage');
        }

        return $this->render('profil/index.html.twig', [
            'user' => $user
        ]);
    }

    #[Route('/profil/edit/{id}', name: 'edit_profil', methods: ['GET', 'POST'])]
    public function edit(User $user, Request $request, EntityManagerInterface $manager): Response
    {
        if ($this->getUser() !== $user) {
            return $this->redirectToRoute('homepage');
        }

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $edition = $form->getData();
            $manager->persist($edition);
            $manager->flush();
            return $this->redirectToRoute('homepage');
        }

        return $this->render('profil/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }
}
