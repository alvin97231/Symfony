<?php
/**
 * Created by PhpStorm.
 * User: cedric
 * Date: 30/05/16
 * Time: 22:11
 */
namespace restBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use restBundle\Entity\utilisateur;


/**
 * Class UtilisateurController
 * @package restBundle\Controller
 */
class UtilisateurController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function getAction(Request $request)
    {
        $doctrine = $this->getDoctrine();
        $repository = $doctrine->getRepository('restBundle:utilisateur');

        $login = $request->query->get('login');
        $pwd = $request->query->get('pwd');

        if(!$login || !$pwd)
        {
            throw $this->createNotFoundException(
                'Missing parameters in HTTP request'
            );
        }

        $users = $repository->findByLogin($login);

        if(!$users)
        {
            throw $this->createNotFoundException(
                'No user for this login'
            );
        }
        else if($users[0]->getPassword() != $pwd)
        {
            throw $this->createNotFoundException(
                'Wrong password !!'
            );
        }
        else
        {
            $u = $users[0];
            $arr['Login'] = $u->getLogin();
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

    /**
     * @param Request $request
     * @return Response
     */
    public function addAction(Request $request)
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $repository = $doctrine->getRepository('restBundle:utilisateur');

        $login  =    $request->get('login');
        $pwd    =    $request->get('pwd');
        $prenom =    $request->get('prenom');
        $nom    =    $request->get('nom');
        $mail   =    $request->get('mail');

        if(!$login || !$pwd || !$prenom || !$nom || !$mail)
        {
            throw $this->createNotFoundException(
                'Missing parameters in HTTP request'
            );
        }

        $users = $repository->findByLogin($login);

        if($users)
        {
            throw $this->createNotFoundException(
                'A user with this login already exists'
            );
        }

        $u = new utilisateur();
        $u  ->setLogin($login)
            ->setPassword($pwd)
            ->setMail($mail)
            ->setNom($nom)
            ->setPrenom($prenom);
        $em->persist($u);
        $em->flush();

        $response = new Response();
        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set('Content-Type', 'text/html');

        return $response;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function deleteAction(Request $request)
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $repository = $doctrine->getRepository('restBundle:utilisateur');

        $login = $request->query->get('login');
        $pwd = $request->query->get('pwd');

        $users = $repository->findByLogin($login);
        if(!$login || !$pwd)
        {
            throw $this->createNotFoundException(
                'Missing parameters in HTTP request'
            );
        }
        else if(!$users)
        {
            throw $this->createNotFoundException(
                'No user found for Login '.$login
            );
        }
        else if($users[0]->getPassword() != $pwd)
        {
            throw $this->createNotFoundException(
                'Wrong password'
            );
        }
        else
        {
            $u = $users[0];
            $em->remove($u);
            $em->flush();

            $response = new Response();
            $response->setStatusCode(Response::HTTP_OK);
            $response->headers->set('Content-Type', 'text/html');
        }
        return $response;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function updateAction(Request $request)
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $repository = $doctrine->getRepository('restBundle:utilisateur');

        $login  =    $request->get('login');
        $pwd    =    $request->get('pwd');
        $prenom =    $request->get('prenom');
        $nom    =    $request->get('nom');
        $mail   =    $request->get('mail');

        if(!$login || !$pwd || !$prenom || !$nom || !$mail)
        {
            throw $this->createNotFoundException(
                'Missing parameters in http request'
            );
        }

        $users = $repository->findByLogin($login);

        if(!$users)
        {
            throw $this->createNotFoundException(
                'No user found for Login '.$login
            );
        }
        else if($users[0]->getPassword() != $pwd)
        {
            throw $this->createNotFoundException(
                'Wrong password'
            );
        }
        else
        {
            $u = $users[0];
            $u  ->setNom($nom)
                ->setPrenom($prenom)
                ->setMail($mail);
            $em->flush();

            $response = new Response();
            $response->setStatusCode(Response::HTTP_OK);
            $response->headers->set('Content-Type', 'text/html');
        }
        return $response;
    }

    public function loginAction(Request $request)
    {
        $login = $request->query->get('login');
        $pwd = $request->query->get('pwd');

        if(!$login || !$pwd)
        {
            throw $this->createNotFoundException(
                'Missing parameters in HTTP request'
            );
        }

        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $repository = $doctrine->getRepository('restBundle:utilisateur');
        
        $users = $repository->findOneBy(array('login' => $login,'password' => $pwd));

        $users->login($login,$this);

        $response = new Response();
        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set('Content-Type', 'text/html');

        return $response;
    }

    public function logoutAction(Request $request)
    {
        $deco = $request->query->get('deco');
        if($deco == true){
            logout();
        }
    }

    

}
