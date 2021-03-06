<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View as FOSView;
use Symfony\Component\HttpFoundation\Request;



class BookController extends FOSRestController
{
  public function getBookService(){
    return $this->get("api.book.service");
  }


  public function getBooksAction(Request $request){
    try{
      $entity = $this->getBookService()->findAll();
      return FOSView::create($entity, Codes::HTTP_OK);
    } catch(\Exception $e) {
      return FOSView::create(['error'=>$e->getMessage()], Codes::HTTP_BAD_REQUEST);
    }
  }

  public function getBookAction($id){
    try{
      $entity = $this->getBookService()->find($id);
      return FOSView::create($entity, Codes::HTTP_OK);
    } catch(\Exception $e) {
      return FOSView::create(['error'=>$e->getMessage()], Codes::HTTP_BAD_REQUEST);
    }
  }

  public function postBookAction(Request $request) {
    try {
      $entity = $this->getBookService()->save($request);
      return FOSView::create($entity, 200);
    } catch (\Exception $e) {
      return FOSView::create(['error'=>$e->getMessage()], Codes::HTTP_BAD_REQUEST);
    }
  }
}
