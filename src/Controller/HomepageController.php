<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Jedi;
use App\Repository\JediRepository;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */

   
    public function index()
    {
        $jedis = $this->getDoctrine()
        ->getRepository(Jedi::class)
        ->findAllJedisHomepage();

        return $this->render('homepage/index.html.twig', [
            'jedis' => $jedis,
        ]);
    }
}
