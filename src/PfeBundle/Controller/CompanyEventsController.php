<?php

namespace PfeBundle\Controller;


use PfeBundle\Entity\CompanyEvents;
use PfeBundle\Entity\programmevol;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;



/**
 * Companyevent controller.
 *
 * @Route("companyevents")
 */
class CompanyEventsController extends Controller
{


    /**
     * Lists all companyEvent entities.
     *
     * @Route("/", name="companyevents_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $companyEvents = $em->getRepository('PfeBundle:CompanyEvents')->findAll();

        return $this->render('companyevents/index.html.twig', array(
            'companyEvents' => $companyEvents,
        ));
    }


    /**
     * Creates a new companyEvent entity.
     *
     * @Route("/new", name="companyevents_new")
     * @Method({"GET", "POST"})
     */

    public function newAction(Request $request)
    {

        $companyEvent = new CompanyEvents();
        $programvol = new programmevol();
         $form = $this->createForm('PfeBundle\Form\CompanyEventsType', $companyEvent);
         $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $companyEvent->setBgColor('#45b2ea');
            $companyEvent->setAllDay(false);
            $f = $form['title']->getData();
            $u =  $em->getRepository('AuthentificationBundle:user')->find($f);
           $programvol->setVols($companyEvent);
             $programvol->setUsers($u);
            $em->persist($programvol);
            $em->persist($companyEvent);
            $em->flush();




            return $this->redirectToRoute('show_ProgVol');
        }

        return $this->render('companyevents/new.html.twig', array(
            'companyEvent' => $companyEvent,
            'form' => $form->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing companyEvent entity.
     *
     * @Route("/{id}/edit", name="companyevents_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CompanyEvents $companyEvent)
    {

        $editForm = $this->createForm('PfeBundle\Form\CompanyEventsType', $companyEvent);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('show_ProgVol');
        }

        return $this->render('companyevents/edit.html.twig', array(
            'companyEvent' => $companyEvent,
            'form' => $editForm->createView(),

        ));
    }

    /**
     * Deletes a companyEvent entity.
     *
     * @Route("/{id}", name="companyevents_delete")
     * @Method("DELETE")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $vol = $em->getRepository('PfeBundle:CompanyEvents')->find($id);
        $em->remove($vol);
        $em->flush();
        return $this->redirectToRoute('show_ProgVol');
    }

    /*Supr ADMIN  */

    public function indexxAction()
    {
        $em = $this->getDoctrine()->getManager();

        $companyEvents = $em->getRepository('PfeBundle:CompanyEvents')->findAll();

        return $this->render('companyevents/index2.html.twig', array(
            'companyEvents' => $companyEvents,
        ));
    }



    public function newwAction(Request $request)
    {
        $companyEvent = new CompanyEvents();
        $programvol = new programmevol();
        $form = $this->createForm('PfeBundle\Form\CompanyEventsType', $companyEvent);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $companyEvent->setBgColor('#45b2ea');
            $companyEvent->setAllDay(false);
            $f = $form['title']->getData();
            $u =  $em->getRepository('AuthentificationBundle:user')->find($f);
            $programvol->setVols($companyEvent);
            $programvol->setUsers($u);
            $em->persist($programvol);
            $em->persist($companyEvent);
            $em->flush();




            return $this->redirectToRoute('showw_ProgVol');
        }

        return $this->render('companyevents/new2.html.twig', array(
            'companyEvent' => $companyEvent,
            'form' => $form->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing companyEvent entity.
     *
     * @Route("/{id}/edit", name="companyevents_edit")
     * @Method({"GET", "POST"})
     */
    public function edittAction(Request $request, CompanyEvents $companyEvent)
    {

        $editForm = $this->createForm('PfeBundle\Form\CompanyEventsType', $companyEvent);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('showw_ProgVol');
        }

        return $this->render('companyevents/edit2.html.twig', array(
            'companyEvent' => $companyEvent,
            'form' => $editForm->createView(),

        ));
    }

    /**
     * Deletes a companyEvent entity.
     *
     * @Route("/{id}", name="companyevents_delete")
     * @Method("DELETE")
     */
    public function deleteeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $vol = $em->getRepository('PfeBundle:CompanyEvents')->find($id);
        $em->remove($vol);
        $em->flush();
        return $this->redirectToRoute('showw_ProgVol');
    }


}
