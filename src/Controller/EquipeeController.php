<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Form\Equipe2Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;


/**
 * @Route("/equipee")
 */
class EquipeeController extends AbstractController
{
    /**
     * @Route("/", name="app_equipee_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager, PaginatorInterface $paginator, Request $request): Response
    {
        $equipes = $entityManager
            ->getRepository(Equipe::class)
            ->findAll();
              

        return $this->render('equipee/index.html.twig', [
            'equipes' => $equipes,
        ]);
    }

    /**
     * @Route("/new", name="app_equipee_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $equipe = new Equipe();
        $form = $this->createForm(Equipe2Type::class, $equipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($equipe);
            $entityManager->flush();

            return $this->redirectToRoute('app_equipee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('equipee/new.html.twig', [
            'equipe' => $equipe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idEquipe}", name="app_equipee_show", methods={"GET"})
     */
    public function show(Equipe $equipe): Response
    {
        return $this->render('equipee/show.html.twig', [
            'equipe' => $equipe,
        ]);
    }

    /**
     * @Route("/{idEquipe}/edit", name="app_equipee_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Equipe $equipe, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Equipe2Type::class, $equipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_equipee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('equipee/edit.html.twig', [
            'equipe' => $equipe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idEquipe}", name="app_equipee_delete", methods={"POST"})
     */
    public function delete(Request $request, Equipe $equipe, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$equipe->getIdEquipe(), $request->request->get('_token'))) {
            $entityManager->remove($equipe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_equipee_index', [], Response::HTTP_SEE_OTHER);
    }
}
