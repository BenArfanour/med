<?php

namespace PfeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * programmevol
 *
 * @ORM\Table(name="programmevol")
 * @ORM\Entity(repositoryClass="PfeBundle\Repository\programmevolRepository")
 */
class programmevol
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
     *
     * @ORM\ManyToOne(targetEntity="AuthentificationBundle\Entity\user" ,inversedBy="programmesvols",cascade={"remove", "persist"})
     * @ORM\JoinColumn(name="id_pnc",referencedColumnName="id")
     *
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity="PfeBundle\Entity\CompanyEvents" ,inversedBy="programmesvols",cascade={"remove", "persist"})
     * @ORM\JoinColumn(name="id_vol",referencedColumnName="id")
     */
    private $vols;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set users
     *
     * @param \AuthentificationBundle\Entity\user $users
     *
     * @return programmevol
     */
    public function setUsers(\AuthentificationBundle\Entity\user $users = null)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * Get users
     *
     * @return \AuthentificationBundle\Entity\user
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Set vols
     *
     * @param \PfeBundle\Entity\CompanyEvents $vols
     *
     * @return programmevol
     */
    public function setVols(\PfeBundle\Entity\CompanyEvents $vols = null)
    {
        $this->vols = $vols;

        return $this;
    }

    /**
     * Get vols
     *
     * @return \PfeBundle\Entity\CompanyEvents
     */
    public function getVols()
    {
        return $this->vols;
    }
}
