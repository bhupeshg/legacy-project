<?php
/**
*@var $this View
*/
    ?>
<div class="users view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Login'); ?></h1>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
            <?php echo $this->Form->create('User', array('role' => 'form')); ?>

            <div class="form-group">
                <?php echo $this->Form->input('username', array('class' => 'form-control', 'placeholder' => 'Username'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('password', array('class' => 'form-control', 'placeholder' => 'Password'));?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default'));?>
            </div>

            <?php echo $this->Form->end() ?>

		</div><!-- end col md 9 -->

	</div>
</div>

