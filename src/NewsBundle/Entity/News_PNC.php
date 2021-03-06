<?php

namespace NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * News_PNC
 *
 * @ORM\Table(name="news__p_n_c")
 * @ORM\Entity(repositoryClass="NewsBundle\Repository\News_PNCRepository")
 */
class News_PNC
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idn;

    /**
     * @var string
     *
     * @ORM\Column(name="lu", type="string", length=255)
     */
    private $lu;


   /**
     * @ORM\ManyToOne(targetEntity="AuthentificationBundle\Entity\user" ,inversedBy="",cascade={"remove", "persist"})
     * @ORM\JoinColumn(name="id_PNC",referencedColumnName="id")
     */
    private $pncs;

    /**
     * @ORM\ManyToOne(targetEntity="NewsBundle\Entity\news" ,inversedBy="",cascade={"remove", "persist"})
     * @ORM\JoinColumn(name="id_News",referencedColumnName="id")
     */

    private $news;



    /**
     * Set lu
     *
     * @param string $lu
     *
     * @return News_PNC
     */
    public function setLu($lu)
    {
        $this->lu = $lu;

        return $this;
    }

    /**
     * Get lu
     *
     * @return string
     */
    public function getLu()
    {
        return $this->lu;
    }

    /**
     * Set pncs
     *
     * @param \AuthentificationBundle\Entity\user $pncs
     *
     * @return News_PNC
     */
    public function setPncs(\AuthentificationBundle\Entity\user $pncs = null)
    {
        $this->pncs = $pncs;

        return $this;
    }

    /**
     * Get pncs
     *
     * @return \AuthentificationBundle\Entity\user
     */
    public function getPncs()
    {
        return $this->pncs;
    }

    /**
     * Set news
     *
     * @param \NewsBundle\Entity\news $news
     *
     * @return News_PNC
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

    public function __toString()
    {
        // TODO: Implement __toString() method.
    }

    /**
     * Get idn
     *
     * @return integer
     */
    public function getIdn()
    {
        return $this->idn;
    }


}
