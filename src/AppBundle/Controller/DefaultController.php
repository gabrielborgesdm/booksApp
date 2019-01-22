<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

  private function getBookService(){
    return $this->get('api.book.service');
  }

    public function indexAction(Request $request)
    {
      return $this->render('AppBundle:Default:index.html.twig');
    }

    public function searchAction(Request $request)
    {
      $arrayBook = [];

      $entity = $this->getBookService()->findAll();
      foreach ($entity as $b) {
        $array = [];
        $array["bookName"] = $b->getBookName();
        $array["pages"] = $b->getPages();
        $array["publishingDate"] =  $b->getPublishingDate()->format('F d, Y');
        $array["publisher"] = $b->getPublisher()->getPublisherName();
        $array["edition"] = $b->getEdition();
        $array["category"] = $b->getCategory();
        $array["author"] = "";
        for($i = 0; $i < count($b->getAuthors()); $i++) {
          $array["author"] .= $b->getAuthors()[$i]->getAuthorName() . ", ";

        }
        $array["author"] = rtrim($array["author"],", ");

        array_push($arrayBook, $array);
      }

      return $this->render('AppBundle:Default:search.html.twig', ['books'=>$arrayBook]);
    }
}
