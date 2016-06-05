<?php
/**
 * Created by PhpStorm.
 * User: cedric
 * Date: 05/06/16
 * Time: 21:20
 */
namespace restBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use restBundle\Entity\vote_commentaire;
use restBundle\Entity\commentaire;
class Vote_CommentaireController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function addAction(Request $request)
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $repcom = $doctrine->getRepository('restBundle:commentaire');
        $reputilisateur = $doctrine->getRepository('restBundle:utilisateur');

        $id_com = $request->get('id_com');
        $id_utilisateur = $request->get('id_utilisateur');

        if (!$id_utilisateur || !$id_com) {
            throw $this->createNotFoundException(
                'Missing parameters in HTTP request'
            );
        }

        $tabcommentaire = $repcom->findById($id_com);
        $tabutilisateur = $reputilisateur->findById($id_utilisateur);

        if(!$tabcommentaire || !$tabutilisateur)
        {
            throw $this->createNotFoundException(
                'commentaire ou utlisateur inconnu'
            );
        }

        $vote_com = new vote_commentaire();
        $vote_com   ->setCommentaire($tabcommentaire[0])
                    ->setUtilisateur($tabutilisateur[0]);
        $em->persist($vote_com);
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

        $idvote_com = $request->query->get('idvote_com');

        if (!$idvote_com) {
            throw $this->createNotFoundException(
                'Missing parameters in HTTP request'
            );
        }

        $vote_com = $repository->findById($idvote_com);

        if (!$vote_com) {
            throw $this->createNotFoundException(
                'vote non trouvée'
            );
        }
        else
        {
            $em->remove($vote_com[0]);
            $em->flush();

            $response = new Response();
            $response->setStatusCode(Response::HTTP_OK);
            $response->headers->set('Content-Type', 'text/html');
        }
        return $response;
    }
}