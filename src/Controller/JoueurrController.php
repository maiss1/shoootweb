<?php

namespace App\Controller;

use App\Entity\Joueur;
use App\Form\Joueur1Type;
use App\Repository\JoueurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;


/**
 * @Route("/joueurr")
 */
class JoueurrController extends AbstractController
{
    /**
     * @Route("/", name="app_joueurr_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager, PaginatorInterface $paginator, Request $request): Response
    {
        $joueurs = $entityManager
            ->getRepository(Joueur::class)
            ->findAll();

            $joueurs = $paginator->paginate(
                // Doctrine Query, not results
                $joueurs,
                // Define the page parameter
                $request->query->getInt('page', 1),
                // Items per page
                3
            );

            return $this->render('joueurr/index.html.twig', [
                'joueurs' => $joueurs,
            
        ]);
    }

    /**
     * @Route("/new", name="app_joueurr_new", methods={"GET", "POST"})
     */
    public function new(Request $request, JoueurRepository $joueurRepository): Response
    {
        $joueur = new Joueur();
        $form = $this->createForm(Joueur1Type::class, $joueur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $joueurRepository->add($joueur);
            return $this->redirectToRoute('app_joueurr_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('joueurr/new.html.twig', [
            'joueur' => $joueur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idJoueur}", name="app_joueurr_show", methods={"GET"})
     */
    public function show(Joueur $joueur): Response
    {
        return $this->render('joueurr/show.html.twig', [
            'joueur' => $joueur,
        ]);
    }

    /**
     * @Route("/{idJoueur}/edit", name="app_joueurr_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Joueur $joueur, JoueurRepository $joueurRepository): Response
    {
        $form = $this->createForm(Joueur1Type::class, $joueur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $joueurRepository->add($joueur);
            return $this->redirectToRoute('app_joueurr_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('joueurr/edit.html.twig', [
            'joueur' => $joueur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idJoueur}", name="app_joueurr_delete", methods={"POST"})
     */
    public function delete(Request $request, Joueur $joueur, JoueurRepository $joueurRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$joueur->getIdJoueur(), $request->request->get('_token'))) {
            $joueurRepository->remove($joueur);
        }

        return $this->redirectToRoute('app_joueurr_index', [], Response::HTTP_SEE_OTHER);
    }
}
