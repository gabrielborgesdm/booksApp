<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View as FOSView;
use Symfony\Component\HttpFoundation\Request;



class AuthorController extends FOSRestController
{
  public function getAuthorService(){
    return $this->get("api.author.service");
  }
  public function postAuthorAction(Request $request) {
    try {
      $entity = $this->getAuthorService()->save($request);
      return FOSView::create($entity, 200);
    } catch (\Exception $e) {
      return FOSView::create(['error'=>$e->getMessage()], Codes::HTTP_BAD_REQUEST);
    }
  }
}
