<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\Validation\Validator;

class PostController extends AppController
{
    private $connection;
    public $url;

    public function initialize()
    {
        parent::initialize();

        // project base url
        $this->url = Router::url('/', true);

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
    public function tableRregistry()
    {
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
        $fetchdata = $this->table->find("all")->where(["id" => 13])
            ->toList();
        // ->toArray();
        echo "<pre>";
        print_r($fetchdata);
        echo "</pre>";

    }

    // use of Connection Manager
    public function insertdata()
    {

        $this->autoRender = false;
        $id = 11;
        $fetchData = $this->connection->newQuery()->select("*")->from("post")->where(['id' => $id])->execute()->fetch("assoc");
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

    public function base64Image()
    {
        $iamgedata = $this->connection
            ->newQuery()
            ->select('*')
            ->from('image')
            ->where(['id' => 8])
            ->execute()
            ->fetch('assoc');

        $this->set('imagepath', $iamgedata['base']);

    }

    public function index()
    {

        $this->loadModel('Post');
        $this->set("base_url", $this->url);

        $datainfo = $this->Post->find("all");
//                    ->join([
//                        'image' => [
//                            'table' => 'image',
//                            'type' => 'INNER',
//                            'conditions' => 'image.post_id = post.id'
//                        ]
//                    ])->toArray();

//        echo "<pre>";
//        print_r($datainfo);
//        echo "</pre>";
//        die();
        $this->set("posts", $datainfo);

    }

    public function create()
    {

        $postIns = $this->table->newEntity();
        $form_data = $this->request->getData();

        if ($this->request->is('post')) {
            if ($this->request->data['image']['name']) {

                // image upload
                $uploadPath = "img/posts";
                $image_tmp_name = $this->request->data['image']['tmp_name'];
                $image_name = $this->request->data['image']['name'];
                $extension = pathinfo($image_name, PATHINFO_EXTENSION);
                $newImageName = uniqid() . '.' . $extension;

                $base64 = 'data:' . $this->request->data['image']['type'] . ';base64,' . base64_encode(file_get_contents($image_tmp_name));

                if (move_uploaded_file($image_tmp_name, WWW_ROOT . $uploadPath . "/" . $newImageName)) {
                    $postIns->image = $uploadPath . "/" . $newImageName;
                }
            }
            $postIns->title = $form_data['title'];
            $postIns->category = $form_data['category'];
            $postIns->date = $form_data['date'];

            if ($this->table->save($postIns)) {
                if (isset($base64)) {
                    $update = $this->connection->insert('image', [
                        "post_id" => $postIns->id,
                        "base" => $base64,
                    ]);
                }

                $this->Flash->success('Post Added Successfully', ['key' => 'message']);
                return $this->redirect(['action' => 'index']);
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

    public function edit($id)
    {
        $this->set("base_url", $this->url);
        $this->loadModel('Post');
        $this->set('info', $this->Post->get($id));

        $old_data = $this->connection
            ->newQuery()
            ->select('*')
            ->from('post')
            ->where(["id" => $id])
            ->execute()
            ->fetch('assoc');

        if ($this->request->is('post')) {

            $post_update_array = [
                "title" => $this->request->getData('title'),
                "category" => $this->request->getData('category'),
                "date" => date('Y-m-d h:m:s')
            ];
            // in case of image uploaded/selected
            if (!is_null($this->request->getData('image'))) {
                $uploadPath = "img/posts";
                $image_tmp_name = $this->request->data['image']['tmp_name'];
                $image_name = $this->request->data['image']['name'];
                if (move_uploaded_file($image_tmp_name, WWW_ROOT . $uploadPath . "/" . $image_name)) {
                    $updateImage = $uploadPath . "/" . $image_name;
                    // assign image key for updating
                    $post_update_array['image'] = $updateImage;
                }
            }

            $update = $this->connection->update('post', $post_update_array, ["id" => $id]);
            if ($update) {
                // in case of new image updated, need to trash old image
                if (isset($post_update_array['image']) and isset($old_data['image'])) {
                    unlink(WWW_ROOT . $old_data['image']);
                }
                $this->Flash->success('Post updated Successfully', ['key' => 'message']);
                return $this->redirect(['action' => 'index']);
            }
        }
        $this->Flash->error(_('Unable to add your post!'));
        return $this->redirect(['action' => 'edit/' . $id]);
    }



    public function delete($id)
    {
        $old_data = $this->connection
                    ->newQuery()
                    ->select('*')
                    ->from('post')
                    ->where(["id" => $id])
                    ->execute()
                    ->fetch('assoc');

        // Connection Manager procedure
        $delete = $this->connection->delete("post", [
            "id" => $id
        ]);
        $result = [];
        if($delete and isset($old_data['image'])){
            unlink(WWW_ROOT . $old_data['image']);
            $result = [
                'status' =>  'success',
                'msg' => 'Data Deleted Successfull'
            ];
        }
        $result = [
            'status' =>  'error',
            'msg' => 'Data Not Deleted'
        ];

        $this->response->type('json');
        $this->response->body(json_encode($result));
        return $this->response;

        //     $this->loadModel('Post');
        //     $entity = $this->Post->get($id);
        //     $result = $this->Post->delete($entity);
    }
}
