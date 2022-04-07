<?php

namespace App\Controller;

use App\Entity\Agent;

use App\Form\AgentType;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/responsable")
 */
class ResponsableController extends AbstractController
{
    private $userPasswordEncoder;
    public function __construct( UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }
    /**
     * @Route("/", name="app_responsable_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('responsable/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_responsable_new", methods={"GET", "POST"})
     */
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $user = new Agent();
        $form = $this->createForm(AgentType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($user->getPassword()) {
                $user->setPassword(
                    $this->userPasswordEncoder->encodePassword($user, $user->getPassword())
                );
                $user->eraseCredentials();
            }
            $roles[]='ROLE_RESPONSABLE';
            $user->setRoles($roles);
            $userRepository->add($user);
            return $this->redirectToRoute('app_responsable_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('responsable/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_responsable_show", methods={"GET"})
     */
    public function show(Agent $user): Response
    {
        return $this->render('responsable/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_responsable_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Agent $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(AgentType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user);
            return $this->redirectToRoute('app_responsable_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('responsable/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_responsable_delete", methods={"POST"})
     */
    public function delete(Request $request, Agent $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user);
        }

        return $this->redirectToRoute('app_responsable_index', [], Response::HTTP_SEE_OTHER);
    }
}
