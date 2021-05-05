<?php
namespace App\Controller;

use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/resultat")
 */

class ResultatController extends AbstractController
{
    /**
     * @Route("/", name="resultat", methods={"GET"})
     */
    public function index(ClientRepository $clientRepository): Response
    {
        return $this->render('resultat/index.html.twig', [
            'clients' => $clientRepository->findAll(),
        ]);
    }

    /**
     * @Route("/", name="res_p2", methods={"GET"})
     */
    public function res_p2(): Response
    {
        return $this->render('resultat/res.html.twig', [
        ]);
    }
}