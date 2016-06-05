<?php
/**
 * Created by PhpStorm.
 * User: cedric
 * Date: 05/06/16
 * Time: 21:59
 */
namespace restBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use restBundle\Entity\vote_idee;
class Vote_IdeeController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function addAction(Request $request)
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $repcom = $doctrine->getRepository('restBundle:idee');
        $reputilisateur = $doctrine->getRepository('restBundle:utilisateur');

        $id_idee = $request->get('id_idee');
        $id_utilisateur = $request->get('id_utilisateur');

        if (!$id_utilisateur || !$id_idee) {
            throw $this->createNotFoundException(
                'Missing parameters in HTTP request'
            );
        }

        $tabidee = $repcom->findById($id_idee);
        $tabutilisateur = $reputilisateur->findById($id_utilisateur);

        if(!$tabidee || !$tabutilisateur)
        {
            throw $this->createNotFoundException(
                'commentaire ou idee inconnu'
            );
        }

        $vote_idee = new vote_idee();
        $vote_idee  ->setIdee($tabidee[0])
                    ->setUtilisateur($tabutilisateur[0]);
        $em->persist($vote_idee);
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
        $repository = $doctrine->getRepository('restBundle:vote_idee');

        $idvote_idee = $request->query->get('idvote_idee');

        if (!$idvote_idee) {
            throw $this->createNotFoundException(
                'Missing parameters in HTTP request'
            );
        }

        $vote_idee = $repository->findById($idvote_idee);

        if (!$vote_idee) {
            throw $this->createNotFoundException(
                'vote non trouvée'
            );
        }
        else
        {
            $em->remove($vote_idee[0]);
            $em->flush();

            $response = new Response();
            $response->setStatusCode(Response::HTTP_OK);
            $response->headers->set('Content-Type', 'text/html');
        }
        return $response;
    }
}