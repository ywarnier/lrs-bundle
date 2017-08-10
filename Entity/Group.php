<?php
/* For licensing terms, see /license.txt */

namespace XApi\LrsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statement
 *
 * @ORM\Table(name="lrs_group", indexes={@ORM\Index(name="idx_lrs_group", columns={"id"})})
 * @ORM\Entity
 */
class Group extends Actor
{
    /**
     * @ORM\ManyToMany(targetEntity="XApi\LrsBundle\Entity\Agent")
     * @ORM\JoinTable(name="lrs_group_rel_agent",
     *      joinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="agent_id", referencedColumnName="id")}
     * )
     */
    protected $members;

    /**
     * @param IRI        $iri
     * @param string     $name
     * @param Agent[]    $members
     */
    public function __construct(IRI $iri = null, $name = null, array $members = array())
    {
        parent::__construct($iri, $name);

        $this->members = $members;
    }

    /**
     * Returns the members of this group.
     *
     * @return Agent[] The members
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * {@inheritdoc}
     */
    public function equals(Actor $actor)
    {
        if (!parent::equals($actor)) {
            return false;
        }

        /** @var Group $actor */

        if (count($this->members) !== count($actor->members)) {
            return false;
        }

        foreach ($this->members as $member) {
            if (!in_array($member, $actor->members)) {
                return false;
            }
        }

        return true;
    }
}
