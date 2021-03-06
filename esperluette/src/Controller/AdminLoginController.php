<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminLoginController extends AbstractController
{
    /**
     * @Route("/admin/login", name="admin_login")
     */
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        $username = $utils->getLastUsername();

        return $this->render('admin/login/login.html.twig', [
            'hasError' => $error !==  null,
            'username' => $username
        ]);
    }
    /**
     * Deconnecte l'admin
     * @Route("/admin/logout", name="admin_logout")
     * @return void
     */
    public function logout()
    {
        //
    }
}
