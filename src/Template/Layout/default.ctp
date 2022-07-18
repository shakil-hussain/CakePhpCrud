<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
<!--    --><?php //$this->Html->script('jquery3.6.js')?>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""><?= $this->fetch('title') ?></a></h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="right">
                <li><a href="<?= $this->Url->build(["controller"=>"Post","action"=>"index",'home'])?>">Home</a></li>
                <li><a href="<?= $this->Url->build(["controller"=>"Post","action"=>"index"])?>">Post</a></li>
                <li><a href="<?= $this->Url->build(["controller"=>"ContactUs","action"=>"index"])?>">Contact Us</a></li>
                <li>
                    <?php echo $this->Html->link('logout',['controller'=>'Users','action'=>'logout']);?>
                </li>
            </ul>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?= $this->fetch('filescripts')?>
    <script>
        jQuery.noConflict()(function ($) {
            $(document).ready(function () {
                $("#contactForm").submit(function(e){
                    e.preventDefault();
                    var formdata = $(this).serialize();
                    var csrf_token = $('[name="_csrfToken"]').val();
                    $.ajax({
                        headers: {
                            'X-CSRF-Token': <?= json_encode($this->request->getParam('_csrfToken')); ?>
                        },
                        type: "post",
                        url: `<?php echo $this->Url->build(["action"=>'add'])?>`,
                        data: formdata,
                        dataType:'json',
                        success: function (response) {
                            alert(response.result.status);
                            if(response.result.status == 'The contact us information has been saved.'){
                                $("#contactForm").trigger('reset');
                            }
                        }
                    });
                });
            });
            // $( function() {
            //     $( "#datepicker" ).datepicker();
            // });

            $("#deletePostData").click(function (e){
                alert('done');
            })
            // function deletePost(){
            //     alert("done");
            // }

        });
    </script>
<script>
    function saveContact(){
        $("#contactForm").preventDefault();

        $name = $("#name").val();
        $email = $("#email").val();
        $mesage = $("#mesage").val();
        console.log($name,$email,$mesage);
        alert("this is click me button");
    }
    function  postDelete(id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    jQuery.ajax({
                        url: `delete/`+id,
                        type:'get',
                        dataType: 'json',
                        success:function (res) {
                            if(res.result.status == 'success'){
                                Swal.fire({
                                    position: 'top-end',
                                    icon:  res.result.status,
                                    title: res.result.msg,
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                window.setTimeout(function(){location.reload()},1500)
                            }else{
                                Swal.fire({
                                    position: 'top-end',
                                    icon:  res.result.status,
                                    title: res.result.msg,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                window.setTimeout(function(){location.reload()},1500);
                            }
                        }
                    });
                }
            });
    }
</script>
</body>
</html>
