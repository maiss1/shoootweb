<?php

namespace App\Controller;

use App\Entity\Matchs;
use App\Form\Matchs2Type;
use App\Repository\MatchsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mm")
 */
class MmController extends AbstractController
{
    /**
     * @Route("/", name="app_mm_index", methods={"GET"})
     */
    public function index(MatchsRepository $matchsRepository): Response
    {
        return $this->render('mm/index.html.twig', [
            'matchs' => $matchsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_mm_new", methods={"GET", "POST"})
     */
    public function new(Request $request, MatchsRepository $matchsRepository): Response
    {
        $match = new Matchs();
        $form = $this->createForm(Matchs2Type::class, $match);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $matchsRepository->add($match);
            return $this->redirectToRoute('app_mm_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('mm/new.html.twig', [
            'match' => $match,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_mm_show", methods={"GET"})
     */
    public function show(Matchs $match): Response
    {
        return $this->render('mm/show.html.twig', [
            'match' => $match,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_mm_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Matchs $match, MatchsRepository $matchsRepository): Response
    {
        $form = $this->createForm(Matchs2Type::class, $match);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $matchsRepository->add($match);
            return $this->redirectToRoute('app_mm_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('mm/edit.html.twig', [
            'match' => $match,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_mm_delete", methods={"POST"})
     */
    public function delete(Request $request, Matchs $match, MatchsRepository $matchsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$match->getId(), $request->request->get('_token'))) {
            $matchsRepository->remove($match);
        }

        return $this->redirectToRoute('app_mm_index', [], Response::HTTP_SEE_OTHER);
    }
}
