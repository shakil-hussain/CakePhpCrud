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

            <?php
            echo $this->Form->create(NULL,array('url'=>'/post/create','type'=>'file'));
            echo $this->Form->control('title');
            echo $this->Form->control('category');
            echo $this->Form->file('image',['accept'=>'image/*']);
            echo $this->Form->input('date',['class'=>'form-control','type'=>'date']);
            echo $this->Form->button('Submit');
            echo $this->Form->end();
            ?>

        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" ></script>
</body>
</html>
