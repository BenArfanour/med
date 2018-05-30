<?php
/**
 * Created by PhpStorm.
 * User: x0Geek
 * Date: 16/04/2017
 * Time: 04:12
 */

namespace PfeBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class testController extends Controller
{
   public function testAction() {

       return $this->render('Calendar.html.twig');
   }


}