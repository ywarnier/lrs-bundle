<?php
/* For licensing terms, see /license.txt */

namespace XApi\LrsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statement
 *
 * @ORM\Table(name="lrs_agent", indexes={@ORM\Index(name="idx_lrs_agent", columns={"id"})})
 * @ORM\Entity
 */
class Agent extends Actor
{
    /**
     * Set Verb Id
     *
     * @param Iri $iri
     * @param string|null $name
     */
    public function __construct($iri, $name = null)
    {
        parent::__construct($iri, $name);
    }
    /**
     * {@inheritdoc}
     */
    public function equals($actor)
    {
        if (!parent::equals($actor)) {
            return false;
        }

        return true;
    }

}
