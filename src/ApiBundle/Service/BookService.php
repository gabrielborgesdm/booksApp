<?php

namespace ApiBundle\Service;

use AppBundle\Service\BaseService;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Book;
use AppBundle\Entity\Author;
use AppBundle\Entity\Publisher;

class BookService extends BaseService
{
    private $container;

    public function __construct(EntityManager $em, $container){
      $this->em = $em;
      $this->container = $container;
    }


    protected function getRepository(){
      return $this->em->getRepository('AppBundle:Book');
    }

    public function save($request){

      if (!$request->get('publisher')) {
          throw new \Exception("The Book Publisher cannot be empty");
      }

      if (!$request->get('publishing_date')) {
          throw new \Exception("Publishing date cannot be empty");
      }

      if (!$request->get('book_name')) {
          throw new \Exception("The Book Name cannot be empty");
      }

      if (!$request->get('pages')) {
          throw new \Exception("Pages cannot be empty");
      }

      if (!$request->get('edition')) {
          throw new \Exception("Edition cannot be empty");
      }

      if (!$request->get('category')) {
          throw new \Exception("Category cannot be empty");
      } 

      $entity = new Book();
      $entity->setPublisherId($publisher_id);
      $entity->setBookName($book_name);
      $entity->setPages($pages);
      $entity->setCategory($category);
      $entity->setEdition($edition);
      dump($entity);
      $this->saveOrUpdate($entity);
      return $entity();
    }

}
