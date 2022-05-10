<?php

namespace App\Controller;

use App\Entity\Matchh;
use App\Form\Matchh1Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;


/**
 * @Route("/matchh")
 */
class MatchhController extends AbstractController
{
    /**
     * @Route("/", name="app_matchh_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager, PaginatorInterface $paginator, Request $request): Response
    {
        $matchhs = $entityManager
            ->getRepository(Matchh::class)
            ->findAll();

            $matchhs = $paginator->paginate(
                // Doctrine Query, not results
                $matchhs,
                // Define the page parameter
                $request->query->getInt('page', 1),
                // Items per page
                3
            );

        return $this->render('matchh/index.html.twig', [
            'matchhs' => $matchhs,
        ]);
    }

    /**
     * @Route("/new", name="app_matchh_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $matchh = new Matchh();
        $form = $this->createForm(Matchh1Type::class, $matchh);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($matchh);
            $entityManager->flush();

            return $this->redirectToRoute('app_matchh_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('matchh/new.html.twig', [
            'matchh' => $matchh,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idMatch}", name="app_matchh_show", methods={"GET"})
     */
    public function show(Matchh $matchh): Response
    {
        return $this->render('matchh/show.html.twig', [
            'matchh' => $matchh,
        ]);
    }

    /**
     * @Route("/{idMatch}/edit", name="app_matchh_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Matchh $matchh, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Matchh1Type::class, $matchh);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_matchh_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('matchh/edit.html.twig', [
            'matchh' => $matchh,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idMatch}", name="app_matchh_delete", methods={"POST"})
     */
    public function delete(Request $request, Matchh $matchh, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$matchh->getIdMatch(), $request->request->get('_token'))) {
            $entityManager->remove($matchh);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_matchh_index', [], Response::HTTP_SEE_OTHER);
    }
}
