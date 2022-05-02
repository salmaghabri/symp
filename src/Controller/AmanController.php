<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AmanController extends AbstractController
{
    
    #[Route('/aman/{param1}/{param2}', name: 'app_req')]
    
    public function jsp(Request $req):Response{
       # dd($req);
       
        return $this->render('aman/request.html.twig',['msg'=>$req->query->get('message')]);
        
    }
    #[Route('/aman/{nom}', name: 'app_aman')]
    public function index($nom): Response
    {
        
        return $this->render('aman/index.html.twig', [
            'controller_name' => 'AmanController','name'=>$nom
        ]);
    }
}
