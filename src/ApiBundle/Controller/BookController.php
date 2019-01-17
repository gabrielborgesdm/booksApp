<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View as FOSView;


class DefaultController extends FOSRestController
{
  public function getBookService(){
    return $this->get("api.book.service");
  }
  public function postBookAction() {
    try {
      $entity = $this->getBookService()->save($request);
      return FOSView::create("Deu Bom", Codes::200);
    } catch (\Exception $e) {
      return FOSView::create(['error'=>$e->getMessage()], Codes::HTTP_BAD_REQUEST);
    }
  }
}
