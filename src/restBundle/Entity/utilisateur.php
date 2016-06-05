<?php

namespace restBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\OneToMany(targetEntity="idee", mappedBy="utilisateur")
     */
    private $idees;

    /**
     * @ORM\OneToMany(targetEntity="commentaire", mappedBy="utilisateur")
     */
    private $commentaires;

    /**
     * utilisateur constructor.
     */
    public function __construct()
    {
        $this->idees = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
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
}
