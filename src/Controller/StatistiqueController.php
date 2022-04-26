<?php

namespace App\Controller;

use App\Entity\Statistique;
use App\Form\StatistiqueType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/statistique")
 */
class StatistiqueController extends AbstractController
{
    /**
     * @Route("/", name="app_statistique_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $statistiques = $entityManager
            ->getRepository(Statistique::class)
            ->findAll();

        return $this->render('statistique/index.html.twig', [
            'statistiques' => $statistiques,
        ]);
    }

    /**
     * @Route("/new", name="app_statistique_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $statistique = new Statistique();
        $form = $this->createForm(StatistiqueType::class, $statistique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($statistique);
            $entityManager->flush();

            return $this->redirectToRoute('app_statistique_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('statistique/new.html.twig', [
            'statistique' => $statistique,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idd}", name="app_statistique_show", methods={"GET"})
     */
    public function show(Statistique $statistique): Response
    {
        return $this->render('statistique/show.html.twig', [
            'statistique' => $statistique,
        ]);
    }

    /**
     * @Route("/{idd}/edit", name="app_statistique_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Statistique $statistique, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(StatistiqueType::class, $statistique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_statistique_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('statistique/edit.html.twig', [
            'statistique' => $statistique,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idd}", name="app_statistique_delete", methods={"POST"})
     */
    public function delete(Request $request, Statistique $statistique, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$statistique->getIdd(), $request->request->get('_token'))) {
            $entityManager->remove($statistique);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_statistique_index', [], Response::HTTP_SEE_OTHER);
    }
}
