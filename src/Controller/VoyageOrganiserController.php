<?php

namespace App\Controller;

use App\Entity\VoyageOrganiser;
use App\Form\VoyageOrganiserType;
use App\Repository\VoyageOrganiserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/voyage/organiser")
 */
class VoyageOrganiserController extends AbstractController
{
    /**
     * @Route("/", name="app_voyage_organiser_index", methods={"GET"})
     */
    public function index(VoyageOrganiserRepository $voyageOrganiserRepository): Response
    {
        return $this->render('voyage_organiser/index.html.twig', [
            'voyage_organisers' => $voyageOrganiserRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_voyage_organiser_new", methods={"GET", "POST"})
     */
    public function new(Request $request, VoyageOrganiserRepository $voyageOrganiserRepository): Response
    {
        $voyageOrganiser = new VoyageOrganiser();
        $form = $this->createForm(VoyageOrganiserType::class, $voyageOrganiser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $voyageOrganiserRepository->add($voyageOrganiser);
            return $this->redirectToRoute('app_voyage_organiser_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('voyage_organiser/new.html.twig', [
            'voyage_organiser' => $voyageOrganiser,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_voyage_organiser_show", methods={"GET"})
     */
    public function show(VoyageOrganiser $voyageOrganiser): Response
    {
        return $this->render('voyage_organiser/show.html.twig', [
            'voyage_organiser' => $voyageOrganiser,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_voyage_organiser_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, VoyageOrganiser $voyageOrganiser, VoyageOrganiserRepository $voyageOrganiserRepository): Response
    {
        $form = $this->createForm(VoyageOrganiserType::class, $voyageOrganiser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $voyageOrganiserRepository->add($voyageOrganiser);
            return $this->redirectToRoute('app_voyage_organiser_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('voyage_organiser/edit.html.twig', [
            'voyage_organiser' => $voyageOrganiser,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_voyage_organiser_delete", methods={"POST"})
     */
    public function delete(Request $request, VoyageOrganiser $voyageOrganiser, VoyageOrganiserRepository $voyageOrganiserRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voyageOrganiser->getId(), $request->request->get('_token'))) {
            $voyageOrganiserRepository->remove($voyageOrganiser);
        }

        return $this->redirectToRoute('app_voyage_organiser_index', [], Response::HTTP_SEE_OTHER);
    }
}
