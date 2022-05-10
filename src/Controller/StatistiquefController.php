<?php

namespace App\Controller;

use App\Entity\Statistique;
use App\Form\Statistique1Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/statistiquef")
 */
class StatistiquefController extends AbstractController
{
    /**
     * @Route("/", name="app_statistiquef_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $statistiques = $entityManager
            ->getRepository(Statistique::class)
            ->findAll();

        return $this->render('statistiquef/index.html.twig', [
            'statistiques' => $statistiques,
        ]);
    }

    /**
     * @Route("/new", name="app_statistiquef_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $statistique = new Statistique();
        $form = $this->createForm(Statistique1Type::class, $statistique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($statistique);
            $entityManager->flush();

            return $this->redirectToRoute('app_statistiquef_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('statistiquef/new.html.twig', [
            'statistique' => $statistique,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idd}", name="app_statistiquef_show", methods={"GET"})
     */
    public function show(Statistique $statistique): Response
    {
        return $this->render('statistiquef/show.html.twig', [
            'statistique' => $statistique,
        ]);
    }

    /**
     * @Route("/{idd}/edit", name="app_statistiquef_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Statistique $statistique, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Statistique1Type::class, $statistique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_statistiquef_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('statistiquef/edit.html.twig', [
            'statistique' => $statistique,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idd}", name="app_statistiquef_delete", methods={"POST"})
     */
    public function delete(Request $request, Statistique $statistique, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$statistique->getIdd(), $request->request->get('_token'))) {
            $entityManager->remove($statistique);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_statistiquef_index', [], Response::HTTP_SEE_OTHER);
    }
}
