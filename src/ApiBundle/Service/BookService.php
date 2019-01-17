<?php

namespace ApiBundle\Service;

use AppBundle\Service\BaseService;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Book;
use AppBundle\Entity\Author;
use AppBundle\Entity\Publisher;

class DefaultController extends BaseService
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

    protected function getPublisherRepository(){
      return $this->em->getRepository('AppBundle:Publisher');
    }

    public function save($request){
        if (!$request->get('publisher_id')) {
            throw new \Exception("This Book Publisher doesn't exist in our system");
        } else{
          dump($this->getPublisherRepository()->findBy(1));
        }
    }

}
