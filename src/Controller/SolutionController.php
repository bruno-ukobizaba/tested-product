<?php

namespace App\Controller;

use App\Entity\Solution;
use App\Form\SolutionType;
use App\Repository\SolutionRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SolutionController extends Controller
{
    /**
     * @Route("/solution", name="solution")
     */
    public function index()
    {
        return $this->render('solution/index.html.twig', [
            'controller_name' => 'SolutionController',
        ]);
    }

    /**
     * @Route("/solution/list", name="solution_list")
     */
    public function list(SolutionRepository $repository)
    {
        $solutions = $repository->findAll();

        return $this->render('solution/list.html.twig', [
            'solutions' => $solutions
        ]);
    }

     /**
      * @Route("/solution/new", name="solution_new")
      * @Route("/solution/{id}/edit", name="solution_edit")
      */
     public function form(Solution $solution = null, Request $request, ObjectManager $manager)
     {
         // Si l'objet solution n'existe pas on le crée
       if(!$solution){
           $solution = new Solution();
       }

       // On crée un formulaire de type SolutionType
       $form = $this->createForm(SolutionType::class, $solution);

       // Le formulaire gère la requête en POST
       $form->handleRequest($request);

       // Si le formulaire est envoyé et valide on enregistre et redirige
       if($form->isSubmitted() && $form->isValid()){

           $manager->persist($solution);
           $manager->flush();

            // redirection à la nouvelle page
           return $this->redirectToRoute('solution_show', [
               'id' => $solution->getId()
           ]);
       }

         return $this->render('solution/create.html.twig', [
             'formSolution' => $form->createView(),
             'editMode' => $solution->getId() !== null
         ]);
     }

    /**
     * @Route("/solution/{id}", name="solution_show")
     */
     public function show(SolutionRepository $repo, $id) {
       
         $solution = $repo->find($id);

         return $this->render('solution/show.html.twig', [
             'solution' => $solution
         ]);
     }
}
