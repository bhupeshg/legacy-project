<script>
    $(document).ready(function () {
        $(document).on('submit', '#UserChangePasswordForm', function() {
            var new_pwd = $('#UserNewPassword').val();
            var confirm_pwd = $('#UserConfirmPassword').val();
            if (new_pwd !== confirm_pwd) {
                alert('New and Confirm password should match');
                return false;
            }
        })
    })
</script>
<?php
/**
 * @var $this View
 */
?>
<div class="col-md-9">
    <?php echo $this->Form->create('User', array('role' => 'form', 'action' => 'change_password')); ?>
    <div class="form-group">
        <?php echo $this->Form->input('old_password', array('class' => 'form-control', 'placeholder' => 'Old Password', 'type' => 'password', 'required' => true));?>
    </div>
    <div class="form-group">
        <?php echo $this->Form->input('new_password', array('class' => 'form-control', 'placeholder' => 'New Password', 'type' => 'password', 'required' => true));?>
    </div>
    <div class="form-group">
        <?php echo $this->Form->input('confirm_password', array('class' => 'form-control', 'placeholder' => 'Confirm Password', 'type' => 'password', 'required' => true));?>
    </div>
    <div class="form-group">
        <?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
    </div>
    <?php echo $this->Form->end() ?>
</div><!-- end col md 12 -->