<?php

namespace App\Controller;

use App\Entity\Joueur;
use App\Form\Joueur1Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/joueurfront")
 */
class JoueurFrontController extends AbstractController
{
    /**
     * @Route("/", name="app_joueur_front_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $joueurs = $entityManager
            ->getRepository(Joueur::class)
            ->findAll();

        return $this->render('joueur_front/index.html.twig', [
            'joueurs' => $joueurs,
        ]);
    }

    /**
     * @Route("/new", name="app_joueur_front_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $joueur = new Joueur();
        $form = $this->createForm(Joueur1Type::class, $joueur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($joueur);
            $entityManager->flush();

            return $this->redirectToRoute('app_joueur_front_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('joueur_front/new.html.twig', [
            'joueur' => $joueur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idJoueur}", name="app_joueur_front_show", methods={"GET"})
     */
    public function show(Joueur $joueur): Response
    {
        return $this->render('joueur_front/show.html.twig', [
            'joueur' => $joueur,
        ]);
    }

    /**
     * @Route("/{idJoueur}/edit", name="app_joueur_front_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Joueur $joueur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Joueur1Type::class, $joueur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_joueur_front_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('joueur_front/edit.html.twig', [
            'joueur' => $joueur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idJoueur}", name="app_joueur_front_delete", methods={"POST"})
     */
    public function delete(Request $request, Joueur $joueur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$joueur->getIdJoueur(), $request->request->get('_token'))) {
            $entityManager->remove($joueur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_joueur_front_index', [], Response::HTTP_SEE_OTHER);
    }
}
