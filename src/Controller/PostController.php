<?php

namespace App\Controller;
use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\Routing\Router;

class PostController extends AppController
{
    private $connection;
    public $url;

    public function initialize()
    {
        parent::initialize();

        $this->connection = ConnectionManager::get('default');
        $this->url = Router::url('/');
    }
    public function insertdata(){
        $this->connection->insert('post',[
            "title" => "connection manager3",
            "category"=> "manager of connection",
            "date" => date('Y-m-d h:m:s')
        ]);
    }
    public function index(){

        $this->loadModel('Post');

        $this->set("posts",$this->Post->find("all"));

    }
    public function create(){

        // vie connection Manager

        // if($this->request->is('post')){
        //     $result = $this->connection->insert('post',[
        //             "title" => $this->request->getData('title'),
        //             "category"=> $this->request->getData('category'),
        //             // "date" => $this->request->getData('date')
        //         ]);

        //     if($result){
        //         $this->Flash->success('Post Added Successfully',['key'=> 'message']);
        //         return $this->redirect(['action'=>'index']);
        //     }
        //     $this->Flash->error(_('Unable to add your post!'));
        // }

        // manually connect with loadModel

        $this->loadModel('Post');
        $post = $this->Post->newEntity();
        if($this->request->is('post')){

            // trying to upload image

            // $file = $this->request->getData('image');
            // $uploadPath = '../posts/';
            // $destination = $uploadPath.$file->getClientFilename();
            // $file->moveTo($destination);
            // $post['image'] = $destination;

            $post = $this->Post->patchEntity($post,$this->request->getData());
            if($this->Post->save($post)){
                $this->Flash->success('Post Added Successfully',['key'=> 'message']);
                return $this->redirect(['action'=>'index']);
            }
            $this->Flash->error(_('Unable to add your post!'));
        }
    }
    // public function store(){

    //     $post = $this->Post->newEntity();
    //     if($this->request->is('post')){
    //         $post = $this->Post->putEntity($post,$this->request->getData());
    //         if($this->Post->save($post)){
    //             $this->Falsh->success('Post Added Successfully',['key'=> 'Message']);
    //             return $this->redirect(['action'=>'index']);
    //         }
    //         $this->Flash->error(_('Unable to add your post!'));
    //         $this->set('post',$post);
    //     }
    // }
    public function edit($id){

        $this->loadModel('Post');
        $this->set('info',$this->Post->get($id));

    }
    public function update($id){

        // $conn = ConnectionManager::get('default');
        // $stmt = $conn->execute('UPDATE post SET published = ? WHERE id = ?', [1, 2]);

    // $this->autoRender = false;
        $this->loadModel('Post');
        // print_r($this->request->getData());
        // $post = $this->Post->newEntity();
        // var_dump($post);
        if($this->request->is('post')){

            $post = $this->request->getData();

        // var_dump($post);

            if($this->Post->set($post)){
                $this->Flash->success('Post updated Successfully',['key'=> 'message']);
                return $this->redirect(['action'=>'index']);
            }
            $this->Flash->error(_('Unable to add your post!'));
        }
    }
    public function delete($id){

        $this->loadModel('Post');
        $entity = $this->Post->get($id);
        $result = $this->Post->delete($entity);

        if($result){
            $this->Flash->success('Post Deleted Successfully',['key'=> 'message']);
                return $this->redirect(['action'=>'index']);
        }
    }
}
