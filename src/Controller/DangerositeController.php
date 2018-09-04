<?php

namespace App\Controller;

use App\Entity\Dangerosite;
use App\Form\DangerositeType;
use App\Repository\DangerositeRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DangerositeController extends Controller
{
    /**
     * @Route("/dangerosite", name="dangerosite")
     */
    public function index()
    {
        return $this->render('dangerosite/index.html.twig', [
            'controller_name' => 'DangerositeController',
        ]);
    }


    /**
     * @Route("/dangerosite/list", name="dangerosite_list")
     */
    public function list(DangerositeRepository $repository)
    {
        $dangerosites = $repository->findAll();

        return $this->render('dangerosite/list.html.twig', [
            'dangerosites' => $dangerosites
        ]);
    }

    /**
     * @Route("/dangerosite/{id}/delete", name="dangerosite_delete", methods={"POST"})
     */
    public function delete(DangerositeRepository $repository, ObjectManager $manager, $id){

        $dangerosite = $repository->find($id);
        $manager->remove($dangerosite);
        $manager->flush();
        $this->addFlash('message', 'Elément supprimé');

        return $this->redirectToRoute('dangerosite_list');
    }

     /**
      * @Route("/dangerosite/new", name="dangerosite_new")
      * @Route("/dangerosite/{id}/edit", name="dangerosite_edit")
      */
     public function form(Dangerosite $dangerosite = null, Request $request, ObjectManager $manager)
     {
        if(!$dangerosite){
            $dangerosite = new Dangerosite();
        }

        $form = $this->createForm(DangerositeType::class, $dangerosite);

        $form->handleRequest($request);

        // Si le formulaire est envoyé et est valide, on persiste et on enregistre
        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($dangerosite);
            $manager->flush();

            // redirection à la nouvelle page
            return $this->redirectToRoute('dangerosite_show', [
                'id' => $dangerosite->getId()
            ]);
        }

        return $this->render('dangerosite/create.html.twig', [
                'formDangerosite' => $form->createView(),
                'editMode' => $dangerosite->getId() !== null
            ]);
    }       

    /**
     * @Route("/dangerosite/{id}", name="dangerosite_show")
     */
     public function show(DangerositeRepository $repository, $id) {

        $dangerosite = $repository->find($id);

        return $this->render('dangerosite/show.html.twig', [
            'dangerosite' => $dangerosite
        ]);
     }
}
