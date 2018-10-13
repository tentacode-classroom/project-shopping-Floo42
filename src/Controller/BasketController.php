<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\Jedi;

class BasketController extends AbstractController
{
    /**
     * @Route("/panier", name="basket_list")
     */
    public function index(SessionInterface $session)
    {
        $basketProducts = $session->get('basket_products', []);
        $jediRepository = $this->getDoctrine()->getRepository(Jedi::class);
        
        $jedis = [];
        foreach($basketProducts as $productId) {
            $jedi = $jediRepository->find($productId);
            $jedis[] = $jedi;
        }
        return $this->render('basket/index.html.twig', [
            'basket_products' => $jedis,
        ]);
    }
    /**
     * @Route("/panier/ajouter/{productId}", name="basket_add")
     */
    public function add(int $productId, SessionInterface $session)
    {
        $basketProducts = $session->get('basket_products', []);
        if (!in_array($productId, $basketProducts)) {
            $basketProducts[] = $productId;
            $this->addFlash(
                'notice',
                "Vous venez d'ajouter un produit au panier"
            );
        }
        $session->set('basket_products', $basketProducts);
        return $this->redirectToRoute('basket_list');
    }
    /**
     * @Route("/panier/supprimer/{productId}", name="basket_remove")
     */
    public function remove(int $productId, SessionInterface $session)
    {
        $basketProducts = $session->get('basket_products', []);
        
        $productIndex = array_search($productId, $basketProducts);
        if (false !== $productIndex) {
            unset($basketProducts[$productIndex]);
            $this->addFlash(
                'notice',
                "Vous venez de retirer un produit du panier"
            );
        }
        $session->set('basket_products', $basketProducts);
        return $this->redirectToRoute('basket_list');
    }
}
