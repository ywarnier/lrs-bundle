<?php
/* For licensing terms, see /license.txt */

namespace XApi\LrsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statement
 *
 * @ORM\Table(name="lrs_object", indexes={@ORM\Index(name="idx_lrs_object", columns={"id"})})
 * @ORM\Entity
 */
abstract class Object
{
    /**
     * Checks if another object is equal.
     *
     * Two objects are equal if and only if all of their properties are equal.
     * @param Object $object The object to compare with
     * @return bool True if the objects are equal, false otherwise
     */
    public function equals($object)
    {
        return get_class($this) === get_class($object);
    }

}
