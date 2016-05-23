<?php

namespace restBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use restBundle\Entity\utilisateur;
class DefaultController extends Controller
{
    public function indexAction($foo)
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $repository = $doctrine->getRepository('restBundle:utilisateur');

        $users = $repository->findByLogin($foo);

        if(!$users)
        {
            $u = new utilisateur();
            $u  ->setLogin($foo)
                    ->setPassword($foo."_password")
                    ->setMail($foo."@test.fr")
                    ->setNom("nom")
                    ->setPrenom("prenom");
            $em->persist($u);
            $em->flush();
            $arr['State'] = 'Create';
        }
        else
        {
            $u = $users[0];
            $arr['State'] = 'Get';
        }


        $arr['Id'] = $u->getId();
        $arr['Login'] = $u->getLogin();
        $arr['Password'] = $u->getPassword();
        $arr['Mail'] = $u->getMail();
        $arr['Nom'] = $u->getNom();
        $arr['Prenom'] = $u->getPrenom();
        
        $response = new Response();
        $response->setContent(json_encode($arr));
        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set('Content-Type', 'text/html');
        
        return $response;
    }
}
