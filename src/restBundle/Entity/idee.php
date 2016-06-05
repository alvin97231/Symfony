<?php

namespace restBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * idee
 *
 * @ORM\Table(name="idee")
 * @ORM\Entity(repositoryClass="restBundle\Repository\ideeRepository")
 */
class idee
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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;

    /**
     * @ORM\ManyToOne(targetEntity="\restBundle\Entity\utilisateur", inversedBy="idee")
     * @ORM\JoinColumn(name="utilisateur_id", referencedColumnName="id")
     */
    private $utilisateur;

    /**
     * @ORM\OneToMany(targetEntity="vote_idee", mappedBy="idee")
     */
    private $votes;

    /**
     * utilisateur constructor.
     */
    public function __construct()
    {
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
     * Set titre
     *
     * @param string $titre
     * @return idee
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    
        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     * @return idee
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    
        return $this;
    }

    /**
     * Get contenu
     *
     * @return string 
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set utilisateur
     *
     * @param \restBundle\Entity\Utilisateur $utilisateur
     * @return idee
     */
    public function setUtilisateur(\restBundle\Entity\Utilisateur $utilisateur)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \restBundle\Entity\Utilisateur 
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Add votes
     *
     * @param \restBundle\Entity\vote_idee $votes
     * @return idee
     */
    public function addVote(\restBundle\Entity\vote_idee $votes)
    {
        $this->votes[] = $votes;

        return $this;
    }

    /**
     * Remove votes
     *
     * @param \restBundle\Entity\vote_idee $votes
     */
    public function removeVote(\restBundle\Entity\vote_idee $votes)
    {
        $this->votes->removeElement($votes);
    }

    /**
     * Get votes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVotes()
    {
        return $this->votes;
    }
}
