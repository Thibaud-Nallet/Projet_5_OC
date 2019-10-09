<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditProfilType;
use App\Entity\PasswordUpdate;
use App\Form\RegistrationType;
use App\Form\PasswordUpdateType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * Permet d'afficher le formulaire d'inscription
     * @Route("/inscription", name="security_registration")
     * @return Response
     */
    public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $manager->persist($user);
            $manager->flush();
            $this->addFlash('success', "Votre compte a bien été créé ! Connectez-vous !");
            return $this->redirectToRoute('security_login');
        }
        return $this->render('security/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet d'afficher et gérer le formulaire de connexion
     * @Route("/connexion", name="security_login")
     * @return Response
     */
    public function login(AuthenticationUtils $utils)
    {
        //Affiche une erreur si l'inscription échoue
        $error = $utils->getLastAuthenticationError();
        $username = $utils->getLastUsername();
        return $this->render('security/login.html.twig', [
            'hasError' => $error !==  null,
            'username' => $username
        ]);
    }

    /**
     * Permet de se déconnecter
     * @Route("/deconnexion", name="security_logout")
     * @return void
     */
    public function logout()
    { }

    /**
     * Permet de traiter et d'afficher un formulaire d'édition
     * @Route("/profil/edit", name="security_edit")
     * @return Response
     */
    public function profilEdit(Request $request, ObjectManager $manager) {
        $user = $this->getUser();
        $form = $this->createForm(EditProfilType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($user);
            $manager->flush();
            $this->addFlash('success', "Modification enregistrée !");
        }
        return $this->render('security/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet de modifier le mot de passe
     * @Route("/profil/edit-password", name="security_editPassword")
     * @return Response
     */
    public function updatePassword(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder) {
        $passwordUpdate = new PasswordUpdate();
        $user = $this->getUser();
        $form = $this->createForm(PasswordUpdateType::class, $passwordUpdate);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //1. Verifier que le old password soit le même que le password de l'user
            if(!password_verify($passwordUpdate->getOldPassword(), $user->getPassword())) {
                //Gère l'erreur
                $form->get('oldPassword')->addError(new FormError("Le mot de passe n'est pas l'actuel"));
            } else {
                $newPassword = $passwordUpdate->getNewPassword();
                $hash = $encoder->encodePassword($user, $newPassword);
                $user->setPassword($hash);
                $manager->persist($user);
                $manager->flush();
            }
            $this->addFlash('success', "Mot de passe modifiés !");
            return $this->redirectToRoute('security_edit');
        }
        return $this->render('security/password.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
