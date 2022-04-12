<?php

namespace App\Controller;

use App\Entity\Reduction;
use App\Form\ReductionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reduction")
 */
class ReductionController extends AbstractController
{
    /**
     * @Route("/", name="app_reduction_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $reductions = $entityManager
            ->getRepository(Reduction::class)
            ->findAll();

        return $this->render('reduction/index.html.twig', [
            'reductions' => $reductions,
        ]);
    }

    /**
     * @Route("/new", name="app_reduction_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reduction = new Reduction();
        $form = $this->createForm(ReductionType::class, $reduction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reduction);
            $entityManager->flush();

            return $this->redirectToRoute('app_reduction_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reduction/new.html.twig', [
            'reduction' => $reduction,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idBon}", name="app_reduction_show", methods={"GET"})
     */
    public function show(Reduction $reduction): Response
    {
        return $this->render('reduction/show.html.twig', [
            'reduction' => $reduction,
        ]);
    }

    /**
     * @Route("/{idBon}/edit", name="app_reduction_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Reduction $reduction, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReductionType::class, $reduction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reduction_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reduction/edit.html.twig', [
            'reduction' => $reduction,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idBon}", name="app_reduction_delete", methods={"POST"})
     */
    public function delete(Request $request, Reduction $reduction, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reduction->getIdBon(), $request->request->get('_token'))) {
            $entityManager->remove($reduction);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reduction_index', [], Response::HTTP_SEE_OTHER);
    }
}
