<?php
/**
 * Created by PhpStorm.
 * User: eradris
 * Date: 31/05/16
 * Time: 16:21
 */

namespace restBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use restBundle\Entity\commentaire;
class CommentaireController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function getAction(Request $request)
    {
        $doctrine = $this->getDoctrine();
        $repository = $doctrine->getRepository('restBundle:commentaire');

        $id = $request->get('id');

        $com = $repository->findById($id);

        if (!$com) {
            throw $this->createNotFoundException(
                'No com for this id' . $id
            );
        } else {
            $i = $com[0];
            $arr['State'] = 'Get';
            $arr['Id'] = $i->getId();
            $arr['Contenu'] = $i->getContenu();

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
        $repository = $doctrine->getRepository('restBundle:commentaire');

        $contenu = $request->get('contenu');

        if (!$contenu) {
            throw $this->createNotFoundException(
                'Missing parameters in http request'
            );
        }

        $c = new commentaire();
        $c->setContenu($contenu);
        $em->persist($c);
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
        $repository = $doctrine->getRepository('restBundle:commentaire');

        $id = $request->query->get('id');

        $com = $repository->findById($id);

        if (!$com) {
            throw $this->createNotFoundException(
                'No idee found for id ' . $id
            );
        } else {
            $c = $com[0];
            $em->remove($c);
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
        $id = $request->query->get('id');
        $contenu = $request->query->get('contenu');

        $em = $this->getDoctrine()->getManager();
        $com = $em->getRepository('restBundle:commentaire')->find($id);

        if (!$com) {
            throw $this->createNotFoundException(
                'No commenatre found for id ' . $id
            );
        }
        else{
            $com->setContenu($contenu);
            $em->flush();

            $response = new Response();
            $response->setStatusCode(Response::HTTP_OK);
            $response->headers->set('Content-Type', 'text/html');

            return $response;
        }
    }
}