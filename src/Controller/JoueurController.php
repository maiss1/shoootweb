<?php

namespace App\Controller;

use App\Entity\Joueur;
use App\Form\JoueurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;


/**
 * @Route("/joueur")
 */
class JoueurController extends AbstractController
{
    /**
     * @Route("/", name="app_joueur_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager, PaginatorInterface $paginator, Request $request): Response
    {
        $joueurs = $entityManager
            ->getRepository(Joueur::class)
            ->findAll();

            

        return $this->render('joueur/index.html.twig', [
            'joueurs' => $joueurs,
        ]);
    }

    /**
     * @Route("/new", name="app_joueur_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $joueur = new Joueur();
        $form = $this->createForm(JoueurType::class, $joueur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form->get('drapeau')->getData();
            $file2 = $form->get('image')->getData();

            $fileName = md5 (uniqid()).'.'.$file->guessExtension();
            $file->move( $this->getParameter('images_directory'),$fileName);
            $joueur->setDrapeau($fileName);

            $fileName2 = md5 (uniqid()).'.'.$file2->guessExtension();
            $file2->move( $this->getParameter('images_directory'),$fileName2);
            $joueur->setImage($fileName2);

            $em=$this->getDoctrine()->getManager();

            $entityManager->persist($joueur);
            $entityManager->flush();

            return $this->redirectToRoute('app_joueur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('joueur/new.html.twig', [
            'joueur' => $joueur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idJoueur}", name="app_joueur_show", methods={"GET"})
     */
    public function show(Joueur $joueur): Response
    {
        return $this->render('joueur/show.html.twig', [
            'joueur' => $joueur,
        ]);
    }

    /**
     * @Route("/{idJoueur}/edit", name="app_joueur_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Joueur $joueur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(JoueurType::class, $joueur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file3 = $form->get('drapeau')->getData();
            $file4 = $form->get('image')->getData();

            $fileName3 = md5 (uniqid()).'.'.$file3->guessExtension();
            $file3->move( $this->getParameter('images_directory'),$fileName3);
            $joueur->setDrapeau($fileName3);

            $fileName4 = md5 (uniqid()).'.'.$file4->guessExtension();
            $file4->move( $this->getParameter('images_directory'),$fileName4);
            $joueur->setImage($fileName4);

            $em=$this->getDoctrine()->getManager();


            $entityManager->flush();

            return $this->redirectToRoute('app_joueur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('joueur/edit.html.twig', [
            'joueur' => $joueur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idJoueur}", name="app_joueur_delete", methods={"POST"})
     */
    public function delete(Request $request, Joueur $joueur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$joueur->getIdJoueur(), $request->request->get('_token'))) {
            $entityManager->remove($joueur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_joueur_index', [], Response::HTTP_SEE_OTHER);
    }
}
