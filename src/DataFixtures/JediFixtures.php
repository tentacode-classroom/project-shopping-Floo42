<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Jedi;
use App\Entity\Species;

class JediFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $species1 = new Species();
        $species1->setName("Humain");

        $species2 = new Species();
        $species2->setName("Unknown");

        
        $jedi1 = new Jedi();
        $jedi1->setName('Yoda');
        $jedi1->setSaberColor('Vert');
        $jedi1->setDescription("Petit être vert");
        $jedi1->setSpecies($species2);
        $jedi1->setPrice(500);
        
        $jedi2 = new Jedi();
        $jedi2->setName('Qui-gon Jinn');
        $jedi2->setSaberColor('Vert');
        $jedi2->setDescription("");
        $jedi2->setSpecies($species1);
        $jedi2->setPrice(400);

        $jedi3 = new Jedi();
        $jedi3->setName('Mace Windu');
        $jedi3->setSaberColor('Violet');
        $jedi3->setDescription("Porté disparu");
        $jedi3->setSpecies($species1);
        $jedi3->setPrice(350);

        $jedi4 = new Jedi();
        $jedi4->setName('Anakin');
        $jedi4->setSaberColor('Bleu');
        $jedi4->setDescription("Le supposé élu");
        $jedi4->setSpecies($species1);
        $jedi4->setPrice(350);

        $manager->persist($jedi1);
        $manager->persist($jedi2);
        $manager->persist($jedi3);
        $manager->persist($jedi4);
        $manager->flush();
    }
}
