<?php

namespace App\Controller;

use App\Entity\Decision;
use App\Form\DecisionType;
use App\Repository\DecisionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DecisionController extends AbstractController
{
    /**
     * @Route("decision/", name="decision_index", methods={"GET"})
     */
    public function index(DecisionRepository $decisionRepository): Response
    {
        return $this->render('decision/index.html.twig', [
            'decisions' => $decisionRepository->findAll(),
        ]);
    }
    /**
     * @Route("decision/waiting", name = "decisionsWaiting")
     * @return Response
     */
    public function waiting(DecisionRepository $decisionRepository): Response
    {
        $decisions = $decisionRepository->findBy(['isTaken'=>false]);
        return $this->render('decision/waiting.html.twig',[
            'decisions' => $decisions
        ]);
    }
    /**
     * @Route("decision/new", name="decision_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $decision = new Decision();
        $form = $this->createForm(DecisionType::class, $decision);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($decision);
            $entityManager->flush();

            return $this->redirectToRoute('decision_index');
        }

        return $this->render('decision/new.html.twig', [
            'decision' => $decision,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("decision/{id}", name="decision_show", methods={"GET"})
     */
    public function show(Decision $decision): Response
    {
        return $this->render('decision/show.html.twig', [
            'decision' => $decision,
        ]);
    }

    /**
     * @Route("decision/{id}/edit", name="decision_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Decision $decision): Response
    {
        $form = $this->createForm(DecisionType::class, $decision);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('decision_index', [
                'id' => $decision->getId(),
            ]);
        }

        return $this->render('decision/edit.html.twig', [
            'decision' => $decision,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("decision/{id}", name="decision_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Decision $decision): Response
    {
        if ($this->isCsrfTokenValid('delete'.$decision->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($decision);
            $entityManager->flush();
        }

        return $this->redirectToRoute('decision_index');
    }


}
