<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Form\VoitureForm;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoitureController extends AbstractController
{
    #[Route('/voiture', name: 'app_voiture')]
    public function listeVoiture(VoitureRepository $vr): Response
    {
        $voitures = $vr->findAll();
        return $this->render('voiture/listeVoiture.html.twig',
            ['listeVoiture' => $voitures,]);
    }

    #[Route('/addVoiture', name: 'addVoiture')]
    public function addVoiture(Request                $request,
                               EntityManagerInterface $em): Response
    {
        $voiture = new Voiture();
        $form = $this->createForm(VoitureForm::class, $voiture);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em->persist($voiture);
            $em->flush();
            return $this->redirectToRoute("app_voiture");
        }
        return $this->render("voiture/addVoiture.html.twig",
            ["formV" => $form->createView()]);

    }

    #[Route('voiture/{id}', name: 'voitureDelete')]
    public function delete(EntityManagerInterface $em, VoitureRepository $vr, $id): Response
    {
        $voiture = $vr->find($id);
        $em->remove($voiture);
        $em->flush();
        return $this->redirectToRoute('app_voiture');

    }

    #[Route('/updateVoiture/{id}', name: 'voitureUpdate')]
    public function updateVoiture(Request $request, EntityManagerInterface $em, VoitureRepository $vr, $id): Response
    {
        $voiture = $vr->find($id);
        $editform = $this->createForm(VoitureForm::class, $voiture);
        $editform->handleRequest($request);
        if ($editform->isSubmitted() and $editform->isValid()) {
            $em->persist($voiture);
            $em->flush();
            return $this->redirectToRoute('app_voiture');
        }
        return $this->render('voiture/updateVoiture.html.twig', [
            'editFormVoiture' => $editform->createView()
        ]);


    }

    #[Route('/searchVoiture', name: 'voitureSearch')]
    public function searchVoiture(Request $request, EntityManagerInterface $em): Response

    {
        $voitures = null;
        if ($request->isMethod('POST')) {
            $serie = $request->request->get("input_serie");
            $query = $em->createQuery(
                "SELECT v FROM App\Entity\Voiture v
                where v.serie LIKE'" . $serie . "'");
            $voitures = $query->getResult();
        }
        return $this->render("voiture/rechercheVoiture.html.twig", ["voitures" => $voitures]);
    }
    #[Route('/searchmarqueVoiture', name: 'voituremarqueSearch')]
    public function searchmarqueVoiture(Request $request, EntityManagerInterface $em): Response

    {
        $voitures = null;
        if ($request->isMethod('POST')) {
            $libelee = $request->request->get("input_libelee");
            $query = $em->createQuery(
                "SELECT v FROM App\Entity\Voiture v
                Join v.marque m where m.libelee LIKE'%" . $libelee . "%'" );
            $voitures = $query->getResult();
        }
        return $this->render("voiture/recherchemarqueVoiture.html.twig", ["voitures" => $voitures]);
    }
}