<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        <?php echo $title_for_layout; ?>
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <?php
    echo $this->Html->meta('icon');
    echo $this->Html->css('legacy');
    echo $this->Html->css('bootstrap.min');
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    echo $this->Html->script('jquery-2.0.3.min');
    echo $this->Html->script('bootstrap.min');
    ?>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.2/html5shiv.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
        body {
            padding: 70px 0px;
        }
    </style>

</head>

<body>

<?php echo $this->Element('navigation'); ?>

<div class="container">

    <?php echo $this->Session->flash(); ?>


    <div class="users form">

        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1><?php echo $this->fetch('title'); ?></h1>
                </div>
            </div>
        </div>
        <?php echo $this->element('leftnav');?>
        <?php echo $this->fetch('content'); ?>
    </div>


</div>
<!-- /.container -->

</body>
</html>