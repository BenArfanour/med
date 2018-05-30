<?php
/**
 * Created by PhpStorm.
 * User: x0Geek
 * Date: 18/04/2017
 * Time: 18:30
 */

namespace PfeBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use fadosProduccions\fullCalendarBundle\Entity\Event as BaseEvent;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="Vols")
 */
class CompanyEvents extends BaseEvent
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string")
     */
    private  $code ;


    /**
     * @var integer
     *
     * @ORM\Column(name="NumVol", type="integer")
     */
    private  $NumVol ;

    /**
     * @var string
     *
     * @ORM\Column(name="companie", type="string", length=255)
     */
    private $companie;


    /**
     * @var string
     *
     * @ORM\Column(name="type_avion", type="string", length=255)
     */
    private $typeAvion;


    /**
     * @var string
     *
     * @ORM\Column(name="escale_dep", type="string")
     */
    private $escaleDep;

    /**
     * @var string
     *
     * @ORM\Column(name="escale_arrive", type="string", length=255)
     */
    private $escaleArrive;


    /**
     * @ORM\OneToMany(targetEntity="PfeBundle\Entity\programmevol",mappedBy="vols")
     */
    private $programmesvols;




    public function __construct()
    {

        $this->programmesvols = new ArrayCollection();
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
     * Set code
     *
     * @param string $code
     *
     * @return CompanyEvents
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    public function toArray()
    {
        return array(
            'id'               => $this->id,
            'title'            => $this->title,
            'start'            => $this->startDatetime->format("Y-m-d H:i:sP"),
            'end'              => $this->endDatetime->format("Y-m-d  H:i:sP"),
            'url'              => $this->url,
            'backgroundColor'  => $this->bgColor,
            'borderColor'      => $this->bgColor,
            'textColor'        => $this->fgColor,
            'className'        => $this->cssClass,
            'allDay'           => $this->allDay,
            'code'             =>$this->code,
            'NumVol'           =>$this->NumVol,
            'escaleDep'        =>$this->escaleDep,
            'escaleArrive'     =>$this->escaleArrive,

        );
    }

    /**
     * Set numVol
     *
     * @param integer $numVol
     *
     * @return CompanyEvents
     */
    public function setNumVol($numVol)
    {
        $this->NumVol = $numVol;

        return $this;
    }

    /**
     * Get numVol
     *
     * @return integer
     */
    public function getNumVol()
    {
        return $this->NumVol;
    }

    /**
     * Set companie
     *
     * @param string $companie
     *
     * @return CompanyEvents
     */
    public function setCompanie($companie)
    {
        $this->companie = $companie;

        return $this;
    }

    /**
     * Get companie
     *
     * @return string
     */
    public function getCompanie()
    {
        return $this->companie;
    }

    /**
     * Set typeAvion
     *
     * @param string $typeAvion
     *
     * @return CompanyEvents
     */
    public function setTypeAvion($typeAvion)
    {
        $this->typeAvion = $typeAvion;

        return $this;
    }

    /**
     * Get typeAvion
     *
     * @return string
     */
    public function getTypeAvion()
    {
        return $this->typeAvion;
    }

    /**
     * Set escaleDep
     *
     * @param string $escaleDep
     *
     * @return CompanyEvents
     */
    public function setEscaleDep($escaleDep)
    {
        $this->escaleDep = $escaleDep;

        return $this;
    }

    /**
     * Get escaleDep
     *
     * @return string
     */
    public function getEscaleDep()
    {
        return $this->escaleDep;
    }

    /**
     * Set escaleArrive
     *
     * @param string $escaleArrive
     *
     * @return CompanyEvents
     */
    public function setEscaleArrive($escaleArrive)
    {
        $this->escaleArrive = $escaleArrive;

        return $this;
    }

    /**
     * Get escaleArrive
     *
     * @return string
     */
    public function getEscaleArrive()
    {
        return $this->escaleArrive;
    }



    /**
     * Add programmesvol
     *
     * @param \PfeBundle\Entity\programmevol $programmesvol
     *
     * @return CompanyEvents
     */
    public function addProgrammesvol(\PfeBundle\Entity\programmevol $programmesvol)
    {
        $this->programmesvols[] = $programmesvol;
        $programmesvol->setVols($this);

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


    public function __toString()
    {
        return $this->code;
    }


}
