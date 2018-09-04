<?php

namespace App\DataFixtures;

use App\Entity\Langue;
use App\Entity\Fichier;
use App\Entity\Solution;
use App\Entity\Dangerosite;
use App\Entity\ProduitTeste;
use App\Entity\Caracteristique;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProduitTesteFixtures extends Fixture
{
    public const CURR_SOLUTION = 'Solution Diphoterine®';
    public const CURR_DANGEROSITE = 'Toxique';

    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        // Ajouter Langue

    for($l = 0; $l <= 2; $l++){
            
            switch($l){
                case 0: $nom = 'Français'; $label ='fr'; break;
                case 1: $nom = 'Anglais'; $label ='en'; break;
                case 2: $nom = 'Allemand'; $label ='de'; break;
            }

            $langue = new Langue();

            $langue->setNom($nom)
                   ->setLabel($label)
                   ->setUrlImage($faker->imageUrl($width = 480, $height = 320))
                   ->setIsActive(true);
            $manager->persist($langue);


        // Ajouter Solution
        for($s=0;$s<= 2; $s++){
            switch($s){
                case 0 :
                $nom = 'Solution Diphotérine®';
                break;
                case 1 :
                $nom = 'Solution Hexafluorine®';
                break;
                case 2 :
                $nom = 'Absorbant Trivorex®';
                break;
            }

            $solution = New Solution();

            $solution->setNom($nom)
                    ->setIsActive(true)
                    ->setLangue($langue);

            $manager->persist($solution);

            $this->addReference(self::CURR_SOLUTION, $solution);
        }

        // Ajouter Dangerosite
        for($d=0; $d<=5; $d++){

                $dangerosite = new Dangerosite();

                $dangerosite ->setTypeDanger($faker->unique()->sentence)
                        ->setPhraseRisque($faker->unique()->sentence)
                        ->setUrlPicto($faker->imageUrl($width = 480, $height = 320))
                        ->setIsActive(true)
                        ->setLangue($langue);
                $manager->persist($dangerosite);
            $this->addReference(self::CURR_DANGEROSITE, $dangerosite);

        }
    }

                        // Ajouter ProduitTeste
                        for($p=0; $p<=15; $p++){

                            $produit = new ProduitTeste();
                            $produit->setIUPAC($faker->unique()->swiftBicNumber)
                                    ->setNumeroCAS($faker->unique()->ean8)
                                    ->setIsMelange(false)
                                    ->setCreatedAt(new \DateTime())
                                    ->setIsTested(true)
                                    ->setIsActive(true)
                                    ->setDangerosite($this->getReference($this->dangerosite))
                                    ->setSolution($this->getReference($this->solution));
    
                            $manager->persist($produit);
    
                            //Ajouter Fichier
                            for($f=0; $f <= mt_rand(1,2); $f++){
    
                                $fichier = new Fichier();
    
                                $fichier->setNom($faker->sentence)
                                        ->setUrl($faker->url)
                                        ->setCreatedAt(new \DateTime())
                                        ->setIsRestricted(false)
                                        ->setProduitTeste($produit);
                                
                                $manager->persist($fichier);
                            
                                // Ajouter Caracteristique
                                for($c=0; $c<=2; $c++)
                                {
                                    $caracteristique = new Caracteristique();
    
                                    $caracteristique->setNomChimique($faker->unique()->sentence)
                                                    ->setNomCommun($faker->unique()->sentence)
                                                    ->setNomCommercial($faker->unique()->sentence)
                                                    ->setDescription($faker->unique()->sentence)
                                                    ->setProduitTeste($produit)
                                                    ->setLangue($langue);
                                    $manager->persist($caracteristique);
                                }
    
                                
                            }
    
    
                    }
    


        $manager->flush();

    }
}
