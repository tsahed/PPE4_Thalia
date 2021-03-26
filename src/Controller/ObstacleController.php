<?php

namespace App\Controller;

use App\Entity\Obstacle;
use App\Form\ObstacleType;
use App\Repository\ObstacleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/obstacle")
 */
class ObstacleController extends AbstractController
{
    /**
     * @Route("/", name="obstacle_index", methods={"GET"})
     */
    public function index(ObstacleRepository $obstacleRepository): Response
    {
        return $this->render('obstacle/index.html.twig', [
            'obstacles' => $obstacleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="obstacle_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $obstacle = new Obstacle();
        $form = $this->createForm(ObstacleType::class, $obstacle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($obstacle);
            $entityManager->flush();

            return $this->redirectToRoute('obstacle_index');
        }

        return $this->render('obstacle/new.html.twig', [
            'obstacle' => $obstacle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="obstacle_show", methods={"GET"})
     */
    public function show(Obstacle $obstacle): Response
    {
        return $this->render('obstacle/show.html.twig', [
            'obstacle' => $obstacle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="obstacle_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Obstacle $obstacle): Response
    {
        $form = $this->createForm(ObstacleType::class, $obstacle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('obstacle_index');
        }

        return $this->render('obstacle/edit.html.twig', [
            'obstacle' => $obstacle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="obstacle_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Obstacle $obstacle): Response
    {
        if ($this->isCsrfTokenValid('delete'.$obstacle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($obstacle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('obstacle_index');
    }
}
