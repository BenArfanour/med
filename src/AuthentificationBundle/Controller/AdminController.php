<?php

namespace AuthentificationBundle\Controller;

use AuthentificationBundle\Entity\Admin;
use AuthentificationBundle\Entity\user;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Admin controller.
 *
 * @Route("admin")
 */
class AdminController extends Controller
{
    /**
     * Lists all admin entities.
     *
     * @Route("/", name="admin_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $admins = $em->getRepository('AuthentificationBundle:user')->findAll();


        return $this->render('admin/index.html.twig', array(
            'admins' => $admins,
        ));
    }

    /**
     * Creates a new admin entity.
     *
     * @Route("/new", name="admin_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {

            $user= new user();
            $form = $this->createForm('AuthentificationBundle\Form\AdminType', $user);
            $form->handleRequest($request);


            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $postData = $form->getdata();
                $factory =  $this->get('security.encoder_factory');
                $encoder =  $factory->getEncoder($user);
                $password = $encoder->encodePassword($postData->getPassword(),$user->getSalt());
                $postData->setPassword($password);
                $user->setEnabled(true);
                $role = array ('ROLE_ADMIN');
                $user->setRoles($role);
                $em->persist($user);
                $em->flush();

                return $this->redirectToRoute('show_admin');
            }


            return $this->render('admin/new.html.twig', array(
                'user' => $user,
                'form' => $form->createView(),
            ));

    }


    /**
     * Displays a form to edit an existing admin entity.
     *
     * @Route("/{id}/edit", name="admin_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, user $user)
    {

        $editForm = $this->createForm('AuthentificationBundle\Form\AdminType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('show_admin');
        }

        return $this->render('admin/edit.html.twig', array(
            'admin' => $user,
            'form' => $editForm->createView(),

        ));
    }


    public function deleteAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $admin= $em->getRepository('AuthentificationBundle:user')->find($id);
        $em->remove($admin);
        $em->flush();
        return $this->redirectToRoute('show_admin');
    }


}
