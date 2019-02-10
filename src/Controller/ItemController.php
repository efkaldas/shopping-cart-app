<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Finder\Finder;



 class ItemController extends Controller {
     /**
      * @Route("/")
      * @Method({"GET"})
      */
     public function index() {
        // return new Response('<html><body><h1>Hello</h1></body></html>');
        $finder = new Finder();
        $finder->name('asd*');

        $items = ['Item 1', 'Item 2', 'Item 3'];
        $path = $this->get('kernel')->getRootDir() . '/../txt' . 'asd.txt';
    //    $fileitems = file_get_contents($finder);
         return $this->render('items/index.html.twig', array('items' => $items, 'file' => "asd"));
     }
 }
?>