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
    (empty($_GET["page"]))? $page = 1 : $page = intval($_GET["page"]);
    (empty($_GET["search"]))? $search = 0 : $search = $_GET["search"];

    if($search){
      $entity = $this->getBookService()->getFilter($search);

    } else{
      $entity = $this->getBookService()->findAll();
    }

    $arrayBook = $this->getBookService()->getJson($entity);

    if($page < 1){
      $page = 1;
    }

    return $this->render('AppBundle:Default:search.html.twig', ['books'=>$arrayBook, 'page'=>$page]);
  }
}
