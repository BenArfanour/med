<?php

namespace RammassageBundle\Controller;


use AuthentificationBundle\Entity\user;
use PfeBundle\Entity\CompanyEvents;
use PfeBundle\Entity\programmevol;
use RammassageBundle\Entity\Rammassage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Rammassage controller.
 *
 * @Route("rammassage")
 *
 */
class rammassageController extends Controller
{
    /**
     * Lists all rammassage entities.
     *
     * @Route("/", name="rammassage_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $rammassages = $em->getRepository('RammassageBundle:rammassage')->findAll();

        return $this->render('rammassage/index.html.twig', array(
            'rammassages' => $rammassages,
        ));
    }

    /**
     * Creates a new rammassage entity.
     *
     * @Route("/new", name="rammassage_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $rammassage = new Rammassage();
        $comp = new CompanyEvents();

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $userprogvol = $em->getRepository('PfeBundle:programmevol')->findOneBy(array('users'=>$user));
        $vol= $userprogvol->getVols();
        $vols = $em->getRepository('PfeBundle:CompanyEvents')->findOneBy(array('code'=>$vol->getCode()));


        $form = $this->createForm('RammassageBundle\Form\rammassageType', $rammassage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

                $date1 = $vols->getStartDatetime();
                $date2= $rammassage->getDate();
                $intervalle = $date2->diff($date1);

            if ($intervalle->format('%H')  == '02' ) {

                $rammassage->setPncs($user);
                $em->persist($rammassage);
                $em->flush();

            }
            else  {
                return $this->render('rammassage\erreur.html.twig');
            }


         return $this->redirectToRoute('rammassage_show', array('id' => $rammassage->getId()));
    }

        return $this->render('rammassage/new.html.twig', array('rammassage' => $rammassage, 'form' => $form->createView(),));
    }

    /**
     * Finds and displays a rammassage entity.
     *
     * @Route("/{id}", name="rammassage_show")
     * @Method("GET")
     */
    public function showAction(rammassage $rammassage)
    {
        $deleteForm = $this->createDeleteForm($rammassage);

        return $this->render('rammassage/show.html.twig', array(
            'rammassage' => $rammassage,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing rammassage entity.
     *
     * @Route("/{id}/edit", name="rammassage_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, rammassage $rammassage)
    {
        $deleteForm = $this->createDeleteForm($rammassage);
        $editForm = $this->createForm('RammassageBundle\Form\rammassageType', $rammassage);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rammassage_edit', array('id' => $rammassage->getId()));
        }

        return $this->render('rammassage/edit.html.twig', array(
            'rammassage' => $rammassage,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a rammassage entity.
     *
     * @Route("/{id}", name="rammassage_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, rammassage $rammassage)
    {
        $form = $this->createDeleteForm($rammassage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($rammassage);
            $em->flush();
        }

        return $this->redirectToRoute('rammassage_index');
    }

    /**
     * Creates a form to delete a rammassage entity.
     *
     * @param rammassage $rammassage The rammassage entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(rammassage $rammassage)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('rammassage_delete', array('id' => $rammassage->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public  function  errorAction() {
        return $this->render ('rammassage/erreur.html.twig');
    }
}


