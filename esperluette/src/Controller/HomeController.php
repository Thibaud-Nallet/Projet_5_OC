<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Caroussel;
use App\Repository\CarousselRepository;

class HomeController extends AbstractController
{

    /**
     * @var CarousselRepository
     */
    private $repository;

    public function __construct(CarousselRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        /* COMMANDE POUR INSERER MANUELLEMENT DANS LA BDD
        $caroussel = new Caroussel;
        $caroussel->setSrcImage('images/logo.png');
        $caroussel->setAltImage('Image !!');
        $entity_manager = $this->getDoctrine()->getManager();
        $entity_manager->persist($caroussel);
        $entity_manager->flush();*/

        $caroussel = $this->repository->find(1);
       
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'caroussel' => $caroussel
        ]);
    }
}
