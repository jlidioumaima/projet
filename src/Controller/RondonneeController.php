<?php

namespace App\Controller;

use App\Entity\Rondonnee;
use App\Form\RondonneeType;
use App\Repository\RondonneeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rondonnee")
 */
class RondonneeController extends AbstractController
{
    /**
     * @Route("/", name="app_rondonnee_index", methods={"GET"})
     */
    public function index(RondonneeRepository $rondonneeRepository): Response
    {
        return $this->render('rondonnee/index.html.twig', [
            'rondonnees' => $rondonneeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_rondonnee_new", methods={"GET", "POST"})
     */
    public function new(Request $request, RondonneeRepository $rondonneeRepository): Response
    {
        $rondonnee = new Rondonnee();
        $form = $this->createForm(RondonneeType::class, $rondonnee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rondonneeRepository->add($rondonnee);
            return $this->redirectToRoute('app_rondonnee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rondonnee/new.html.twig', [
            'rondonnee' => $rondonnee,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_rondonnee_show", methods={"GET"})
     */
    public function show(Rondonnee $rondonnee): Response
    {
        return $this->render('rondonnee/show.html.twig', [
            'rondonnee' => $rondonnee,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_rondonnee_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Rondonnee $rondonnee, RondonneeRepository $rondonneeRepository): Response
    {
        $form = $this->createForm(RondonneeType::class, $rondonnee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rondonneeRepository->add($rondonnee);
            return $this->redirectToRoute('app_rondonnee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rondonnee/edit.html.twig', [
            'rondonnee' => $rondonnee,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_rondonnee_delete", methods={"POST"})
     */
    public function delete(Request $request, Rondonnee $rondonnee, RondonneeRepository $rondonneeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rondonnee->getId(), $request->request->get('_token'))) {
            $rondonneeRepository->remove($rondonnee);
        }

        return $this->redirectToRoute('app_rondonnee_index', [], Response::HTTP_SEE_OTHER);
    }
}
