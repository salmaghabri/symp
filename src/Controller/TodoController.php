<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends AbstractController
{
   


    #[Route('/todo', name: 'app_todo')]
   
    public function index(Request $req): Response
    {
        $session=$req->getSession();
       // $session->request->get('title','task');
        
        if(! $session->has('tab')){
           $todo=["java"=>"POO"];
           $this->addFlash("info","la liste de  todo  initialisée");

           
        }
        $todo=$session->get('tab');
        $session->set('tab',$todo);
        return $this->render('todo/index.html.twig', [
        ]);
    }


    #[Route('/todo/ajout/{title}/{task}', name: 'todo.ajout')]
    public function addToDo (Request $req, $title,$task): Response
    {   $session=$req->getSession();
        if(! $session->has('tab')){
            $this->addFlash("danger","la liste de  todo n'est pas encore initialisé");
            return $this->redirectToRoute("app_todo");
            
         }
         $tab=$session->get('tab'); 
         if(isset($tab[$title])){
             $this->addFlash('danger',"nom de tache existe deja");
             


         }else{
         $tab[$title]=$task;
         $session->set('tab',$tab);
         $this->addFlash('success',"todo ajouté");
 
        }
            return $this->redirectToRoute("app_todo");
    
        }

        #[Route('/todo/supp/{title}', name: 'todo.supp')]
        public function sup(Request $req,$title){

            $session=$req->getSession();
            if(! $session->has('tab')){
                $this->addFlash('danger',"liste non initialisée");
                return $this->redirectToRoute("app_todo");
            }
            $tab=$session->get('tab');
            if(! isset($tab[$title])){
                $this->addFlash('danger',"todo n'existe pas");
                return $this->redirectToRoute("app_todo");
            }
            unset($tab[$title]);
            $session->set('tab',$tab);
            $this->addFlash('success',"todo supprimé");
            return $this->redirectToRoute("app_todo");



        }

}
