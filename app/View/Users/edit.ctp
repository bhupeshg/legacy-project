<div class="users form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Edit User'); ?></h1>
			</div>
		</div>
	</div>



	<div class="row">
		<div class="col-md-3">
			<div class="actions">
				<div class="panel panel-default">
					<div class="panel-heading">Actions</div>
						<div class="panel-body">
							<ul class="nav nav-pills nav-stacked">

																<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete'), array('action' => 'delete', $this->Form->value('User.id')), array('escape' => false), __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?></li>
																<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Users'), array('action' => 'index'), array('escape' => false)); ?></li>
														</ul>
						</div>
					</div>
				</div>			
		</div><!-- end col md 3 -->
		<div class="col-md-9">
			<?php echo $this->Form->create('User', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('username', array('class' => 'form-control', 'placeholder' => 'Username'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('password', array('class' => 'form-control', 'placeholder' => 'Password'));?>
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
					<?php echo $this->Form->input('profile_pic', array('class' => 'form-control', 'placeholder' => 'Profile Pic'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('status', array('class' => 'form-control', 'placeholder' => 'Status'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('legacy_status', array('class' => 'form-control', 'placeholder' => 'Legacy Status'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('memoir', array('class' => 'form-control', 'placeholder' => 'Memoir'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('description', array('class' => 'form-control', 'placeholder' => 'Description'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
