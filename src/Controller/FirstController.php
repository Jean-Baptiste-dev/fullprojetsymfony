<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{

    /**
     * @Route("/first", name="app_first")
     */


    /*#[Route('/first', name: 'app_first')]*/

    public function index(): Response
    {


        return $this->render('first/index.html.twig');
    }

    /**
     * @Route("/session", name="session")
     */




    public function session(Request $request): Response
    {

        $session = $request->getSession();

        //dd($session);
        // $nbrevisite = 1;

        if ($session->has('nbvisite')) {

            // dd($session->has('nbvisite'));


            $nbrevisite = ($session->get('nbvisite') + 1);

            dd($nbrevisite);
        } else {
            $nbrevisite = 1;
        }

        $session->set('nbvisite', 'nbrevisite');

        return $this->render('first/index.html.twig');
    }
}
