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

      if (!$request->get('book_name')) {
          throw new \Exception("The Book Name cannot be empty");
      }

      if (!$request->get('publisher')) {
          throw new \Exception("Publisher cannot be empty");
      }

      if (!$request->get('author')) {
          throw new \Exception("Author cannot be empty");
      }

      if (!$request->get('publishing_date')) {
          throw new \Exception("Publishing Date cannot be empty");
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

      // new \DateTime(strtotime($request->get('publishing_date')));
      $date = new \DateTime($request->get('publishing_date'));


      $entity->setBookName($request->get('book_name'));
      $entity->setPublisher($request->get('publisher'));
      $entity->setAuthor($request->get('author'));
      $entity->setPublishingDate($date);
      $entity->setPages($request->get('pages'));
      $entity->setEdition($request->get('edition'));
      $entity->setCategory($request->get('category'));
      dump($entity);
      die();
      $this->saveOrUpdate($entity);
      return $entity();
    }

}
