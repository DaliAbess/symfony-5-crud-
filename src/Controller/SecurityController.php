<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Session\Session;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils ): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        //////////////////////////sessions 
                // Check if the login was successful
                if (null === $error) {
                    // Get the user object (assuming you have a custom User class)
                    $client = $this->getUser();
        
                    // Set user-related information in session
                    $session =new Session() ;
                   // $session->set('user_id', $client->getId());
                    //$session->set('user_email', $client->getEmail());
        
                
        
                    // Redirect to a success page or wherever you want
                    return $this->redirectToRoute('app_home');
                }
        
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(SessionInterface $session): void
    {    
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
