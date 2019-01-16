<?php

namespace ApiBundle\Service;

use AppBundle\Service\BaseService;
use Doctrine\ORM\EntityManager;
//use AppBundle\Entity\Books;
class DefaultController extends BaseService
{
    private $container;

    public function __construct(EntityManager $em, $container){
      $this->em = $em;
      $this->container = $container;
    }

    /*
    protected function getRepository(){
      return $this->em->getRepository('AppBundle:Books');
    }
    */

    
}
