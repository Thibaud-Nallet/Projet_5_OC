<?php

namespace App\Controller;

use App\Service\StatService;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminDashboardController extends AbstractController
{
    /**
     * @Route("/admin/", name="admin_dashboard")
     */
    public function dashboard(ObjectManager $manager, StatService $statService)
    {
        $stats = $statService->getCount();
        $lastProducts = $statService->getLastProducts();
        
        return $this->render('admin/dashboard/dashboard.html.twig', [
            'stats' => $stats,
            'lastProducts' => $lastProducts
        ]);
    }
}
