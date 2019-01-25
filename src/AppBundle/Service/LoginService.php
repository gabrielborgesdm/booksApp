<?php

namespace AdminBundle\Service;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use AdminBundle\Service\BaseService;
use AppBundle\Entity\Login;

class LoginService extends BaseService
{

  private $container;

  public function __construct(EntityManager $em, $container)
  {
      $this->em = $em;
      $this->container = $container;
  }

  protected function getRepository(){
    return $this->em->getRepository('AppBundle:Login');
  }

  public function save($request){
    $entity = new Login();
    $entity->setUsername($request->get('email'));
    $entity->setEmail($request->get('email'));
    $entity->setPassword($request->get('password'));
    $entity->setName($request->get('name'));
    if ($request->get('active') == 'on') {
      $entity->setIsActive(1);
    }
    else{
      $entity->setIsActive(0);
    }
    $this->saveOrUpdate($entity);

    return $entity;
  }

  public function update($request, $id){
    $entity = $this->getById($id);
    $entity->setUsername($request->get('email'));
    $entity->setEmail($request->get('email'));
    if ($request->get('password')) {
      $entity->setPassword($request->get('password'));
    }
    $entity->setName($request->get('name'));
    if ($request->get('active') == 'on') {
      $entity->setIsActive(1);
    }
    else{
      $entity->setIsActive(0);
    }
    $this->saveOrUpdate($entity);

    return $entity;
  }

  public function remove($id){
    $entity = $this->getById($id);
    if (!$entity) {
      throw new \Exception("Login não encontrado");
    }
    $this->delete($entity);
    return $entity;
  }

  public function getById($id){
    return $this->getRepository()->find($id);
  }

  public function getActives(){
    return $this->getRepository()->findBy(['isActive'=>1]);
  }

  public function getAll(){
    return $this->getRepository()->findAll();
  }

}
