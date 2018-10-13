<?php
namespace App\Controller;
use App\Entity\Jedi;
use App\Form\JediType;
use App\Repository\JediRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/admin/jedi")
 */
class JediController extends AbstractController
{
    /**
     * @Route("/", name="jedi_index", methods="GET")
     */
    public function index(JediRepository $jediRepository): Response
    {
        return $this->render('jedi/index.html.twig', ['jedis' => $jediRepository->findAll()]);
    }
    /**
     * @Route("/new", name="jedi_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $jedi = new Jedi();
        $form = $this->createForm(JediType::class, $jedi);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($jedi);
            $em->flush();
            return $this->redirectToRoute('jedi_index');
        }
        return $this->render('jedi/new.html.twig', [
            'jedi' => $jedi,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}", name="jedi_show", methods="GET")
     */
    public function show(Jedi $jedi): Response
    {
        return $this->render('jedi/show.html.twig', ['jedi' => $jedi]);
    }
    /**
     * @Route("/{id}/edit", name="jedi_edit", methods="GET|POST")
     */
    public function edit(Request $request, Jedi $jedi): Response
    {
        $form = $this->createForm(JediType::class, $jedi);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('jedi_edit', ['id' => $jedi->getId()]);
        }
        return $this->render('jedi/edit.html.twig', [
            'jedi' => $jedi,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}", name="jedi_delete", methods="DELETE")
     */
    public function delete(Request $request, Jedi $jedi): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jedi->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($jedi);
            $em->flush();
        }
        return $this->redirectToRoute('jedi_index');
    }
}