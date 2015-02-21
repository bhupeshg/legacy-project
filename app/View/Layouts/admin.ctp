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
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

	<!-- Force latest IE rendering engine or ChromeFrame if installed -->
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->

    <?php
    	echo $this->Html->css('jquery_file_upload/jquery.fileupload');
    	echo $this->Html->css('jquery_file_upload/jquery.fileupload-ui.css');
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

<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?php echo $this->webroot; ?>js/jquery_file_upload/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="<?php echo $this->webroot; ?>js/jquery_file_upload/blueimp/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="http:<?php echo $this->webroot; ?>js/jquery_file_upload/blueimp/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="<?php echo $this->webroot; ?>js/jquery_file_upload/blueimp/canvas-to-blob.min.js"></script>

<!-- blueimp Gallery script -->
<script src="<?php echo $this->webroot; ?>js/jquery_file_upload/blueimp/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo $this->webroot; ?>js/jquery_file_upload/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo $this->webroot; ?>js/jquery_file_upload/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="<?php echo $this->webroot; ?>js/jquery_file_upload/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="<?php echo $this->webroot; ?>js/jquery_file_upload/jquery.fileupload-image.js"></script>
<!-- The File Upload validation plugin -->
<script src="<?php echo $this->webroot; ?>js/jquery_file_upload/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="<?php echo $this->webroot; ?>js/jquery_file_upload/jquery.fileupload-ui.js"></script>
<!-- The main application script -->
<script src="<?php echo $this->webroot; ?>js/jquery_file_upload/main.js"></script>

<?php
	/*echo $this->Html->script('vendor/jquery.ui.widget');
	echo $this->Html->script('jquery_file_upload/blueimp/tmpl.min');
	echo $this->Html->script('jquery_file_upload/blueimp/load-image.all.min');
	echo $this->Html->script('jquery_file_upload/blueimp/canvas-to-blob.min');
	echo $this->Html->script('jquery_file_upload/blueimp/jquery.blueimp-gallery.min');
	echo $this->Html->script('jquery_file_upload/jquery.iframe-transport');
	echo $this->Html->script('jquery_file_upload/jquery.fileupload');
	echo $this->Html->script('jquery_file_upload/jquery.fileupload-process');
	echo $this->Html->script('jquery_file_upload/jquery.fileupload-image');
	echo $this->Html->script('jquery_file_upload/jquery.fileupload-validate');
	echo $this->Html->script('jquery_file_upload/jquery.fileupload-ui');
	echo $this->Html->script('jquery_file_upload/main');*/
?>
</body>
</html>
