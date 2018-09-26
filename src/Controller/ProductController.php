<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\JediRepository;

class ProductController extends AbstractController
{
    /**
     * @Route("/product/{productId}", name="product")
     */
    
    public function index(Request $request, $productId = 0)
    {
        $jediRepository = new JediRepository();
        $jedi = $jediRepository->findOneById($productId);

        return $this->render('product/index.html.twig', [
            'productId' => $productId,
            'jedi' => $jedi,
        ]);
    }
}
