<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reservation")
 */

class ReservationController extends AbstractController
{
    /**
     * @Route("/", name="reservation", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('reservation/index.html.twig', [
        ]);
    }
}
