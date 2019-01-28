<?php

namespace ApiBundle\Service;

use AppBundle\Service\BaseService;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Publisher;
use AppBundle\Entity\Country;

class PublisherService extends BaseService
{
    private $container;

    public function __construct(EntityManager $em, $container){
      $this->em = $em;
      $this->container = $container;
    }

    public function getRepository(){
      return $this->em->getRepository('AppBundle:Publisher');
    }

    protected function getCountryRepository(){
      return $this->em->getRepository('AppBundle:Country');
    }

    public function save($request){

      $entity = new Publisher();

      if (!$request->get('publisher_name')) {
          throw new \Exception("The Publisher Name cannot be empty");
      }
      $entity->setPublisherName($request->get('publisher_name'));

      if (!$request->get('country')) {
          throw new \Exception("Birth Country cannot be empty");
      }
      else {
        $country = $this->getCountryRepository()->find($request->get('country'));
        if(empty($country)){
          throw new \Exception("Country isn't valid");
        }
        $entity->setCountry($country);
      }



      $this->saveOrUpdate($entity);
      return $entity;
    }

}
