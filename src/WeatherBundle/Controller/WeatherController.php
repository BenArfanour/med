<?php
/**
 * Created by PhpStorm.
 * User: x0Geek
 * Date: 08/05/2017
 * Time: 01:56
 */

namespace WeatherBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WeatherController extends Controller
{

    public function weatherAction() {

       return $this->render('WeatherBundle::weather.html.twig');
    }

}