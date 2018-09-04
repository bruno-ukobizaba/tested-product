<?php

namespace App\Controller;

use App\Entity\ProduitTeste;
use App\Form\ProduitTesteType;
use App\Repository\ProduitTesteRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProduitTesteController extends Controller
{

    /**
     * @Route("/", name="produit_teste_home")
     */
    public function home()
    {
        return $this->render('produit_teste/home.html.twig');

    }
    
    /**
     * @Route("/produits-testes", name="produit_teste_index")
     */
    public function index()
    {
        return $this->render('produit_teste/index.html.twig');
    }

    /**
     * @Route("/produits-testes/new", name="produit_teste_new")
     * @Route("/produits-testes/{id}/edit", name="produit_teste_edit")
     */
    public function form(ProduitTeste $produitTeste = null, Request $request, ObjectManager $manager)
    {
        if(!$produitTeste){
            $produitTeste = new ProduitTeste();
        }

        $formProduitTeste = $this->createForm(ProduitTesteType::class, $produitTeste);

        $formProduitTeste->handleRequest($request);

        if($formProduitTeste->isSubmitted() && $formProduitTeste->isValid())
        {
            if(!$produitTeste->getId())
            {
                $produitTeste->setCreatedAt(new \DateTime());
            }else{
                $produitTeste->setModifiedAt(new \DateTime());           
            }

            $manager->persist($produitTeste);
            $manager->flush();

            return $this->redirectToRoute('produit_teste_show', [
                'id' => $produitTeste->getId()
            ]);
        }
        
        return $this->render('produit_teste/create.html.twig', [
            'formProduitTeste' => $formProduitTeste->createView(),
            'editMode' => $produitTeste->getId() !== null
        ]);
    }

	/**
	*@Route("/produits-testes/list", name="produit_teste_list")
	*/	
	public function list(ProduitTesteRepository $repository)
    {
        $produitTestes = $repository->findAll();
        
        return $this->render('produit_teste/list.html.twig', [
            'produitTestes' => $produitTestes
        ]);
    }

	
	/**
	*@Route("/produits-testes/{id}", name="produit_teste_show")
	*/	
	public function show(ProduitTeste $produitTeste)
    {
        return $this->render('produit_teste/show.html.twig', [
            'produitTeste' => $produitTeste 
        ]);
    }
	

}
