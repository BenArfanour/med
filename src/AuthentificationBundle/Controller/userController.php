<?php

namespace AuthentificationBundle\Controller;

use AuthentificationBundle\Entity\user;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * User controller.
 * @Route("user")
 */
class userController extends Controller
{
    /**
     * Lists all user entities.
     *
     * @Route("/", name="user_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('AuthentificationBundle:user')->findAll();
        return $this->render('user/index.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * Creates a new user entity.
     *
     * @Route("/new", name="user_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {

        $user = new user();
        $form = $this->createForm('AuthentificationBundle\Form\userType', $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $postData = $form->getdata();
            $factory =  $this->get('security.encoder_factory');
            $encoder =  $factory->getEncoder($user);
            $password = $encoder->encodePassword($postData->getPassword(),$user->getSalt());
            $postData->setPassword($password);
            $role= array('ROLE_USER');
            $user->setRoles($role);
            $user->setEnabled(true);

            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('show_user');
        }

        return $this->render('user/new.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }



    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/{id}/edit", name="user_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, user $user)
    {

        $editForm = $this->createForm('AuthentificationBundle\Form\userType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('show_user');
        }

        return $this->render('user/edit.html.twig', array(
            'user' => $user,
            'form' => $editForm->createView(),

        ));
    }

    /**
     * Deletes a user entity.
     *
     * @Route("/{id}", name="user_delete")
     * @Method("DELETE")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AuthentificationBundle:user')->find($id);
        $em->remove($user);
        $em->flush();
        return $this->redirectToRoute('show_user');
    }

    /** Super Admin  */

    public function indexxAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('AuthentificationBundle:user')->findAll();

        return $this->render('user/index2.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * Creates a new user entity.
     *
     * @Route("/new", name="user_new")
     * @Method({"GET", "POST"})
     */
    public function newwAction(Request $request)
    {
        $user = new user();
        $form = $this->createForm('AuthentificationBundle\Form\userType', $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $postData = $form->getdata();
            $factory =  $this->get('security.encoder_factory');
            $encoder =  $factory->getEncoder($user);
            $password = $encoder->encodePassword($postData->getPassword(),$user->getSalt());
            $postData->setPassword($password);
            $role = array('ROLE_USER');
            $user->setRoles($role);
            $user->setEnabled(true);
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('showw_user');
        }

        return $this->render('user/new2.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),

        ));
    }



    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/{id}/edit", name="user_edit")
     * @Method({"GET", "POST"})
     */
    public function edittAction(Request $request, user $user)
    {

        $editForm = $this->createForm('AuthentificationBundle\Form\userType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('showw_user');
        }

        return $this->render('user/edit2.html.twig', array(
            'user' => $user,
            'form' => $editForm->createView(),

        ));
    }

    /**
     * Deletes a user entity.
     *
     * @Route("/{id}", name="user_delete")
     * @Method("DELETE")
     */
    public function deleteeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AuthentificationBundle:user')->find($id);
        $em->remove($user);
        $em->flush();
        return $this->redirectToRoute('showw_user');
    }


    public  function selfAction() {

        return $this->render('@Authentification/Profile/show.html.twig');

    }



}
