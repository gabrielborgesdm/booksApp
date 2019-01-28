<?php

namespace ApiBundle\Service;

use AppBundle\Service\BaseService;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Country;

class PublisherService extends BaseService
{
    private $container;

    public function __construct(EntityManager $em, $container){
      $this->em = $em;
      $this->container = $container;
    }

    protected function getCountryRepository(){
      return $this->em->getRepository('AppBundle:Country');
    }

    public function save($request){

      $entity = new Country();

      if (!$request->get('country_name')) {
          throw new \Exception("The Country Name cannot be empty");
      }
      $entity->setCountryName($request->get('country_name'));

      if (!$request->get('code')) {
          throw new \Exception("Country code cannot be empty");
      }
      $entity->setCountryCode($request->get('code'));

      $this->saveOrUpdate($entity);
      return $entity;
    }

}
