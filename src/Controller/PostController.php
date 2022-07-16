<?php

namespace App\Controller;
use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;

class PostController extends AppController
{
    private $connection;
    public $url;

    public function initialize()
    {
        parent::initialize();

        // project base url
        $this->url = Router::url('/',true);

        // Project database Conection by using Connection Manager
        /*
         *  it is a database connection instance name default
         *  in config/app.php datasource array
         */
        $this->connection = ConnectionManager::get('default');

        // table Connection by using ORM Table Registry
        /*
         *  it is a table instance
         */
        $this->table = TableRegistry::get('post');
    }

    // Table Registry ORM Methode
    public function tableRregistry(){
        $this->autoRender = false;

        // insert data in post table by using table registry
        // $tableIns = $this->table->newEntity();

        // $tableIns->title = "table Registry1";
        // $tableIns->category = "table Registry1 Category";
        // $tableIns->date = date('Y-m-d h:m:s');
        // $this->table->save($tableIns);
        // // get last id
        // echo $tableIns->id;

        // fetch data
        $fetchdata = $this->table->find("all")->where(["id"=>13])
        ->toList();
        // ->toArray();
        echo "<pre>";
        print_r($fetchdata);
        echo "</pre>";

    }

    // use of Connection Manager
    public function insertdata(){

        $this->autoRender = false;
        $id = 11;
        $fetchData = $this->connection->newQuery()->select("*")->from("post")->where(['id'=>$id])->execute()->fetch("assoc");
        // $fetchData = $this->connection->execute("SELECT * FROM post WHERE id = :id",["id"=>$id])->fetch("assoc");
        echo "<pre>";
        print_r($fetchData);
        echo "</pre>";

        // $this->connection->insert('post',[
        //     "title" => "connection manager3",
        //     "category"=> "manager of connection",
        //     "date" => date('Y-m-d h:m:s')
        // ]);
    }
    public function index(){

        $this->loadModel('Post');

        $this->set("base_url",$this->url);
        $this->set("posts",$this->Post->find("all"));

    }
    public function create(){

        $postIns = $this->table->newEntity();
        $form_data = $this->request->getData();

        if($this->request->is('post')){

            // image upload
            $uploadPath = "img/posts";
            $image_tmp_name = $this->request->data['image']['tmp_name'];
            $image_name = $this->request->data['image']['name'];
            if(move_uploaded_file($image_tmp_name,WWW_ROOT.$uploadPath."/".$image_name)){
                $postIns->image = $uploadPath."/".$image_name;
            }
            $postIns->title = $form_data['title'];
            $postIns->category = $form_data['category'];
            $postIns->date = date('Y-m-d h:m:s');

            if($this->table->save($postIns)){
                $this->Flash->success('Post Added Successfully',['key'=> 'message']);
                return $this->redirect(['action'=>'index']);
            }
            $this->Flash->error(_('Unable to add your post!'));
        }

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

        // $this->loadModel('Post');


    }

    public function edit($id){
        $this->set("base_url",$this->url);
        $this->loadModel('Post');
        $this->set('info',$this->Post->get($id));

        $old_data = $this->connection->newQuery()->select('*')->from('post')->where(["id"=>$id])->execute()->fetch('assoc');

        if($this->request->is('post')){
//            $updateImage = "";
//            if(!is_null($this->request->getData('image'))){
//                $uploadPath = "img/posts";
//                $image_tmp_name = $this->request->data['image']['tmp_name'];
//                $image_name = $this->request->data['image']['name'];
//                if(move_uploaded_file($image_tmp_name,WWW_ROOT.$uploadPath."/".$image_name)){
//                    $updateImage = $uploadPath."/".$image_name;
//                }
//            }
            $update = $this->connection->update('post',[
                "title" => $this->request->getData('title'),
                "category"=> $this->request->getData('category'),
//                        "image"=> $updateImage ? $updateImage : $old_data['image'],
                "date" => date('Y-m-d h:m:s')
            ],
                [
                    "id"=>$id
                ]);

            if($update){

//                if($updateImage) unlink($old_data['image']);

                $this->Flash->success('Post updated Successfully',['key'=> 'message']);
                return $this->redirect(['action'=>'index']);
            }
            $this->Flash->error(_('Unable to add your post!'));
            return $this->redirect()->back();
        }

    }
    public function update($id){

        $old_data = $this->connection->newQuery()->select('*')->from('post')->where(["id"=>$id])->execute()->fetch('assoc');

        if($this->request->is('post')){
//            $updateImage = "";
//            if(!is_null($this->request->getData('image'))){
//                $uploadPath = "img/posts";
//                $image_tmp_name = $this->request->data['image']['tmp_name'];
//                $image_name = $this->request->data['image']['name'];
//                if(move_uploaded_file($image_tmp_name,WWW_ROOT.$uploadPath."/".$image_name)){
//                    $updateImage = $uploadPath."/".$image_name;
//                }
//            }
            $update = $this->connection->update('post',[
                        "title" => $this->request->getData('title'),
                        "category"=> $this->request->getData('category'),
//                        "image"=> $updateImage ? $updateImage : $old_data['image'],
                        "date" => date('Y-m-d h:m:s')
                    ],
                    [
                        "id"=>$id
                    ]);

            if($update){

//                if($updateImage) unlink($old_data['image']);

                $this->Flash->success('Post updated Successfully',['key'=> 'message']);
                return $this->redirect(['action'=>'index']);
            }
            $this->Flash->error(_('Unable to add your post!'));
            return $this->redirect()->back();
        }

    }
    public function delete($id){
    // Connection Manager procedure
        $result = $this->connection->delete("post",[
            "id"=> $id
        ]);
    //     $this->loadModel('Post');
    //     $entity = $this->Post->get($id);
    //     $result = $this->Post->delete($entity);

        if($result){
            $this->Flash->success('Post Deleted Successfully',['key'=> 'message']);
                return $this->redirect(['action'=>'index']);
        }
    }
}
