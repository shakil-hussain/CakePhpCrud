<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
    </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <div class="row pt-3">
        <div class="col-md-8 mx-auto">
            <?php echo $this->Flash->render('message');?>
            <?php echo $this->Html->link('ADD POST',['action'=>'create'],['class'=>'btn btn-primary']);?>
            <table class="table">
                <thead>
                    <th>SI</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th style="width: 200px">Action</th>
                </thead>
                <tbody>
                <?php foreach($posts as $item): ?>
                    <tr>
                        <td><?php echo $item->id ?></td>
                        <td><?php echo $item->title ?></td>
                        <td><?php echo $item->category ?></td>
                        <td><?php echo $item->date ?></td>
                        <td> <?php echo $this->Html->link('EDIT',['action'=>'edit/'.$item->id],['class'=>'btn btn-primary'])?>
                            <?php echo $this->Html->link('DELETE',['action'=>'delete/'.$item->id],['class'=>'btn btn-danger p-2'])?></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" ></script>
</body>
</html>
