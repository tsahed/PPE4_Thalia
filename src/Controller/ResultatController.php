<?php
namespace App\Controller;

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
    public function index(): Response
    {
        return $this->render('resultat/index.html.twig', [
        ]);
    }
}