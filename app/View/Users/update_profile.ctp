<?php
/**
 * @var $this View
 */
?>
<div class="col-md-9">
    <?php
    echo $this->Form->create('User', array('role' => 'form'));
    ?>
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
