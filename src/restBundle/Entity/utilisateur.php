<?php

namespace restBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Response;
/**
 * utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity(repositoryClass="restBundle\Repository\utilisateurRepository")
 */
class utilisateur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=255)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255)
     */
    private $token;

    /**
     * @var date
     *
     * @ORM\Column(name="token_timeout", type="datetime")
     */
    private $token_timeout;

    /**
     * @ORM\OneToMany(targetEntity="idee", mappedBy="utilisateur")
     */
    private $idees;

    /**
     * @ORM\OneToMany(targetEntity="commentaire", mappedBy="utilisateur")
     */
    private $commentaires;

    /**
     * @ORM\OneToMany(targetEntity="vote_commentaire", mappedBy="utilisateur")
     */
    private $votes_commentaire;

    /**
     * @ORM\OneToMany(targetEntity="vote_idee", mappedBy="utilisateur")
     */
    private $votes_idee;

    /**
     * utilisateur constructor.
     */
    public function __construct()
    {
        $this->idees = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
        $this->votes_commentaire = new ArrayCollection();
        $this->votes_idee = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set login
     *
     * @param string $login
     * @return utilisateur
     */
    public function setLogin($login)
    {
        $this->login = $login;
    
        return $this;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return utilisateur
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return utilisateur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return utilisateur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    
        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return utilisateur
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    
        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Add idees
     *
     * @param \restBundle\Entity\Idee $idees
     * @return utilisateur
     */
    public function addIdee(\restBundle\Entity\Idee $idees)
    {
        $this->idees[] = $idees;

        return $this;
    }

    /**
     * Remove idees
     *
     * @param \restBundle\Entity\Idee $idees
     */
    public function removeIdee(\restBundle\Entity\Idee $idees)
    {
        $this->idees->removeElement($idees);
    }

    /**
     * Get idees
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdees()
    {
        return $this->idees;
    }

    /**
     * Add commentaires
     *
     * @param \restBundle\Entity\commentaire $commentaires
     * @return utilisateur
     */
    public function addCommentaire(\restBundle\Entity\commentaire $commentaires)
    {
        $this->commentaires[] = $commentaires;

        return $this;
    }

    /**
     * Remove commentaires
     *
     * @param \restBundle\Entity\commentaire $commentaires
     */
    public function removeCommentaire(\restBundle\Entity\commentaire $commentaires)
    {
        $this->commentaires->removeElement($commentaires);
    }

    /**
     * Get commentaires
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * Set token
     *
     * @param string $token
     * @return utilisateur
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string 
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Add votes_commentaire
     *
     * @param \restBundle\Entity\vote_commentaire $votesCommentaire
     * @return utilisateur
     */
    public function addVotesCommentaire(\restBundle\Entity\vote_commentaire $votesCommentaire)
    {
        $this->votes_commentaire[] = $votesCommentaire;

        return $this;
    }

    /**
     * Remove votes_commentaire
     *
     * @param \restBundle\Entity\vote_commentaire $votesCommentaire
     */
    public function removeVotesCommentaire(\restBundle\Entity\vote_commentaire $votesCommentaire)
    {
        $this->votes_commentaire->removeElement($votesCommentaire);
    }

    /**
     * Get votes_commentaire
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVotesCommentaire()
    {
        return $this->votes_commentaire;
    }

    /**
     * Add votes_idee
     *
     * @param \restBundle\Entity\vote_idee $votesIdee
     * @return utilisateur
     */
    public function addVotesIdee(\restBundle\Entity\vote_idee $votesIdee)
    {
        $this->votes_idee[] = $votesIdee;

        return $this;
    }

    /**
     * Remove votes_idee
     *
     * @param \restBundle\Entity\vote_idee $votesIdee
     */
    public function removeVotesIdee(\restBundle\Entity\vote_idee $votesIdee)
    {
        $this->votes_idee->removeElement($votesIdee);
    }

    /**
     * Get votes_idee
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVotesIdee()
    {
        return $this->votes_idee;
    }


    /**
     *
     * login() permet de connecter un utilisateur en lui générant un token qui sera envoyé dans
     * toutes les requetes HTTP.
     *
     * @param $doctrine
     * @param $pwd
     * @return Response
     */
    public function login($doctrine, $pwd){
        if($pwd == $this->getPassword()){
            $jeton = md5(uniqid(rand(), TRUE)); //création d'un jeton
            $this->setToken($jeton);
            $time = time()+ 60 * 60 * 24 *7;
            $this->setTokenTimeout(date_create(date('Y-m-d', $time)));
            $em = $doctrine->getManager();
            $em->flush();
            $response = new Response();
            $response->setContent(json_encode($jeton));
            $response->setStatusCode(Response::HTTP_OK);
            $response->headers->set('Content-Type', 'text/html');

            return $response;
        }else{
            $response = new Response();
            $response->setContent(json_encode("erreur"));
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
            $response->headers->set('Content-Type', 'text/html');
            return $response;
        }
    }

    /**
     *
     * isLogged permet de vérifier si l'utilisateur est connecté.
     *
     * @param $doctrine
     * @param $token
     * @return bool
     */
    public function isLogged($doctrine, $token){
        if($token == $this->getToken()){
            $time = time()+ 60 * 60 * 24 *7;
            $this->setTokenTimeout(date_create(date('Y-m-d', $time)));
            $em = $doctrine->getManager();
            $em->flush();
            return TRUE;
        }else{
            return FALSE;
        }
    }

    /**
     *
     * logout permet de deconnceté l'utilisateur en supriment de token dans la base de données
     *
     * @param $doctrine
     * @param $token
     */
    public function logout($doctrine, $token){
        if($token == $this->getToken()){
            $this->setToken("");
            $em = $doctrine->getManager();
            $em->flush();
        }
    }


    /**
     * Set token_timeout
     *
     * @param \DateTime $tokenTimeout
     * @return utilisateur
     */
    public function setTokenTimeout($tokenTimeout)
    {
        $this->token_timeout = $tokenTimeout;

        return $this;
    }

    /**
     * Get token_timeout
     *
     * @return \DateTime 
     */
    public function getTokenTimeout()
    {
        return $this->token_timeout;
    }
}
