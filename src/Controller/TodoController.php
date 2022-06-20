<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends AbstractController
{
    /**
     * @Route("/todo", name="todos")
     */
    public function index(Request $request): Response
    {
        $session =  $request->getSession();

        if (!$session->has('todos')) {
            $todos = [
                'Lundi' => 'faire les coures',
                'Mardi' => 'Aller danser',
                'Mercredi' => 'Aller à la plage'
            ];

            $session->set('todos', $todos);
        }
        $this->addFlash('error', "La liste des session vient d'être initialisé");



        return $this->render('todo/index.html.twig');
    }

    /**
     * @Route("/todo/add/{name}/{content}", name="todos.add")
     */
    public function add(Request $request, $name, $content): Response
    {

        $session = $request->getSession();
        if ($session->has('todos')) {

            $todos =  $session->get('todos');

            if (isset($todos[$name])) {
                $this->addFlash('error', "Le todo d'id $name existe déja dans la liste");
            } else {

                $todos[$name] = $content;
                $this->addFlash('success', "Le todo d'id $name à été ajouté dans la liste");
                $session->set('todos', $todos);
            }
        } else {

            $this->addFlash('error', "La liste des session n'est pas encore initialisé");
        }
        //$this->addFlash('error', "La liste des session vient d'être initialisé");
        return $this->redirectToRoute('todos');




       // return $this->render('todo/index.html.twig');
    }

    /**
     * @Route("/todo/update/{name}/{content}", name="todos.update")
     */

    public function update(Request $request, $name, $content): Response
    {
        $session = $request->getSession();
        if ($session->has('todos')) {

            $todos =  $session->get('todos');

            if (!isset($todos[$name])) {
                $this->addFlash('error', "Le todo d'id $name n'existe pas dans la liste");
            } else {

                $todos[$name] = $content;
                $this->addFlash('success', "Le todo d'id $name à été modifié dans la liste avec succès");
                $session->set('todos', $todos);
            }
        } else {

            $this->addFlash('error', "La liste des session n'est pas encore initialisé");
        }
        //$this->addFlash('error', "La liste des session vient d'être initialisé");
        return $this->redirectToRoute('todos');




        return $this->render('todo/index.html.twig');
    }

    /**
     * @Route("/todo/delete/{name}", name="todos.delete")
     */

    public function delete(Request $request, $name): Response
    {
        $session = $request->getSession();
        if ($session->has('todos')) {

            $todos =  $session->get('todos');

            if (!isset($todos[$name])) {
                $this->addFlash('error', "Le todo d'id $name n'existe pas dans la liste");
            } else {


                unset($todos[$name]);
                $this->addFlash('success', "Le todo d'id $name à été supprimé dans la liste avec succès");
                $session->set('todos', $todos);
            }
        } else {

            $this->addFlash('error', "La liste des session n'est pas encore initialisé");
        }
        //$this->addFlash('error', "La liste des session vient d'être initialisé");
        return $this->redirectToRoute('todos');




        return $this->render('todo/index.html.twig');
    }

    /**
     * @Route("/todo/reset/", name="todos.reset")
     */


    public function reset(Request $request): Response
    {
        $session = $request->getSession();


        $session->remove('todos');


        $this->addFlash('success', "La liste des session à été reinstallisé avec succès");
        return $this->redirectToRoute('todos');
    }
}
