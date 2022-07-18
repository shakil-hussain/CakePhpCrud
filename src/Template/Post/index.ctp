
<div class="container">
    <div class="row pt-3">
        <div class="col-md-8 mx-auto">
            <?php echo $this->Flash->render('message');?>
            <h2 class="blockquote">Post Section</h2>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php echo $this->Html->link('ADD POST',
                        ['action'=>'create'],
                        ['class'=>'btn btn-primary float-right mb-3']);
                    ?>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <th class="text-center" >SI</th>
                        <th class="text-center">Title</th>
                        <th class="text-center">Category</th>
                        <th class="text-center">Image</th>
                        <th style="width: 200px" class="text-center">Action</th>
                        </thead>
                        <tbody>
                        <?php
                        if($posts->count()):
                            foreach($posts as $key=>$item): ?>
                                <tr>
                                    <td class="text-center"><?php echo ++$key ?></td>
                                    <td class="text-center"><?php echo $item->title ?></td>
                                    <td class="text-center"><?php echo $item->category ?></td>
                                    <td class="text-center"><img src="<?php echo $base_url.$item->image ?>" alt="No Image" srcset="" class="img img-fluid" style="width:80px;height:80px"></td>
                                    <td class="text-center"> <?php echo $this->Html->link('EDIT',['action'=>'edit/'.$item->id],['class'=>'btn btn-primary'])?>
                                        <button class="btn btn-lg btn-danger m-1 p-1"  onclick="postDelete(<?php echo $item->id?>)" >Delete data</button>
                                        <?php
//                                        echo $this->Html->link('DELETE',['action'=>'delete/'.$item->id],['class'=>'btn btn-danger p-2', "onclick"=>"return confirm('Are you sure?')"])
                                        ?>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                        else:
                            ?>
                            <tr class="text-center">
                                <td colspan="6" class="text-center"> No record found </td>
                            </tr>
                        <?php endif;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


