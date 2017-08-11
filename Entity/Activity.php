<?php
/* For licensing terms, see /license.txt */

namespace XApi\LrsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use XApi\LrsBundle\Model\Object;

/**
 * Statement
 *
 * @ORM\Table(name="lrs_activity", indexes={@ORM\Index(name="idx_lrs_activity", columns={"id"})})
 * @ORM\Entity
 */
class Activity extends Object
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
     * @ORM\ManyToOne(targetEntity="XApi\LrsBundle\Entity\IRI", inversedBy="iris", cascade={"persist"})
     * @ORM\JoinColumn(name="iri_id", referencedColumnName="id")
     */
    private $iri;

    /**
     * @var string
     *
     * @ORM\Column(name="definition", type="text", nullable=true)
     */
    private $definition;

    /**
     * @param IRI        $id
     * @param Definition $definition
     */
    public function __construct(IRI $id, Definition $definition = null)
    {
        $this->id = $id;
        $this->definition = $definition;
    }

    /**
     * Returns the Activity's unique identifier.
     *
     * @return IRI The identifier
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the Activity's {@link Definition}.
     *
     * @return Definition The Definition
     */
    public function getDefinition()
    {
        return $this->definition;
    }

    /**
     * {@inheritdoc}
     */
    public function equals($object)
    {
        if ('Xabbuh\XApi\Model\Activity' !== get_class($object)) {
            return false;
        }

        /** @var Activity $object */

        if (!$this->id->equals($object->id)) {
            return false;
        }

        if (null === $this->definition && null !== $object->definition) {
            return false;
        }

        if (null !== $this->definition && null === $object->definition) {
            return false;
        }

        if (null !== $this->definition && !$this->definition->equals($object->definition)) {
            return false;
        }

        return true;
    }
}
