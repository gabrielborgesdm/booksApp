<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View as FOSView;
use Symfony\Component\HttpFoundation\Request;



class PublisherController extends FOSRestController
{
  public function getPublisherService(){
    return $this->get("api.publisher.service");
  }

  public function getPublishersAction(Request $request){
    try{

      $entity = $this->getPublisherService()->findAll();
      return FOSView::create($entity, Codes::HTTP_OK);
    } catch(\Exception $e) {
      return FOSView::create(['error'=>$e->getMessage()], Codes::HTTP_BAD_REQUEST);
    }
  }

  public function getPublisherAction($id){
    try{
      $entity = $this->getPublisherService()->find($id);
      return FOSView::create($entity, Codes::HTTP_OK);
    } catch(\Exception $e) {
      return FOSView::create(['error'=>$e->getMessage()], Codes::HTTP_BAD_REQUEST);
    }
  }

  public function postPublisherAction(Request $request) {
    try {
      //I'll create a security token later
      $securityContext = $this->container->get('security.authorization_checker');
      if (!$securityContext->isGranted('ROLE_MANAGER')) {
        return FOSView::create("Acess Unauthorized", Codes::HTTP_UNAUTHORIZED);
      }
      $entity = $this->getPublisherService()->save($request);
      return FOSView::create($entity, 200);
    } catch (\Exception $e) {
      return FOSView::create(['error'=>$e->getMessage()], Codes::HTTP_BAD_REQUEST);
    }
  }

  public function deletePublisherAction($id) {
    try {

      //I'll create a security token later
      $securityContext = $this->container->get('security.authorization_checker');
      if (!$securityContext->isGranted('ROLE_MANAGER')) {
        return FOSView::create("Acess Unauthorized", Codes::HTTP_UNAUTHORIZED);
      }
      $entity = $this->getPublisherService()->find($id);
      $entity = $this->getPublisherService()->delete($entity);

      return FOSView::create($entity, 200);
    } catch (\Exception $e) {
      return FOSView::create(['error'=>$e->getMessage()], Codes::HTTP_BAD_REQUEST);
    }
  }
}
