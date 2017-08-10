<?php
/* For licensing terms, see /license.txt */

namespace XApi\LrsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statement
 *
 * @ORM\Table(name="lrs_definition", indexes={@ORM\Index(name="idx_lrs_definition", columns={"id"})})
 * @ORM\Entity
 */
class Definition
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
     * The human readable activity name
     * @var LanguageMap
     */
    private $name;

    /**
     * The human readable activity description
     * @var LanguageMap
     */
    private $description;

    /**
     * @var IRI The type of the {@link Activity}
     */
    private $type;

    /**
     * An IRL where human-readable information describing the {@link Activity} can be found.
     *
     * @var IRL
     */
    private $moreInfo;

    /**
     * Extensions associated with the {@link Activity}.
     *
     * @var Extensions
     */
    private $extensions;

    /**
     * @param LanguageMap|null $name
     * @param LanguageMap|null $description
     * @param IRI|null         $type
     * @param IRL|null         $moreInfo
     * @param Extensions|null  $extensions
     */
    public function __construct($name = null, $description = null, $type = null, $moreInfo = null, $extensions = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->type = $type;
        $this->moreInfo = $moreInfo;
        $this->extensions = $extensions;
    }

    public function withName($name = null)
    {
        $definition = clone $this;
        $definition->name = $name;

        return $definition;
    }

    public function withDescription($description = null)
    {
        $definition = clone $this;
        $definition->description = $description;

        return $definition;
    }

    /**
     * @param IRI|null $type
     *
     * @return static
     */
    public function withType($type = null)
    {
        $definition = clone $this;
        $definition->type = $type;

        return $definition;
    }

    /**
     * @param IRL|null $moreInfo
     *
     * @return static
     */
    public function withMoreInfo($moreInfo = null)
    {
        $definition = clone $this;
        $definition->moreInfo = $moreInfo;

        return $definition;
    }

    public function withExtensions($extensions)
    {
        $definition = clone $this;
        $definition->extensions = $extensions;

        return $definition;
    }

    /**
     * Returns the human readable names.
     *
     * @return LanguageMap|null The name language map
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the human readable descriptions.
     *
     * @return LanguageMap|null The description language map
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Returns the {@link Activity} type.
     *
     * @return IRI|null The type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Returns an IRL where human-readable information about the activity can be found.
     *
     * @return IRL|null
     */
    public function getMoreInfo()
    {
        return $this->moreInfo;
    }

    public function getExtensions()
    {
        return $this->extensions;
    }

    /**
     * Checks if another definition is equal.
     *
     * Two definitions are equal if and only if all of their properties are equal.
     *
     * @param Definition $definition The definition to compare with
     *
     * @return bool True if the definitions are equal, false otherwise
     */
    public function equals($definition)
    {
        if (get_class($this) !== get_class($definition)) {
            return false;
        }

        if (null !== $this->type xor null !== $definition->type) {
            return false;
        }

        if (null !== $this->type && null !== $definition->type && !$this->type->equals($definition->type)) {
            return false;
        }

        if (null !== $this->moreInfo xor null !== $definition->moreInfo) {
            return false;
        }

        if (null !== $this->moreInfo && null !== $definition->moreInfo && !$this->moreInfo->equals($definition->moreInfo)) {
            return false;
        }

        if (null !== $this->extensions xor null !== $definition->extensions) {
            return false;
        }

        if (count($this->name) !== count($definition->name)) {
            return false;
        }

        if (count($this->description) !== count($definition->description)) {
            return false;
        }

        if (!is_array($this->name) xor !is_array($definition->name)) {
            return false;
        }

        if (!is_array($this->description) xor !is_array($definition->description)) {
            return false;
        }

        if (is_array($this->name)) {
            foreach ($this->name as $language => $value) {
                if (!isset($definition->name[$language])) {
                    return false;
                }

                if ($value !== $definition->name[$language]) {
                    return false;
                }
            }
        }

        if (is_array($this->description)) {
            foreach ($this->description as $language => $value) {
                if (!isset($definition->description[$language])) {
                    return false;
                }

                if ($value !== $definition->description[$language]) {
                    return false;
                }
            }
        }

        if (null !== $this->extensions && null !== $definition->extensions && !$this->extensions->equals($definition->extensions)) {
            return false;
        }

        return true;
    }
}
