<?php
/* For licensing terms, see /license.txt */

namespace XApi\LrsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statement
 *
 * @ORM\Table(name="lrs_actor", indexes={@ORM\Index(name="idx_lrs_actor", columns={"id"})})
 * @ORM\Entity
 */
class Actor
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
     * @ORM\Column(name="name", type="text", nullable=true)
     */
    private $name;

    /**
     * Set Verb Id
     *
     * @param Iri $iri
     * @param string|null $name
     */
    public function __construct($iri, $name = null)
    {
        $this->iri = $iri;
        $this->name = $name;
    }
    /**
     * Returns the Actor's {@link InverseFunctionalIdentifier inverse functional identifier}.
     *
     * @return InverseFunctionalIdentifier|null The inverse functional identifier
     */
    public function getInverseFunctionalIdentifier()
    {
        return $this->iri;
    }

    /**
     * Returns the name of the {@link Agent} or {@link Group}.
     *
     * @return string|null The name
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Checks if another actor is equal.
     *
     * Two actors are equal if and only if all of their properties are equal.
     * @param Actor $actor The actor to compare with
     * @return bool True if the actors are equal, false otherwise
     */
    public function equals($actor)
    {
        if (!parent::equals($actor)) {
            return false;
        }

        if (!$actor instanceof Actor) {
            return false;
        }

        if ($this->name !== $actor->name) {
            return false;
        }

        if (null !== $this->iri xor null !== $actor->iri) {
            return false;
        }

        if (null !== $this->iri && null !== $actor->iri && !$this->iri->equals($actor->iri)) {
            return false;
        }

        return true;
    }
}
