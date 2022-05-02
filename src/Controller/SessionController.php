<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(Request $req): Response
    {   $session=$req->getSession(); // session start
        
        if($session->has('nb')){
           $nb=$session->get('nb')+1; 
           $session->set('nb',$nb);
        }else{
            $nb=1;
            $session->set('nb',$nb);
            
        }
        return $this->render('session/index.html.twig', [
        ]);
    }
}
