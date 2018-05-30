<?php
/**
 * Created by PhpStorm.
 * User: x0Geek
 * Date: 04/05/2017
 * Time: 06:52
 */

namespace PfeBundle\Controller;

use Ob\HighchartsBundle\Highcharts\Highchart;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class programmevolController extends Controller
{
    public function testAction()
{
    $em = $this->getDoctrine()->getManager();
    $max = $em->getRepository('PfeBundle:programmevol')->SelectMaxpnc();
    $min = $em->getRepository('PfeBundle:programmevol')->SelectMinpnc();
  /* dump($max);
    exit() ;*/
    $tab = array();
    $nbrvol = array();



    foreach ($max as $row) {
        foreach ($min as $r) {
          $nbrmax = $row['nb'];
          $nbrmin = $r['nb'];
            array_push($nbrvol,intval($nbrmax) );
            array_push($tab, $row['nom']);
            array_push($tab, $r['nom']);
            array_push($nbrvol,intval($nbrmin));

        }
    }



    // Chart
    $series = array(
        array("name" => "Nombre de Vols",    "data" => $nbrvol)

    );

    $ob = new Highchart();
    $ob->chart->renderTo('barchart');
    $ob->title->text("<h1>indicateurs d'activités </h1>");
    $ob->xAxis->title(array('text'  => "Nom du PNC"));
    $ob->yAxis->title(array('text'  => "Nombre de Vols"));
    $ob->xAxis->categories($tab);
    $ob->yAxis->max($nbrvol[0]);
    $ob->yAxis->min(0);
    $ob->series($series);

    return $this->render('companyevents/charts.html.twig',array('chart'=>$ob));
    }

}