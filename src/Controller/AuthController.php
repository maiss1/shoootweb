<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\service\MailerService;

class AuthController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils,\Swift_Mailer $mailer,
    MailerService $mailerService): Response
    {
        if ($this->getUser()) {
            if ($this->IsGranted('ROLE_CLIENT')){
                return $this->redirectToRoute('user_list');
            }
            else if ($this->IsGranted('ROLE_CLIENT')){
                return $this->redirectToRoute('app_admin_index');
            }
            
         }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $mailerService->send(
            "Bienvenue chére client , vous etes connectés avec succées sur notre site  ",
            "seifeddine.benkarim@esprit.tn",
            "seifeddine.benkarim@esprit.tn",
            
            "MailTemplate/emailTemplate.html.twig");

       
    

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

}
