<?php

namespace restBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use restBundle\Entity\utilisateur;
class DefaultController extends Controller
{
    public function showAction(Request $request)
    {
        $doctrine = $this->getDoctrine();
        $repository = $doctrine->getRepository('restBundle:utilisateur');

        $foo = $request->query->get('foo');

        $users = $repository->findByLogin($foo);

        if(!$users)
        {
            throw $this->createNotFoundException(
                'No user found for Login '.$foo
            );
        }
        else
        {
            $u = $users[0];
            $arr['State'] = 'Get';
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
        }

        return $response;
    }

    public function addAction(Request $request)
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $repository = $doctrine->getRepository('restBundle:utilisateur');

        $foo = $request->get('login');

        if(!$foo)
        {
            throw $this->createNotFoundException(
                'missing parameters in http request: login is null'
            );
        }

        $users = $repository->findByLogin($foo);
        if($users)
        {
            throw $this->createNotFoundException(
                'A user with this login already exists'
            );
        }

        $u = new utilisateur();
        $u->setLogin($foo)
            ->setPassword($foo.'_password')
            ->setMail($foo.'@test.fr')
            ->setNom('nom')
            ->setPrenom('prenom');
        $em->persist($u);
        $em->flush();

        $users = $repository->findByLogin($foo);
        if(!$users)
        {
            throw $this->createNotFoundException(
                'No user found for Login:'.$foo
            );
        }
        else
        {
            $u = $users[0];
            $arr['State'] = 'Created';
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
        }

        return $response;
    }
}
