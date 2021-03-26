<?php

namespace App\Controller;

use App\Entity\PositionObstacle;
use App\Form\PositionObstacleType;
use App\Repository\PositionObstacleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/position/obstacle")
 */
class PositionObstacleController extends AbstractController
{
    /**
     * @Route("/", name="position_obstacle_index", methods={"GET"})
     */
    public function index(PositionObstacleRepository $positionObstacleRepository): Response
    {
        return $this->render('position_obstacle/index.html.twig', [
            'position_obstacles' => $positionObstacleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="position_obstacle_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $positionObstacle = new PositionObstacle();
        $form = $this->createForm(PositionObstacleType::class, $positionObstacle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($positionObstacle);
            $entityManager->flush();

            return $this->redirectToRoute('position_obstacle_index');
        }

        return $this->render('position_obstacle/new.html.twig', [
            'position_obstacle' => $positionObstacle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="position_obstacle_show", methods={"GET"})
     */
    public function show(PositionObstacle $positionObstacle): Response
    {
        return $this->render('position_obstacle/show.html.twig', [
            'position_obstacle' => $positionObstacle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="position_obstacle_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PositionObstacle $positionObstacle): Response
    {
        $form = $this->createForm(PositionObstacleType::class, $positionObstacle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('position_obstacle_index');
        }

        return $this->render('position_obstacle/edit.html.twig', [
            'position_obstacle' => $positionObstacle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="position_obstacle_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PositionObstacle $positionObstacle): Response
    {
        if ($this->isCsrfTokenValid('delete'.$positionObstacle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($positionObstacle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('position_obstacle_index');
    }
}
