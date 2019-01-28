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

	public function getLoginService(){
		return $this->get('login.service');
	}

	public function redirectAction(Request $request){
		return $this->redirectToRoute('admin_homepage');
	}

	public function indexAction(Request $request)
	{

	    $authenticationUtils = $this->get('security.authentication_utils');

	    // get the login error if there is one
	    $error = $authenticationUtils->getLastAuthenticationError();

	    // last username entered by the user
	    $lastUsername = $authenticationUtils->getlastUsername();


      return $this->render('AppBundle:Default:login.html.twig', array(
          'last_username' => $lastUsername,
          'error'         => $error,
      ));
	}

	public function checkAction(Request $request){
		if ($this->get('security.authorization_checker')->isGranted('ROLE_MANAGER')) {
			return $this->redirectToRoute('admin_homepage');
		}
		else{
			return $this->redirectToRoute('app_homepage');
		}

	}

	public function adminAction(){

			return $this->render('AppBundle:Admin:index.html.twig');
	}

	public function newUser(Request $request){

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
