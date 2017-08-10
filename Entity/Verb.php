<?php
/* For licensing terms, see /license.txt */

namespace XApi\LrsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statement
 *
 * @ORM\Table(name="lrs_verb", indexes={@ORM\Index(name="idx_lrs_verb", columns={"id"})})
 * @ORM\Entity
 */
class Verb
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
     * @ORM\Column(name="display", type="text", nullable=true)
     */
    private $display;

    /**
     * @param IRI              $id
     * @param LanguageMap|null $display
     */
    public function __construct(IRI $id, LanguageMap $display = null)
    {
        $this->id = $id;
        $this->display = $display;
    }

    /**
     * Returns the verb definition reference.
     * @return IRI The reference
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the human readable representation of the Verb in one or more languages.
     * @return LanguageMap|null The language map
     */
    public function getDisplay()
    {
        return $this->display;
    }

    /**
     * Checks if another verb is equal.
     * Two verbs are equal if and only if all of their properties are equal.
     * @param Verb $verb The verb to compare with
     * @return bool True if the verbs are equal, false otherwise
     */
    public function equals(Verb $verb)
    {
        if (!$this->id->equals($verb->id)) {
            return false;
        }

        if (!is_array($this->display) xor !is_array($verb->display)) {
            return false;
        }

        if (count($this->display) !== count($verb->getDisplay())) {
            return false;
        }

        if (is_array($this->display)) {
            foreach ($this->display as $language => $value) {
                if (!isset($verb->display[$language])) {
                    return false;
                }

                if ($value !== $verb->display[$language]) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Tests if the Verb can be used to void a Statement.
     *
     * @return bool True, if the Verb is a void Verb, false otherwise
     */
    public function isVoidVerb()
    {
        return $this->id->equals(IRI::fromString('http://adlnet.gov/expapi/verbs/voided'));
    }

    /**
     * Creates a Verb that can be used to void a {@link Statement}.
     *
     * @return Verb
     */
    public static function createVoidVerb()
    {
        return new Verb(IRI::fromString('http://adlnet.gov/expapi/verbs/voided'));
    }
}
