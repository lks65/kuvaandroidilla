<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();


    $app->get('/page', function (Request $request, Response $response, array $args) use ($container) {

        return $container->get('renderer')->render($response, 'page.phtml', $args);
    });

    $app->get('/download', function() use ($app) {

      $file = "http://www.format-papier-a0-a1-a2-a3-a4-a5.fr/format-a4/a4.jpg";

      $image = dirname(__FILE__).DIRECTORY_SEPARATOR.’my_image.png’;
      $pdf = new FPDF();
      $pdf->AddPage();
      $pdf->Image($file,0,0,210,297);
      $document = $pdf->Output();

      header("Content-Description: File Transfer");
      header("Content-Type: application/pdf");
      header("Content-Disposition: attachment; filename=" . A4);

      readfile ($document);
    });
};
