<?php


namespace App\Controller;

use App\Repository\ClientRepository;
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
    public function index(ClientRepository $clientRepository): Response
    {
        return $this->render('reservation/index.html.twig', [
            'clients' => $clientRepository->findAll(),
        ]);
    }
}
