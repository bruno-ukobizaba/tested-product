<?php

namespace App\Controller;

use App\Entity\Langue;
use App\Form\LangueType;
use App\Repository\LangueRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LangueController extends Controller
{
    /**
     * @Route("/langue", name="langue")
     */
    public function index()
    {
        return $this->render('langue/index.html.twig', [
            'controller_name' => 'LangueController',
        ]);
    }

    

    /**
     * @Route("/langue/liste", name="langue_list")
     */
     public function list(LangueRepository $repository)
     {
         $langues = $repository->findAll();

         return $this->render('langue/list.html.twig', [
            'langues' => $langues
         ]);
     }

      /**
       * @Route("/langue/new", name="langue_new")
       * @Route("/langue/{id}/edit", name="langue_edit")
       */
      public function form(Langue $langue = null, Request $request, ObjectManager $manager)
      {
        // Si l'objet langue n'est pas instancié on crée un objet Langue
        if(!$langue){
            $langue = new Langue();
        }
        
        // On crée un form du type LangueType
        $form = $this->createForm(LangueType::class, $langue);
        
        // Si une requête POST existe le formulaire la gère
        $form->handleRequest($request);

        // Si le form a été envoyé et qu'il est valide on demande au manager de le persister puis de l'enregistrer
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($langue);
            $manager->flush();

            // Redirection vers la page de la langue créée
            return $this->redirectToRoute('langue_show', [
                'id' => $langue->getId()
            ]);
        }
        
            // renvoyer la page de création de la langue avec le formulaire
          return $this->render('langue/create.html.twig', [
            'formLang' => $form->createView(),
            'editMode' => $langue->getId() !== null
          ]);
      }

     /**
      * @Route("/langue/{id}", name="langue_show")
      */
      public function show(LangueRepository $repository, $id) {

        $langue = $repository->find($id);

          return $this->render('langue/show.html.twig', [
            'langue' => $langue
          ]);
      }

}
