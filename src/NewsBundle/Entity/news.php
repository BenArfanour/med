<?php

namespace NewsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * news
 *
 * @ORM\Table(name="news")
 * @ORM\Entity(repositoryClass="NewsBundle\Repository\newsRepository")
 */
class news
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
     * @ORM\Column(name="corps", type="string", length=255)
     */
    private $corps;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date")
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="pj", type="string",length=255)
     */
    private $pj;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     * @ORM\Column(name="type_pnc", type="string", length=255)
     */
    private $typePnc;





    /**
     * @ORM\OneToMany(targetEntity="NewsBundle\Entity\News_PNC",mappedBy="news")
     */
    private $NP;


    public function __construct()
    {
        $this->NP = new ArrayCollection();
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
     * @return news
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
     * Set corps
     *
     * @param string $corps
     * @return news
     */
    public function setCorps($corps)
    {
        $this->corps = $corps;

        return $this;
    }

    /**
     * Get corps
     *
     * @return string
     */
    public function getCorps()
    {
        return $this->corps;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return news
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     * @return news
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set pj
     *
     * @param string $pj
     * @return news
     */
    public function setPj($pj)
    {
        $this->pj = $pj;

        return $this;
    }

    /**
     * Get pj
     *
     * @return string
     */
    public function getPj()
    {
        return $this->pj;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return news
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
     * Set typePnc
     *
     * @param string $typePnc
     * @return news
     */
    public function setTypePnc($typePnc)
    {
        $this->typePnc = $typePnc;

        return $this;
    }

    /**
     * Get typePnc
     *
     * @return string
     */
    public function getTypePnc()
    {
        return $this->typePnc;
    }






    /**
     * Set news
     *
     * @param \NewsBundle\Entity\news $news
     *
     * @return news
     */
    public function setNews(\NewsBundle\Entity\news $news = null)
    {
        $this->news = $news;

        return $this;
    }

    /**
     * Get news
     *
     * @return \NewsBundle\Entity\news
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * Add nP
     *
     * @param \NewsBundle\Entity\News_PNC $nP
     *
     * @return news
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
}
