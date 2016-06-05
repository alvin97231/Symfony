<?php
/**
 * Created by PhpStorm.
 * User: cedric
 * Date: 05/06/16
 * Time: 21:04
 */

namespace restBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * vote_idee
 *
 * @ORM\Table(name="vote_idee")
 * @ORM\Entity(repositoryClass="restBundle\Repository\vote_ideeRepository")
 */
class vote_idee
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
     * @ORM\ManyToOne(targetEntity="\restBundle\Entity\utilisateur", inversedBy="vote_idee")
     * @ORM\JoinColumn(name="utilisateur_id", referencedColumnName="id")
     */
    private $utilisateur;

    /**
     * @ORM\ManyToOne(targetEntity="\restBundle\Entity\idee", inversedBy="vote_idee")
     * @ORM\JoinColumn(name="idee_id", referencedColumnName="id")
     */
    private $idee;


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
     * @return vote_idee
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
     * Set idee
     *
     * @param \restBundle\Entity\idee $idee
     * @return vote_idee
     */
    public function setIdee(\restBundle\Entity\idee $idee = null)
    {
        $this->idee = $idee;

        return $this;
    }

    /**
     * Get idee
     *
     * @return \restBundle\Entity\idee 
     */
    public function getIdee()
    {
        return $this->idee;
    }
}
