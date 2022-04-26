<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Form\EquipeType;
use App\Form\Equipe1Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;


/**
 * @Route("/equipe")
 */
class EquipeController extends AbstractController
{
    /**
     * @Route("/", name="app_equipe_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager, PaginatorInterface $paginator, Request $request): Response
    {
        $equipes = $entityManager
            ->getRepository(Equipe::class)
            ->findAll();
        $equipes = $paginator->paginate(
            // Doctrine Query, not results
            $equipes,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            3
        );    

        return $this->render('equipe/index.html.twig', [
            'equipes' => $equipes,
        ]);
    }

    /**
     * @Route("/new", name="app_equipe_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $equipe = new Equipe();
        $form = $this->createForm(EquipeType::class, $equipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('logo')->getData();
            $file2 = $form->get('drapeau')->getData();

            $fileName = md5 (uniqid()).'.'.$file->guessExtension();
            $file->move( $this->getParameter('images_directory'),$fileName);
            $equipe->setLogo($fileName);

            $fileName2 = md5 (uniqid()).'.'.$file2->guessExtension();
            $file2->move( $this->getParameter('images_directory'),$fileName2);
            $equipe->setDrapeau($fileName2);

            $em=$this->getDoctrine()->getManager();

            $entityManager->persist($equipe);
            $entityManager->flush();


            
            $this->addFlash(
                'info' ,
                'Added successfuly!' ,
            
            );

            return $this->redirectToRoute('app_equipee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('equipe/new.html.twig', [
            'equipe' => $equipe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idEquipe}", name="app_equipe_show", methods={"GET"})
     */
    public function show(Equipe $equipe): Response
    {
        
        $this->addFlash(
            'info' ,
            'Added successfuly!' ,

        );

        return $this->render('equipe/show.html.twig', [
            'equipe' => $equipe,
        ]);
    }

    /**
     * @Route("/{idEquipe}/edit", name="app_equipe_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Equipe $equipe, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Equipe1Type::class, $equipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_equipe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('equipe/edit.html.twig', [
            'equipe' => $equipe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idEquipe}", name="app_equipe_delete", methods={"POST"})
     */
    public function delete(Request $request, Equipe $equipe, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$equipe->getIdEquipe(), $request->request->get('_token'))) {
            $entityManager->remove($equipe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_equipe_index', [], Response::HTTP_SEE_OTHER);
    }
}
