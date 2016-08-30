<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Rest controller.
 *
 * @Route("/api")
 */
class RestController extends Controller
{

    /**
     * @Route("/users", name="rest_users")
     * @return array
     * @View()
     */
    public function getUsersAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:user')->findAll(); // get data, in this case list of users.
        $usersAffi = array();
        foreach ($users as $user) {
            $userAffi = array('login'=>$user->getUsername(),'email'=>$user->getEmail());
            array_push($usersAffi,$userAffi);
        }
        return array('users'=>$usersAffi);
    }

    /**
     * @Route("/users/:{id}", name="rest_user")
     * @param User $user
     * @return array
     * @View()
     * @ParamConverter("user",class="AppBundle:User")
     */
    public function getUserAction(User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->findAll(); // get data, in this case list of users.

        return array('user'=>array('login'=>$user->getUsername(),'email'=>$user->getEmail(),'adresse'=>$user->getAdresse(),'telephone'=>$user->getNumero(),'sitweb'=>$user->getSiteweb()));
    }

}
