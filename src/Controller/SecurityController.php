<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Public\UserType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

#[Route("/public")]
class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }


    #[Route("/signup", name: "app_signup")]
    public function signup(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): RedirectResponse|Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($passwordHasher->hashPassword($user, $form->getData()->getPassword()));
            $user->setCreatedAt(new DateTime());
            $user->setRoles(["ROLE_USER"]);
            $user->getAddress()->setIsEnabled(true);
            $user->getAddress()->setCreatedAt(new DateTime());
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash("success", "Votre compte a bien été créer");
            return $this->redirectToRoute("app_login");
        }
        return $this->render("security/signup.html.twig", [
            "form" => $form->createView()
        ]);
    }

    #[route("/{id}", name: "app_edit_profile")]
    public function editProfile(User $user, Request $request)
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setUpdatedAt(new DateTime());
            $this->addFlash("success", "Votre profile a bien été édité");
            return $this->redirectToRoute("home");
        }
        return $this->render("security/profile.html.twig", [
            "form"=> $form->createView()
        ]);
    }


    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        throw new LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
