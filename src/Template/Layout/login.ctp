<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $title ?>
    </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <?php echo $this->Flash->render('message');?>
            <?= $this->Form->create() ?>
            <fieldset>
                <legend><?= __('Login Now') ?></legend>
                <?php
                echo $this->Form->control('username');
                echo $this->Form->control('password');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Login')) ?>
            <?php echo $this->Html->link('SignUp',['action'=>'signup'],['class'=>'btn btn-lg btn-primary'])?>

            <?= $this->Form->end() ?>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" ></script>
</body>
</html>
