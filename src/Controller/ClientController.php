<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Cartes;
use App\Form\CartesType;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    /**
     * @Route("/client", name="app_client")
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $cartes = $entityManager
            ->getRepository(Cartes::class)
            ->findAll();

        return $this->render('client/f.html.twig', [
            'cartes' => $cartes,
        ]);
    }
     /**
     * @Route("/add/{id}", name="add")
     */

    public function add ($id, SessionInterface $session)
    {
   dd ($session);
        
    }
    
}
