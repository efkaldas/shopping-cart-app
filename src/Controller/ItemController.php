<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;



 class ItemController extends Controller {   

    public function setData() {
        $obj[] = new namespace\Itemm();
        //$file = file(__DIR__ . "\asd.txt");
        $line[] = array();


        if ($file = fopen(__DIR__ . "\itemData.txt", "r")) {
            $i = 0;
            while(!feof($file)) {
                $line = fgets($file);
                $elem = explode(';',$line,5);
                if(count($elem) == 5 && $elem[2] > 0)
                {
                    $obj[$i] = new namespace\Itemm();
                    $obj[$i]->id = $elem[0];
                    $obj[$i]->name = $elem[1];
                    $obj[$i]->quantity = $elem[2];
                    $obj[$i]->price = $elem[3];
                    $obj[$i]->currency = $elem[4];
                    $i++; 
                }               
            }
            fclose($file);
        }
        return $obj;
    }
     /**
      * @Route("/")
      * @Method({"GET"})
      */
     public function index() {
        $obj = $this->setData();

        $ballance = 0;

        foreach($obj as $obbj) {
            if($obbj->currency === 'USD') {
                $ballance = $ballance + $obbj->quantity *  $obbj->price * 1.14;
            } else if($obbj->currency === 'GBP') {
                $ballance = $ballance + $obbj->quantity * $obbj->price * 0.88;
            } else {
                $ballance = $ballance + $obbj->quantity * $obbj->price;
            }
        }
                
    
         return $this->render('items/index.html.twig', array('items' => $obj, 'ballance' => $ballance));
     }
        /**
      * @Route("/cart")
      */
      public function cart() {
        // return new Response('<html><body><h1>Hello</h1></body></html>');
       

         return $this->render('items/cart.html.twig');
     }
 } 
 

class Itemm {
    public $id;
    public $name;
    public $quantity;
    public $price;
    public $currency;
   
    public function __construct() {

    }
    public function __construct1($id, $name, $quantity, $price, $currency) {
        $this->id = $id;
        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->currency = $currency;
    }
    function is_edible()
    {
        return $this->id;
    }
    
    public function __toString() {
        return ("Item: {$this->name} Quantity: {$this->quantity} Price: {$this->price}\r\n");
      }
}


?>