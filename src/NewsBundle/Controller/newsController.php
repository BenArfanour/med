<?php

namespace NewsBundle\Controller;

use AuthentificationBundle\Entity\user;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\UserInterface;
use NewsBundle\Entity\news;
use NewsBundle\Entity\News_ADMIN;
use NewsBundle\Entity\News_PNC;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * News controller.
 *
 * @Route("news")
 */
class newsController extends Controller
{
    /**
     * Lists all news entities.
     *
     * @Route("/", name="news_index")
     * @Method("GET")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $news = $em->getRepository('NewsBundle:news')->findAll();

        return $this->render('news/index.html.twig', array(
            'news' => $news,
        ));
    }

    /**
     * Creates a new news entity.
     *
     * @Route("/new", name="news_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $news = new News();


        $form = $this->createForm('NewsBundle\Form\newsType', $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            // $file stores the uploaded PDF file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $news->getPj();
            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('news_directory'), $fileName);
            $news->setPj($fileName);

            $data = $form['typePnc']->getData();

            $repository = $this->getDoctrine()->getRepository('AuthentificationBundle:user');
            $query = $repository->createQueryBuilder('p')
                                ->where('p.type = :data')
                                ->setParameter('data', $data)
                                ->getQuery();

            $users = $query->getResult();

            foreach ($users as $o) {

                $newspnc = new News_PNC();
                $newspnc->setPncs($o);//jareb tawa
                $newspnc->setNews($news);
                 $newspnc->setLu('no');
                $em->persist($newspnc);
              }

            $em->persist($news);
            $em->flush();




            // return $this->redirectToRoute('news_affiche');

        }

        return $this->render('news/new.html.twig', array(
            'news' => $news,
            'form' => $form->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing news entity.
     *
     * @Route("/{id}/edit", name="news_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, news $news)
    {

        $editForm = $this->createForm('NewsBundle\Form\newsType', $news);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager();
            // $file stores the uploaded PDF file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file=$news->getPj();
            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('news_directory'), $fileName);
            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $news->setPj(new File($this->getParameter('brochures_directory').'/'.$news->getPj()));

            $em->persist($news);
            $em->flush();
            return $this->redirectToRoute('news_affiche');
        }

        return $this->render('news/edit.html.twig', array(
            'news' => $news,
            'form' => $editForm->createView(),

        ));
    }

    /**
     * Deletes a news entity.
     *
     * @Route("/{id}", name="news_delete")
     * @Method("DELETE")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $news = $em->getRepository('NewsBundle:news')->find($id);
        $em->remove($news);
        $em->flush();
        return $this->redirectToRoute('news_affiche');
    }




    /*
     * for Super Admin
     */

    public function indexxAction()
    {
        $em = $this->getDoctrine()->getManager();

        $news = $em->getRepository('NewsBundle:news')->findAll();

        return $this->render('news/index2.html.twig', array(
            'news' => $news,
        ));
    }

    public function newwAction(Request $request)
    {
        $news = new News();
        $em = $this->getDoctrine()->getManager();
        
        $form = $this->createForm('NewsBundle\Form\newsType', $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // $file stores the uploaded PDF file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file=$news->getPj();
            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('news_directory'), $fileName);
            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $news->setPj($fileName);

            $em->persist($news);
            $em->flush();

            return $this->redirectToRoute('newss_affiche');
        }

        return $this->render('news/new2.html.twig', array(
            'news' => $news,
            'form' => $form->createView(),
        ));
    }
    public function edittAction(Request $request, news $news)
    {

        $editForm = $this->createForm('NewsBundle\Form\newsType', $news);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager();
            // $file stores the uploaded PDF file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file=$news->getPj();
            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('news_directory'), $fileName);
            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $news->setPj(new File($this->getParameter('brochures_directory').'/'.$news->getPj()));

            $em->persist($news);
            $em->flush();
            return $this->redirectToRoute('newss_affiche');
        }

        return $this->render('news/edit2.html.twig', array(
            'news' => $news,
            'form' => $editForm->createView(),

        ));
    }

      public function deleteeAction($id)
    {
         $em = $this->getDoctrine()->getManager();
         $news = $em->getRepository('NewsBundle:news')->find($id);
         $em->remove($news);
         $em->flush();
        return $this->redirectToRoute('newss_affiche');
    }
 //Champs Lu
    public function luAction($idn)
    {
        $em = $this->getDoctrine()->getManager();
        $rech = $em->getRepository('NewsBundle:News_PNC')->find(intval($idn));

        $rech->setLu('lu');
        $em->persist($rech);
        $em->flush();
        return $this->redirectToRoute('pnc');
    }

 // Get all news
    public function getNewsAction()
    {
       /* $em = $this->getDoctrine()->getManager();
        $rech = $em->getRepository('NewsBundle:news')->findAll();
        $lu = $em->getRepository('NewsBundle:News_PNC')->findAll() ;
        return $this->render('popup.html.twig', array(
            'news' => $rech,
            'lu'=> $lu,
        ));*/


    }


    public function pncAction()
    {


        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
        /** @var UserInterface $user */
        $user= $this->getUser();

        $repository = $this->getDoctrine()->getRepository('NewsBundle:News_PNC');
        $query = $repository->createQueryBuilder('p')
                            ->where('p.pncs = :user')
                            ->andWhere('p.lu = :no')
                            ->leftJoin('p.news','news')
                            ->orderBy('news.type')
                            ->setParameter('user',$user->getId())
                           ->setParameter('no','no')

                            ->getQuery();
/** @var ArrayCollection of news_pnc */
        $news_pnc = $query->getResult();


           return $this->render('popup.html.twig',
            array('news_pnc' => $news_pnc )); }
            else {
            return $this->render('error.html.twig');
            }

    }

    public  function homeAction() {

        return $this->render('::DhashbordPnc.html.twig');

    }

    public  function lowAction($id) {
        $em = $this->getDoctrine()->getManager();
        $low= $em->getRepository('NewsBundle:news')->findOneBy(array('id'=>$id));

            return $this->render('news/low.html.twig', array('low' => $low));
    }
}
