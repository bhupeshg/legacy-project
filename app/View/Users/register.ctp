<?php
/**
 * @var $this View
 */
?>
<div class="users view">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1><?php echo __('Register'); ?></h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            echo $this->Form->create('User', array('role' => 'form'));
            echo $this->Form->hidden('code');
            ?>
            <div class="form-group">
                <?php echo $this->Form->input('username', array('type' => 'email', 'class' => 'form-control', 'placeholder' => 'Username'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('password', array('class' => 'form-control', 'placeholder' => 'Password'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('password_confirm', array('class' => 'form-control', 'placeholder' => 'Password', 'type' => 'password'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('karmi_name', array('class' => 'form-control', 'placeholder' => 'Karmi Name'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('initiated_name', array('class' => 'form-control', 'placeholder' => 'Initiated Name'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('place_of_initiation', array('class' => 'form-control', 'placeholder' => 'Place Of Initiation'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('date_of_initiation', array('class' => 'form-control', 'placeholder' => 'Date Of Initiation'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('description', array('class' => 'form-control', 'placeholder' => 'Description'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
            </div>

            <?php echo $this->Form->end() ?>

        </div>
        <!-- end col md 9 -->

    </div>
</div>

