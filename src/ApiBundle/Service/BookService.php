<?php

namespace ApiBundle\Service;

use AppBundle\Service\BaseService;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Book;
use AppBundle\Entity\Author;
use AppBundle\Entity\Publisher;
use AppBundle\Entity\Country;

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

    protected function getAuthorRepository(){
      return $this->em->getRepository('AppBundle:Author');
    }

    protected function getCountryRepository(){
      return $this->em->getRepository('AppBundle:Country');
    }

    protected function getPublisherRepository(){
      return $this->em->getRepository('AppBundle:Publisher');
    }

    public function save($request){

      $entity = new Book();

      if (!$request->get('book_name')) {
          throw new \Exception("The Book Name cannot be empty");
      }
      $entity->setBookName($request->get('book_name'));


      if (!$request->get('publisher')) {
          throw new \Exception("Publisher cannot be empty");
      }
      else {
        if(empty($this->getPublisherRepository()->find($request->get('publisher')))){
          throw new \Exception("Publisher isn't valid");
        }
      }
      $publisher = $this->getPublisherRepository()->find($request->get('publisher'));
      $entity->setPublisher($publisher);

      if (!$request->get('author')) {
          throw new \Exception("Author cannot be empty");
      }else{

        $author = $this->getAuthorRepository()->find($request->get('author'));
        if(!$author){
          throw new \Exception("Author isn't valid");
        }

        $entity->addAuthor($author);

        $j = 0;
        $i = 1;
        do{
          if($request->get("author" . $i)){

            $author = $this->getAuthorRepository()->find($request->get("author" . $i));
            if(!$author){
              throw new \Exception("Author isn't valid");
            }
            $entity->addAuthor($author);
            $i++;
          } else{
            $j = 1;
          }
        }while($j != 1);

      }

      if (!$request->get('publishing_date')) {
          throw new \Exception("Publishing Date cannot be empty");
      }
      $date = new \DateTime($request->get('publishing_date'));
      $entity->setPublishingDate($date);

      if (!$request->get('pages')) {
          throw new \Exception("Pages cannot be empty");
      }
      $entity->setPages($request->get('pages'));

      if (!$request->get('edition')) {
          throw new \Exception("Edition cannot be empty");
      }
      $entity->setEdition($request->get('edition'));

      if (!$request->get('category')) {
          throw new \Exception("Category cannot be empty");
      }
      $entity->setCategory($request->get('category'));

      $this->saveOrUpdate($entity);
      return $entity;
    }


}
