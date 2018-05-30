<?php

namespace AuthentificationBundle\Repository;

use Doctrine\ORM\EntityRepository;



class userRepository extends EntityRepository
{


       public function loadByType($type)
       {

        return $this->createQueryBuilder('u')
               ->where('u.type = :type')
               ->setParameter('type',$type)
               ->getQuery()->getSingleResult();
       }

}
