<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Login;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{

	public function redirectAction(Request $request){
		return $this->redirectToRoute('admin_homepage');
	}

	public function getLoginService(){
		return $this->get('login.service');
	}

	private function getUserService(){
		return $this->get('user.service');
	}

	public function indexAction(Request $request)
	{

	    $authenticationUtils = $this->get('security.authentication_utils');

	    // get the login error if there is one
	    $error = $authenticationUtils->getLastAuthenticationError();

	    // last username entered by the user
	    $lastUsername = $authenticationUtils->getlastUsername();


      return $this->render('LoginBundle:Default:index.html.twig', array(
          'last_username' => $lastUsername,
          'error'         => $error,
      ));
	}

	public function checkAction(Request $request){
		if ($this->get('security.authorization_checker')->isGranted('ROLE_MANAGER')) {
			return $this->redirectToRoute('admin_homepage');
		}
		if ($this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
			return $this->redirectToRoute('user_homepage');
		}
		else{
			return $this->redirectToRoute('admin_homepage');
		}

	}

	public function forgotPasswordAction(Request $request){
		return $this->render('LoginBundle:Password:index.html.twig');
	}

	public function generatePasswordAction(Request $request, $token){
		try {
			$entity = $this->getLoginService()->getByToken($token);
			if (!$entity) {
				throw new \Exception("Não encontramos o seu e-mail em nossa base.");
			}
			return $this->render('LoginBundle:Password:generate-password.html.twig', array(
					'entity' => $entity
			));
		} catch (\Exception $e) {
			return $this->redirectToRoute('login');
		}
	}

	public function generateStorePasswordAction(Request $request, $token){
		try {
			$entity = $this->getStoreApiService()->getByToken($token);
			if (!$entity) {
				throw new \Exception("Não encontramos o seu e-mail em nossa base.");
			}
			return $this->render('LoginBundle:Store:generate-password.html.twig', array(
					'entity' => $entity
			));
		} catch (\Exception $e) {
			return $this->redirectToRoute('login');
		}
	}

	public function generateUserPasswordAction(Request $request, $token){
		try {
			$entity = $this->getUserService()->findByToken($token);
			if (!$entity) {
				throw new \Exception("Não encontramos o seu e-mail em nossa base.");
			}
			return $this->render('LoginBundle:Consumer:generate-password.html.twig', array(
					'entity' => $entity
			));
		} catch (\Exception $e) {
			return $this->redirectToRoute('login');
		}
	}

	public function userAction()
	{
			$login = $this->getUser();
			$entities = $this->getCurriculumService()->getEmails($login);
			$curriculum = $this->getCurriculumService()->getCurriculum($login);
			return $this->render('AdminBundle:Dashboard:user.html.twig', ['entities'=>$entities, 'curriculum'=>$curriculum]);
	}

	public function newUser(Request $request){
		if ($request->get('new_user')) {
      if (!$request->get('password')) {
        throw new \Exception("Password cannot be empty");
      }
      $role = $this->getRoleRepository()->findOneBy(['name'=>'ROLE_USER']);
      $login = new Login();
      $login->setUsername($request->get('email'));
      $login->setEmail($request->get('email'));
      $login->setPassword($request->get('password'));
      $login->setName($request->get('name'));
      $login->setIsActive(1);
      $login->setLoginType($role);
      $this->saveOrUpdate($login);
      $login->setToken(md5($login->getId().$this->container->getParameter('secret')));
      $this->saveOrUpdate($login);
    }
	}

}
