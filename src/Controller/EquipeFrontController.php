<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Form\Equipe1Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/equipefront")
 */
class EquipeFrontController extends AbstractController
{
    /**
     * @Route("/", name="app_equipe_front_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $equipes = $entityManager
            ->getRepository(Equipe::class)
            ->findAll();

        return $this->render('equipe_front/index.html.twig', [
            'equipes' => $equipes,
        ]);
    }

    

    /**
     * @Route("/{idEquipe}", name="app_equipe_front_show", methods={"GET"})
     */
    public function show(Equipe $equipe): Response
    {
        return $this->render('equipe_front/show.html.twig', [
            'equipe' => $equipe,
        ]);
    }

    

   
}
