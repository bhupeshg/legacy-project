<div class="col-md-3">
    <div class="actions">
        <div class="panel panel-default">
            <div class="panel-heading">Actions</div>
            <div class="panel-body">
                <ul class="nav nav-pills nav-stacked">
                    <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;Manage Profile'), array('action' => 'update_profile', 'admin' => false), array('escape' => false)); ?> </li>
                    <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;Change Password'), array('action' => 'change_password', 'admin' => false), array('escape' => false)); ?> </li>
                    <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;Logout'), array('action' => 'logout', 'admin' => false), array('escape' => false)); ?> </li>
                </ul>
            </div>
            <!-- end body -->
        </div>
        <!-- end panel -->
    </div>
    <!-- end actions -->
</div>