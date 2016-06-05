<?php
/**
 * Created by PhpStorm.
 * User: cedric
 * Date: 05/06/16
 * Time: 21:08
 */

namespace restBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * vote_commentaire
 *
 * @ORM\Table(name="vote_commentaire")
 * @ORM\Entity(repositoryClass="restBundle\Repository\vote_commentaireRepository")
 */
class vote_commentaire
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
     * @ORM\ManyToOne(targetEntity="\restBundle\Entity\utilisateur", inversedBy="vote_commentaire")
     * @ORM\JoinColumn(name="utilisateur_id", referencedColumnName="id")
     */
    private $utilisateur;

    /**
     * @ORM\ManyToOne(targetEntity="\restBundle\Entity\commentaire", inversedBy="vote_commentaire")
     * @ORM\JoinColumn(name="commentaire_id", referencedColumnName="id")
     */
    private $commentaire;


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
     * Set utilisateur
     *
     * @param \restBundle\Entity\utilisateur $utilisateur
     * @return vote_commentaire
     */
    public function setUtilisateur(\restBundle\Entity\utilisateur $utilisateur = null)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \restBundle\Entity\utilisateur 
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Set commentaire
     *
     * @param \restBundle\Entity\commentaire $commentaire
     * @return vote_commentaire
     */
    public function setCommentaire(\restBundle\Entity\commentaire $commentaire = null)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return \restBundle\Entity\commentaire 
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }
}
