<?php

namespace App\Controller;

use App\Entity\PhotoClient;
use App\Form\PhotoClientType;
use App\Repository\ClientRepository;
use App\Repository\PhotoClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/photo/client")
 */
class PhotoClientController extends AbstractController
{
    /**
     * @Route("/", name="photo_client_index", methods={"GET"})
     */
    public function index(ClientRepository $clientRepository,PhotoClientRepository $photoClientRepository): Response
    {
        return $this->render('photo_client/index.html.twig', [
            'photo_clients' => $photoClientRepository->findAll(),
            'clients' => $clientRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="photo_client_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $photoClient = new PhotoClient();
        $form = $this->createForm(PhotoClientType::class, $photoClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($photoClient);
            $entityManager->flush();

            return $this->redirectToRoute('photo_client_index');
        }

        return $this->render('photo_client/new.html.twig', [
            'photo_client' => $photoClient,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="photo_client_show", methods={"GET"})
     */
    public function show(PhotoClient $photoClient): Response
    {
        return $this->render('photo_client/show.html.twig', [
            'photo_client' => $photoClient,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="photo_client_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PhotoClient $photoClient): Response
    {
        $form = $this->createForm(PhotoClientType::class, $photoClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('photo_client_index');
        }

        return $this->render('photo_client/edit.html.twig', [
            'photo_client' => $photoClient,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="photo_client_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PhotoClient $photoClient): Response
    {
        if ($this->isCsrfTokenValid('delete'.$photoClient->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($photoClient);
            $entityManager->flush();
        }

        return $this->redirectToRoute('photo_client_index');
    }
}
