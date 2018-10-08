<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\JediRepository;
use App\Entity\Jedi;

class ProductController extends AbstractController
{
    /**
     * @Route("/product/{productId}", name="product")
     */
    
    public function index(Request $request, $productId = 0)
    {

        $jedi = $this->getDoctrine()
            ->getRepository(Jedi::class)
            ->find($productId);

            $jedi->incrementViewCounter();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($jedi);
            $entityManager->flush();
       
        return $this->render('product/index.html.twig', [
            'jedi' => $jedi,
        ]);
    }
}
