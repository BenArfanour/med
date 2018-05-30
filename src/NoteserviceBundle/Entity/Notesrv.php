<?php

namespace NoteserviceBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Notesrv
 *
 * @ORM\Table(name="notesrv")
 * @ORM\Entity(repositoryClass="NoteserviceBundle\Repository\NotesrvRepository")
 */
class Notesrv
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
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Please, upload the product brochure as a PDF file.")
     * @Assert\File(mimeTypes={ "application/pdf" })
     */
    private $upload;

   /**
     * @ORM\ManyToOne(targetEntity="AuthentificationBundle\Entity\user" , inversedBy="noteservice")
     * @ORM\JoinColumn(name="id_admin" ,  referencedColumnName="id")
     */
     private $admin;



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
     * @return Notesrv
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
     * Set upload
     *
     * @param string $upload
     * @return Notesrv
     */
    public function setUpload($upload)
    {
        $this->upload = $upload;

        return $this;
    }

    /**
     * Get upload
     *
     * @return string 
     */
    public function getUpload()
    {
        return $this->upload;
    }



    /**
     * Set admin
     *
     * @param \AuthentificationBundle\Entity\Admin $admin
     *
     * @return Notesrv
     */
    public function setAdmin(\AuthentificationBundle\Entity\Admin $admin = null)
    {
        $this->admin = $admin;

        return $this;
    }

    /**
     * Get admin
     *
     * @return \AuthentificationBundle\Entity\Admin
     */
    public function getAdmin()
    {
        return $this->admin;
    }
}
