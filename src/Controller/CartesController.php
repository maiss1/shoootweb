<?php

namespace App\Controller;

use App\Entity\Cartes;
use App\Form\CartesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cartes")
 */
class CartesController extends AbstractController
{
    /**
     * @Route("/", name="app_cartes_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $cartes = $entityManager
            ->getRepository(Cartes::class)
            ->findAll();

        return $this->render('cartes/index.html.twig', [
            'cartes' => $cartes,
        ]);
    }

    /**
     * @Route("/new", name="app_cartes_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $carte = new Cartes();
        $form = $this->createForm(CartesType::class, $carte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
            
            $entityManager->persist($carte);
            $entityManager->flush();

            return $this->redirectToRoute('app_cartes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cartes/new.html.twig', [
            'carte' => $carte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_cartes_show", methods={"GET"})
     */
    public function show(Cartes $carte): Response
    {
        return $this->render('cartes/show.html.twig', [
            'carte' => $carte,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_cartes_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Cartes $carte, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CartesType::class, $carte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cartes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cartes/edit.html.twig', [
            'carte' => $carte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_cartes_delete", methods={"POST"})
     */
    public function delete(Request $request, Cartes $carte, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carte->getId(), $request->request->get('_token'))) {
            $entityManager->remove($carte);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cartes_index', [], Response::HTTP_SEE_OTHER);
    }
    /**
     * @Route("/cartes/Detaill/{id}", name="de")
     */
    public function detail($id): Response
    {
        $detail = $this->getDoctrine()->getRepository(Cartes::class)->find($id);
         
       
        return $this->render('cartes/details.html.twig', [
            
            'details'=> $detail,
           

        ]);
    }
}
