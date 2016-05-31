<?php
/**
 * Created by PhpStorm.
 * User: eradris
 * Date: 31/05/16
 * Time: 14:53
 */

namespace restBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use restBundle\Entity\idee;
class IdeeController extends Controller
{
    public function getAction(Request $request)
    {
        $doctrine = $this->getDoctrine();
        $repository = $doctrine->getRepository('restBundle:idee');

        $id = $request->get('id');

        $idee = $repository->findById($id);

        if(!$idee)
        {
            throw $this->createNotFoundException(
                'No user for this login'
            );
        }

        else
        {
            $i = $idee[0];
            $arr['State'] = 'Get';
            $arr['Id'] = $i->getId();
            $arr['Titre'] = $i->getTitre();
            $arr['Contenu'] = $i->getContenu();

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
        $repository = $doctrine->getRepository('restBundle:idee');

        $titre  = $request->get('titre');
        $contenu = $request->get('contenu');

        if( !$titre || !$contenu)
        {
            throw $this->createNotFoundException(
                'Missing parameters in http request'
            );
        }

        $idee = $repository->findOneBy(
            array('titre' => $titre,'contenu' => $contenu));

        if($idee)
        {
            throw $this->createNotFoundException(
                'A idee with this login already exists'
            );
        }

        $i = new idee();
        $i  ->setTitre($titre)
            ->setContenu($contenu);
        $em->persist($i);
        $em->flush();

        $response = new Response();
        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set('Content-Type', 'text/html');

        return $response;
    }

    public function deleteAction(Request $request)
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $repository = $doctrine->getRepository('restBundle:idee');

        $id = $request->query->get('id');

        $idee = $repository->findById($id);

        if(!$idee)
        {
            throw $this->createNotFoundException(
                'No idee found for id '.$id
            );
        }
        else
        {
            $i = $idee[0];
            $em->remove($i);
            $em->flush();

            $response = new Response();
            $response->setStatusCode(Response::HTTP_OK);
            $response->headers->set('Content-Type', 'text/html');
        }
        return $response;
    }

    public function updateAction(Request $request)
    {
        $id = $request->query->get('id');
        $titre = $request->query->get('titre');
        $contenu = $request->query->get('contenu');

        $em = $this->getDoctrine()->getManager();
        $idee = $em->getRepository('restBundle:idee')->find($id);

        if (!$idee) {
            throw $this->createNotFoundException(
                'No idee found for id '.$id
            );
        }

        $idee->setTitre($titre)
             ->setContenu($contenu);
        $em->flush();

        $response = new Response();
        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set('Content-Type', 'text/html');

        return $response;
    }

}