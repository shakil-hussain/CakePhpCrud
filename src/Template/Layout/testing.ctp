<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $title ?>
    </title>
</head>
<body>
    <?= $this->element('header') ?>

    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>

    <?= $this->element('footer') ?>

</body>
</html>
