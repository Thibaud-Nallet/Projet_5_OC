<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig');
    }

    /**
     * Route pour la page des mentions légales
     * @Route("/mention-legale", name="mention_legale")
     */
    public function mentionLegale() {
        return $this->render('home/mentionLegale.html.twig');
    }

    /**
     * Route pour les conditions générales de vente
     * @Route("conditions-generales-de-vente", name="cgv")
     */
    public function cgv() {
        return $this->render('home/cgv.html.twig');
    }

    /**
     * Route pour les conditions générales de vente
     * @Route("politique-de-confidentialte", name="confidentialite")
     */
    public function confidentialite()
    {
        return $this->render('home/confidentialite.html.twig');
    }
}
