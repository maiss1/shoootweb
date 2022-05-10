<?php
namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method; 
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class IndexController extends AbstractController {

    /**
    * @Route("/",name="user_list")
    */
    public function home() {
      
      $users=$this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render('user/index.html.twig',['users'=>$users]);
    }

     /**
     * @Route("/user/new",name="new_user")
     * Method({"GET","POST"})
     */
public function new(Request $request,UserPasswordEncoderInterface $userPasswordEncoder){

    $user=new User();

    $form= $this->createForm( UserType::class, $user);

    $form->handleRequest($request);

        if ( $form->isSubmitted() && $form->isValid() ){
            $user->setPwd(
                $userPasswordEncoder->encodePassword(
                        $user,
                        $form->get('pwd')->getData()
                    )
                );
            $user-> setRole("client");
            //$user->setRoles(["ROLE_CLIENT"]);
            $user=$form->getData();

            $entityManager= $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('user/new.html.twig',['form'=> $form->createView()]);
}

    /**
     * @Route("/user/{id}",name="show_user")
     */
public function show($id) {
    $user = $this->getDoctrine()->getRepository(User::class)->find($id);
    return  $this->render('user/show.html.twig',array('user'=>$user));
}




    /**
     * @Route("/user/edit/{id}",name="edit_article")
     * Method({"GET","POST"})
     */
public function update(Request $request,$id){

    $user=new User();
    $user= $this->getDoctrine()->getRepository(User::class)->find($id);

    $form=$this->createForm(UserType::class,$user);

        $form->handleRequest($request);

        if ( $form->isSubmitted() && $form->isValid() ){
            $user=$form->getData();

            $entityManager= $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('user_list');
        }

        return $this->render('user/edite.html.twig',['form'=> $form->createView()]);
}


    /**
     * @Route("/user/delete/{id}",name="delete_user")
     * @Method({"DELETE"})
     */
public function delete(Request $request,$id){
    $user= $this->getDoctrine()->getRepository(User::class)->find($id);

    $entityManager= $this->getDoctrine()->getManager();
    $entityManager->remove($user);
    $entityManager->flush();

    $res= new Response();
    $res->send();
      return $this->redirectToRoute('user_list');
}
}
