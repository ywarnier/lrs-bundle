<?php
/* For licensing terms, see /license.txt */

namespace XApi\LrsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statement
 *
 * @ORM\Table(name="lrs_statement", indexes={@ORM\Index(name="idx_lrs_statement", columns={"id"})})
 * @ORM\Entity(repositoryClass="LrsBundle\Repository\StatementRepository")
 */
class Statement
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="XApi\LrsBundle\Entity\Verb", inversedBy="verbs", cascade={"persist"})
     * @ORM\JoinColumn(name="verb_id", referencedColumnName="id")
     */
    private $verbId;

    /**
     * @ORM\ManyToOne(targetEntity="XApi\LrsBundle\Entity\Actor", inversedBy="actors", cascade={"persist"})
     * @ORM\JoinColumn(name="actor_id", referencedColumnName="id")
     */
    private $actorId;

    /**
     * @ORM\ManyToOne(targetEntity="XApi\LrsBundle\Entity\Object", inversedBy="objects", cascade={"persist"})
     * @ORM\JoinColumn(name="object_id", referencedColumnName="id")
     */
    private $objectId;

    /**
     * @ORM\ManyToOne(targetEntity="XApi\LrsBundle\Entity\Result", inversedBy="results", cascade={"persist"})
     * @ORM\JoinColumn(name="result_id", referencedColumnName="id")
     */
    private $resultId;

    /**
     * @var string
     *
     * @ORM\Column(name="authority", type="text", nullable=true)
     */
    private $authority;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="stored", type="datetime", nullable=true)
     */
    private $stored;

    /**
     * @var string
     *
     * @ORM\Column(name="context", type="text", nullable=true)
     */
    private $context;

    /**
     * @ORM\ManyToMany(targetEntity="XApi\LrsBundle\Entity\Attachment")
     * @ORM\JoinTable(name="lrs_statement_rel_attachment",
     *      joinColumns={@ORM\JoinColumn(name="statement_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="attachment_id", referencedColumnName="id")}
     * )
     */
    //protected $attachments;

    /**
     * Set Verb Id
     *
     * @param integer $verbId
     * @return Statement
     */
    public function setUserId($verbId)
    {
        $this->verbId = $verbId;

        return $this;
    }

    /**
     * Get verbId
     *
     * @return integer
     */
    public function getVerbId()
    {
        return $this->verbId;
    }

    /**
     * Set created date
     *
     * @param \DateTime $created
     * @return Statement
     */
    public function setCreatedDate($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created date
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
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
}
