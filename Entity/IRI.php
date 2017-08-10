<?php
/* For licensing terms, see /license.txt */

namespace XApi\LrsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statement
 *
 * @ORM\Table(name="lrs_iri", indexes={@ORM\Index(name="idx_lrs_iri", columns={"id"})})
 * @ORM\Entity
 */
class IRI
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
     * @var string
     *
     * @ORM\Column(name="iri_value", type="text", nullable=true)
     */
    private $iriValue;

    private function __construct()
    {
        // do nothing
    }

    /**
     * Sets the IRI from a string value
     * @param string $value
     * @return self
     * @throws \InvalidArgumentException if the given value is no valid IRI
     */
    public static function fromString($value)
    {
        $iri = new self();
        $iri->iriValue = $value;

        return $iri;
    }

    public function getValue()
    {
        return $this->iriValue;
    }

    public function equals(IRI $iri)
    {
        return $this->iriValue === $iri->iriValue;
    }

}
