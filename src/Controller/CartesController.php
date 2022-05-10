<?php

namespace App\Controller;

use App\Entity\Cartes;
use App\Form\CartesType;
use App\Form\Carte2Type;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
/**
 * @Route("/cartes")
 */
class CartesController extends AbstractController
{
    /**
     * @Route("/", name="app_cartes_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager, PaginatorInterface $paginator, Request $request): Response
    {
        $cartes = $entityManager
            ->getRepository(Cartes::class)
            ->findAll();
            $cartes = $paginator->paginate(
                // Doctrine Query, not results
                $cartes,
                // Define the page parameter
                $request->query->getInt('page', 1),
                // Items per page
                3
            );


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
            $file = $form->get('imgcarte')->getData();
           
            $fileName = md5 (uniqid()).'.'.$file->guessExtension();
            $file->move( $this->getParameter('image_directory'),$fileName);
            $carte->setImgcarte($fileName);
            
            $em=$this->getDoctrine()->getManager();

            
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
        $form = $this->createForm(Carte2Type::class, $carte);
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
