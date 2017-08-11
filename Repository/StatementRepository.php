<?php
/* For licensing terms, see /license.txt */

namespace XApi\LrsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class StatementRepository extends EntityRepository {

    /**
     * @return mixed
     */
    public function findAllOrderedByDate()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT id FROM LrsBundle:Statement s ORDER BY s.created DESC'
            )
            ->getResult();
    }
}