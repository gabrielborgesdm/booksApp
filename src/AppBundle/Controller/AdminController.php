<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;



class AdminController extends Controller
{

  private function getBookService(){
    return $this->get('api.book.service');
  }

  private function getPublisherService(){
    return $this->get('api.publisher.service');
  }

  private function getAuthorService(){
    return $this->get('api.author.service');
  }

  public function indexAction(Request $request)
  {
    return $this->render('AppBundle:Admin:index.html.twig');
  }

  public function booksAction(Request $request)
  {
    $books = $this->getBookService()->findAll();

    $books = $this->getBookService()->getJson($books);
    return $this->render('AppBundle:Admin:books.html.twig',["books"=>$books]);
  }

  public function publishersAction(Request $request)
  {
    $publisher = $this->getPublisherService()->findAll();

    $publisher = $this->getPublisherService()->getJson($publisher);
    return $this->render('AppBundle:Admin:publishers.html.twig',["publishers"=>$publisher]);
  }

  public function authorsAction(Request $request)
  {
    $author = $this->getAuthorService()->findAll();

    $author = $this->getAuthorService()->getJson($author);
    return $this->render('AppBundle:Admin:authors.html.twig',["authors"=>$author]);
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

    return $this->render('AppBundle:Admin:books.html.twig', ['books'=>$arrayBook, 'page'=>$page]);
  }
}
