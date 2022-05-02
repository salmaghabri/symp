<?php

namespace App\Controller;


use App\Entity\Personnes;
use App\Form\PersonneType;
use App\Repository\PersonnesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonneController extends AbstractController
{   
    #[Route('/personne/{page?1}/{nb?20}', name: 'app_personne')]
    public function index(PersonnesRepository $repos,$page,$nb): Response
    {
        $personnes = $repos->findAll();
        //dd($personnes);
       // $personnesReq=$repos->findBy([],['age'=>'ASC'],$nb,$nb*($page-1));
       $personnesReq=$repos->findByExampleField(30,42);
        // $personnesReq=$repos->stats();


        return $this->render('personne/index.html.twig', [
            'personnes' => $personnes,'personneRequete'=>$personnesReq
        ]);
    }

    #[Route('/add/{personne?0}', name: 'add.form.personne')]
    public function addForm(EntityManagerInterface $entityManager, Request $request,Personnes $personne=null): Response
    {   $update=true;
        if(! $personne){
       $personne=new Personnes();
       $update=false;
    
    }
    //    $formPersonne = $this->createForm(PersonneType::class, $personne,[
    //     'action' => $this->generateUrl('app_personne'),
    //     'method' => 'POST',
    // ]);
       $formPersonne = $this->createForm(PersonneType::class, $personne);
       
       $formPersonne->handleRequest($request);
       
    if($formPersonne->isSubmitted() && $formPersonne->isValid()){
            
           $entityManager->persist($personne);
           $entityManager->flush();
           if($update){
           $this->addFlash("success", "la personne a ete mise a jour  avec succes ");
        }else{
            $this->addFlash("success", "la personne a ete ajouté avec succes");

        }
           return $this->redirectToRoute("app_personne");

        }

      return $this->render('personne/form.html.twig',["formPersonne"=>$formPersonne->createView(),"updateMode"=>$update
           
       ]);
    }






    #[Route('/add/{nom}/{prenom}/{age}', name: 'add.personne')]
    public function add($nom,$prenom,$age, EntityManagerInterface  $entityManager): Response
    { 
       $personne=new Personnes();
       $personne->setPrenom($prenom);
       $personne->setNom($nom);
       $personne->setAge($age);
       $entityManager->persist($personne);
       $entityManager->flush();
       $this->addFlash("success", "la personne a ete ajouté avec succes");


       return $this->redirectToRoute("app_personne");
    }
   
  

    #[Route('/update/{personne}/{nom}/{prenom}/{age}/{email}', name: 'update.personne')]
    public function update(Personnes $personne=null,$nom,$prenom,$age,$email, EntityManagerInterface  $entityManager): Response{
        if($personne){
        $personne->setPrenom($prenom);
       $personne->setNom($nom);
       $personne->setAge($age);
       $personne->setEmail($email);
       $entityManager->persist($personne);
       $entityManager->flush();
     $this->addFlash("success", "la persone d'ID ".$personne->getID()."a ete mise a jour avec succes");



       return $this->redirectToRoute("app_personne");
            
            

        }
        $this->addFlash("danger", "la persone d'ID  que vous cherchez n'existe pas");

        return $this->redirectToRoute("app_personne");


    }
    #[Route('/delete/{personne}', name: 'delete.personne')]
    public function delete(Personnes $personne=null, EntityManagerInterface  $entityManager): Response{
        if($personne){
            $entityManager->remove($personne);
            $this->addFlash(
               'success',
               'supprimée avec succees'
            );
            $entityManager->flush();

        }      else{
            $this->addFlash(
               'danger',
               'personne inexistante'
            );
        }

        return $this->redirectToRoute("app_personne");
    }






}
