<?php

namespace ApiBundle\Service;

use AppBundle\Service\BaseService;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Author;
use AppBundle\Entity\Country;

class AuthorService extends BaseService
{
    private $container;

    public function __construct(EntityManager $em, $container){
      $this->em = $em;
      $this->container = $container;
    }

    protected function getRepository(){
      return $this->em->getRepository('AppBundle:Author');
    }

    protected function getCountryRepository(){
      return $this->em->getRepository('AppBundle:Country');
    }

    public function save($request){

      $entity = new Author();

      if (!$request->get('author_name')) {
          throw new \Exception("The Author Name cannot be empty");
      }
      $entity->setAuthorName($request->get('author_name'));

      if (!$request->get('birth_date')) {
          throw new \Exception("Birth Date cannot be empty");
      }
      $date = new \DateTime($request->get('birth_date'));
      $entity->setBirthDate($date);


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

    public function getJson($entity){
      $arrayAuthor = [];
      foreach ($entity as $b) {
        $array = [];
        $array["authorName"] = $b->getAuthorName();
        $array["authorId"] = $b->getId();
        $array["country"] = $b->getCountry()->getCountryName();

        array_push($arrayAuthor, $array);
      }
      return $arrayAuthor;
    }

}
