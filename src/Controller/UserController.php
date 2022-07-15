<?php

namespace App\Controller;
use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

class UserController extends AppController
{
    public function index(){

        $this->loadModel('Post');

        $this->set("posts",$this->Post->find("all"));

    }
    public function create(){
        $this->loadModel('Post');
        $post = $this->Post->newEntity();
        if($this->request->is('post')){
            $post = $this->Post->patchEntity($post,$this->request->getData());
            if($this->Post->save($post)){
                $this->Flash->success('Post Added Successfully',['key'=> 'message']);
                return $this->redirect(['action'=>'index']);
            }
            $this->Flash->error(_('Unable to add your post!'));
        }
    }
    public function store(){

        $post = $this->Post->newEntity();
        if($this->request->is(post)){
            $post = $this->Post->putEntity($post,$this->request->getData());
            if($this->Post->save($post)){
                $this->Falsh->success('Post Added Successfully',['key'=> 'Message']);
                return $this->redirect(['action'=>'index']);
            }
            $this->Flash->error(_('Unable to add your post!'));
            $this->set('post',$post);
        }
    }
    public function edit($id){

        $this->loadModel('Post');
        $this->set('info',$info = $this->Post->get($id));

//        print_r($this->request->params['pass']);
    }
    public function update($id){

        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('UPDATE post SET published = ? WHERE id = ?', [1, 2]);

        $this->loadModel('Post');
        $post = $this->Post->newEntity();
        if($this->request->is('post')){
            $post = $this->Post->patchEntity($post,$this->request->getData());
            if($this->Post->save($post)){
                $this->Flash->success('Post Added Successfully',['key'=> 'message']);
                return $this->redirect(['action'=>'index']);
            }
            $this->Flash->error(_('Unable to add your post!'));
        }
    }
    public function delete(){
        $this->autoRender = false;
        echo 'info',"this is delete Methode from User Controller";
    }
}
