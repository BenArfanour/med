<?php


namespace AuthentificationBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="Utilisateurs")
 * @ORM\Entity(repositoryClass="AuthentificationBundle\Repository\userRepository")
 */

class user extends BaseUser {



    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\Column(type="string" , length=255,name="nom")
     */
    private $nom;


    /**
     * @ORM\Column(type="string" , length=255,name="prenom")
     */
    private $prenom;

    /**
     * @ORM\Column(type="string" , length=255,name="adresse",nullable=true)
     */
     private $adresse;

    /**
     * @ORM\Column(type="date" , length=255,name="dateNaiss",nullable=true)
     */
     private $dateNaiss;





    /**
     * @ORM\Column(name="type", type="string",nullable=true)
     */
    private $type;



   /**
     * @ORM\OneToMany(targetEntity="PfeBundle\Entity\programmevol",mappedBy="users")
     */
    private $programmesvols;


    /**
     * @ORM\OneToMany(targetEntity="NoteserviceBundle\Entity\Notesrv" , mappedBy="admin")
     */

    private $noteservice;


    /**
     * @ORM\OneToMany(targetEntity="NewsBundle\Entity\News_PNC",mappedBy="pncs")
     */
     private $NP;

    /**
     * @ORM\OneToMany(targetEntity="RammassageBundle\Entity\Rammassage" , mappedBy="pncs")
     */

     private $ram;

    public function __construct()
    {

        $this->NP= new ArrayCollection();
        $this->programmesvols= new ArrayCollection();

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
     * Set nom
     *
     * @param string $nom
     *
     * @return user
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
     *
     * @return user
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
     * Set adresse
     *
     * @param string $adresse
     *
     * @return user
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set dateNaiss
     *
     * @param \DateTime $dateNaiss
     *
     * @return user
     */
    public function setDateNaiss($dateNaiss)
    {
        $this->dateNaiss = $dateNaiss;

        return $this;
    }

    /**
     * Get dateNaiss
     *
     * @return \DateTime
     */
    public function getDateNaiss()
    {
        return $this->dateNaiss;
    }








    /**
     * Set type
     *
     * @param string $type
     *
     * @return user
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add programmesvol
     *
     * @param \PfeBundle\Entity\programmevol $programmesvol
     *
     * @return user
     */
    public function addProgrammesvol(\PfeBundle\Entity\programmevol $programmesvol)
    {
        $this->programmesvols[] = $programmesvol;

        return $this;
    }

    /**
     * Remove programmesvol
     *
     * @param \PfeBundle\Entity\programmevol $programmesvol
     */
    public function removeProgrammesvol(\PfeBundle\Entity\programmevol $programmesvol)
    {
        $this->programmesvols->removeElement($programmesvol);
    }

    /**
     * Get programmesvols
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProgrammesvols()
    {
        return $this->programmesvols;
    }




    /**
     * Add nP
     *
     * @param \NewsBundle\Entity\News_PNC $nP
     *
     * @return user
     */
    public function addNP(\NewsBundle\Entity\News_PNC $nP)
    {
        $this->NP[] = $nP;

        return $this;
    }

    /**
     * Remove nP
     *
     * @param \NewsBundle\Entity\News_PNC $nP
     */
    public function removeNP(\NewsBundle\Entity\News_PNC $nP)
    {
        $this->NP->removeElement($nP);
    }

    /**
     * Get nP
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNP()
    {
        return $this->NP;
    }


    public function __toString()
    {
        return $this->nom;
    }

    /**
     * Add noteservice
     *
     * @param \NoteserviceBundle\Entity\Notesrv $noteservice
     *
     * @return user
     */
    public function addNoteservice(\NoteserviceBundle\Entity\Notesrv $noteservice)
    {
        $this->noteservice[] = $noteservice;

        return $this;
    }

    /**
     * Remove noteservice
     *
     * @param \NoteserviceBundle\Entity\Notesrv $noteservice
     */
    public function removeNoteservice(\NoteserviceBundle\Entity\Notesrv $noteservice)
    {
        $this->noteservice->removeElement($noteservice);
    }

    /**
     * Get noteservice
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNoteservice()
    {
        return $this->noteservice;
    }
}
