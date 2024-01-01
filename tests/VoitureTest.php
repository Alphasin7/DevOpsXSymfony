<?php

namespace App\Tests;


use App\Entity\Voiture;
use App\Entity\Modele;
use PHPUnit\Framework\TestCase;

class VoitureTest extends TestCase
{
    public function testGetSetSerie()
    {
        $voiture = new Voiture();
        $serie = 'ABC123';

        $voiture->setSerie($serie);

        $this->assertEquals($serie, $voiture->getSerie());
    }

    public function testGetSetDateMiseEnMarche()
    {
        $voiture = new Voiture();
        $dateMiseEnMarche = new \DateTime('2022-01-01');

        $voiture->setDateMiseEnMarche($dateMiseEnMarche);

        $this->assertEquals($dateMiseEnMarche, $voiture->getDateMiseEnMarche());
    }

    public function testGetSetModele()
    {
        $voiture = new Voiture();
        $modele = 'Model X';

        $voiture->setModele($modele);

        $this->assertEquals($modele, $voiture->getModele());
    }

    public function testGetSetPrixJour()
    {
        $voiture = new Voiture();
        $prixJour = 50.00;

        $voiture->setPrixJour($prixJour);

        $this->assertEquals($prixJour, $voiture->getPrixJour());
    }

    public function testGetSetMarque()
    {
        $voiture = new Voiture();
        $modele = new Modele(); // You may need to adjust this instantiation based on your Modele entity

        $voiture->setMarque($modele);

        $this->assertEquals($modele, $voiture->getMarque());
    }
}
