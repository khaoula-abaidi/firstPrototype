<?php

namespace App\Controller;

use App\Entity\Contributor;
use App\Form\ContributorType;
use App\Repository\ContributorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contributor")
 */
class ContributorController extends AbstractController
{
    /**
     * @Route("/", name="contributor_index", methods={"GET"})
     */
    public function index(ContributorRepository $contributorRepository): Response
    {
        return $this->render('contributor/index.html.twig', [
            'contributors' => $contributorRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="contributor_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $contributor = new Contributor();
        $form = $this->createForm(ContributorType::class, $contributor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contributor);
            $entityManager->flush();

            return $this->redirectToRoute('contributor_index');
        }

        return $this->render('contributor/new.html.twig', [
            'contributor' => $contributor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contributor_show", methods={"GET"})
     */
    public function show(Contributor $contributor): Response
    {
        return $this->render('contributor/show.html.twig', [
            'contributor' => $contributor,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="contributor_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Contributor $contributor): Response
    {
        $form = $this->createForm(ContributorType::class, $contributor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('contributor_index', [
                'id' => $contributor->getId(),
            ]);
        }

        return $this->render('contributor/edit.html.twig', [
            'contributor' => $contributor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contributor_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Contributor $contributor): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contributor->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($contributor);
            $entityManager->flush();
        }

        return $this->redirectToRoute('contributor_index');
    }
}
