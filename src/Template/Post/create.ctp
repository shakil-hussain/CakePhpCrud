<div class="row pt-3">
        <div class="col-md-8 mx-auto">
            <h2>New Post</h2>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php echo $this->Html->link('Show List',['action'=>'index'],['class'=>'btn btn-primary float-right mb-3'])?>
                </div>
                <div class="panel-body pt-3">
<!--                    <form action="/post/create" id="postForm" method="post" enctype="multipart/form-data">-->
                    <?php echo $this->Form->create(NULL,array('url'=>'/post/create','type'=>'file','id'=>'postForm')); ?>
                    <div class="form-group">
                        <label class="form-label" id="title">Title</label>
                        <input type="text" name="title" id="title" required minlength="8" />
                    </div>
                    <div class="form-group">
                        <label class="form-label" id="category">Category</label>
                        <input type="text" name="category" id="category" required minlength="8" />
                    </div>
                    <div class="form-group">
                        <label class="form-label" id="image">Image</label>
                        <input type="file" name="image" id="image"  accept="image/*" />
                    </div>
<!--                    <div class="form-group date">-->
<!--                        <label class="form-label" id="date">Date</label>-->
<!--                        <input  type="text" name="date" class="datepicker"  />-->
<!--                    </div>-->

                    <p>Date: <input type="text" name="date" id="datepicker"></p>


                    <div class="form-group">
                       <button class="btn btn-secoundary btn-md" type="submit">Submit</button>
                    </div>

                    <?php echo $this->Form->end();?>
                </div>
                <div class="panel-footer">
                </div>
            </div>
        </div>
    </div>

    <?php echo $this->Html->script('post',['block'=>'filescripts']);?>
