<?php

namespace NoteserviceBundle\Controller;

use AuthentificationBundle\Entity\Admin;
use AuthentificationBundle\Entity\user;
use NoteserviceBundle\Entity\Notesrv;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Notesrv controller.
 *
 * @Route("notesrv")
 */
class NotesrvController extends Controller
{
    /**
     * Lists all notesrv entities.
     *
     * @Route("/", name="notesrv_index")
     * @Method("GET")
     */
    public function showAction()
    {
        $em = $this->getDoctrine()->getManager();

        $notesrv = $em->getRepository('NoteserviceBundle:Notesrv')->findAll();

        return $this->render('notesrv/show.html.twig', array(
            'notesrv' => $notesrv,
        ));
    }

    /**
     * Creates a new notesrv entity.
     *
     * @Route("/new", name="notesrv_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $notesrv = new Notesrv();
        $a = $this->getUser() ;
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm('NoteserviceBundle\Form\NotesrvType', $notesrv);
        $form->handleRequest($request);
       // $admin = $em->getRepository('AuthentificationBundle:user')->find($a->getId());
        if ($form->isSubmitted() && $form->isValid()) {

            $max = $em->getRepository('PfeBundle:programmevol')->SelectMaxpnc();
            // $file stores the uploaded PDF file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file=$notesrv->getUpload();
            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('brochures_directory'), $fileName);
            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
           // $notesrv->setAdmin($a);
            $notesrv->setUpload($fileName);
            $em->persist($notesrv);
            $em->flush();

            var_dump($max);
           // return $this->redirectToRoute('noteservice_show');
        }

        return $this->render('notesrv/new.html.twig', array(
            'notesrv' => $notesrv,
            'form' => $form->createView(),
        ));
    }



    /**
     * Displays a form to edit an existing notesrv entity.
     *
     * @Route("/{id}/edit", name="notesrv_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Notesrv $notesrv)
    {

        $editForm = $this->createForm('NoteserviceBundle\Form\NotesrvType', $notesrv);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            // $file stores the uploaded PDF file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file=$notesrv->getUpload();
            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('brochures_directory'), $fileName);

            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $notesrv->setUpload(new File($this->getParameter('brochures_directory').'/'.$notesrv->getUpload()));
            $em->persist($notesrv);
            $em->flush();

            return $this->redirectToRoute('noteservice_show');
        }

        return $this->render('notesrv/edit.html.twig', array(
            'notesrv' => $notesrv,
            'form' => $editForm->createView(),

        ));
    }

    /**
     * Deletes a notesrv entity.
     *
     * @Route("/{id}", name="notesrv_delete")
     * @Method("DELETE")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $notesrv = $em->getRepository('NoteserviceBundle:Notesrv')->find($id);
        $em->remove($notesrv);
        $em->flush();
        return $this->redirectToRoute('noteservice_show');
    }

    /** super Admin  */
    /**
     * Lists all notesrv entities.
     *
     * @Route("/", name="notesrv_index")
     * @Method("GET")
     */
    public function showwAction()
    {
        $em = $this->getDoctrine()->getManager();

        $notesrv = $em->getRepository('NoteserviceBundle:Notesrv')->findAll();

        return $this->render('notesrv/show2.html.twig', array(
            'notesrv' => $notesrv,
        ));
    }

    /**
     * Creates a new notesrv entity.
     *
     * @Route("/new", name="notesrv_new")
     * @Method({"GET", "POST"})
     */
    public function newwAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $notesrv = new Notesrv();
        $user = $this->getUser();
        $form = $this->createForm('NoteserviceBundle\Form\NotesrvType', $notesrv);
        $form->handleRequest($request);
      //  $admin = $em->getRepository('AuthentificationBundle:user')->find($a->getId());
        if ($form->isSubmitted() && $form->isValid()) {


            // $file stores the uploaded PDF file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file=$notesrv->getUpload();
            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('brochures_directory'), $fileName);
            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
           $notesrv->setAdmin($user);
            $notesrv->setUpload($fileName);
            $em->persist($notesrv);
            $em->flush();

           // return $this->redirectToRoute('noteservicee_show');

        }

        return $this->render('notesrv/new2.html.twig', array(
            'notesrv' => $notesrv,
            'form' => $form->createView(),
        ));
    }



    /**
     * Displays a form to edit an existing notesrv entity.
     *
     * @Route("/{id}/edit", name="notesrv_edit")
     * @Method({"GET", "POST"})
     */
    public function edittAction(Request $request, Notesrv $notesrv)
    {

        $editForm = $this->createForm('NoteserviceBundle\Form\NotesrvType', $notesrv);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            // $file stores the uploaded PDF file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file=$notesrv->getUpload();
            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('brochures_directory'), $fileName);

            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $notesrv->setUpload(new File($this->getParameter('brochures_directory').'/'.$notesrv->getUpload()));
            $em->persist($notesrv);
            $em->flush();

            return $this->redirectToRoute('noteservicee_show');
        }

        return $this->render('notesrv/edit2.html.twig', array(
            'notesrv' => $notesrv,
            'form' => $editForm->createView(),

        ));
    }

    /**
     * Deletes a notesrv entity.
     *
     * @Route("/{id}", name="notesrv_delete")
     * @Method("DELETE")
     */
    public function deleteeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $notesrv = $em->getRepository('NoteserviceBundle:Notesrv')->find($id);
        $em->remove($notesrv);
        $em->flush();
        return $this->redirectToRoute('noteservicee_show');
    }


}
