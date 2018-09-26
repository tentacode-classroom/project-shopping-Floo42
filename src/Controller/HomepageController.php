<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use src\Entity\Jedi;
use App\Repository\JediRepository;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */

   

    public function index()
    {

        $jediRepository = new JediRepository();
        $jedis = $jediRepository->findAll();

        return $this->render('homepage/index.html.twig', [
            'jedis' => $jedis,
        ]);
    }
}
