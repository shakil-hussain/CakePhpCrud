<?php
namespace App\Controller;

use Cake\Routing\Router;

class TestController extends AppController{

    public $url;
    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->layout('testing');

        $this->url = Router::url('/',true);
    }
    public function index(){

        // echo "<img src='".$this->url."/webroot/img/cake-logo.png'>";
        // die();
        $this->set('img',$this->url);
        $this->set('title','Testing CAKE PHP title');
    }
}
