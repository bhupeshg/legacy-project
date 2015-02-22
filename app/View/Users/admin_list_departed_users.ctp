<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '.memoir', function () {
            $.ajax({
                url: "get_user_memoir/"+$(this).data('id'),
                success: function (result) {
                    $('#UserMemoir').val(result);
                }
            });
            //get data-id attribute of the clicked element
            $('#UserId').val($(this).data('id'));
        });
    })
</script>
<div class="col-md-9">
    <table cellpadding="0" cellspacing="0" class="table table-striped">
        <thead>
        <tr>
            <th>Email</th>
            <th>Karmi Name</th>
            <th><?php echo $this->Paginator->sort('initiated_name'); ?></th>
            <th>Place of Initiation</th>
            <th>Date of Initiation</th>
            <th>Registration Time</th>
            <th class="actions">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo h($user['User']['username']); ?>&nbsp;</td>
                <td><?php echo h($user['User']['karmi_name']); ?>&nbsp;</td>
                <td><?php echo h($user['User']['initiated_name']); ?>&nbsp;</td>
                <td><?php echo h($user['User']['place_of_initiation']); ?>&nbsp;</td>
                <td><?php echo h($user['User']['date_of_initiation']); ?>&nbsp;</td>
                <td><?php echo h($user['User']['created']); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link('<span class="glyphicon glyphicon-remove"></span>', '#memoirModal', array('escape' => false, 'class' => 'memoir', 'data-toggle' => 'modal', 'data-id' => $user['User']['id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php
    echo $this->element('paging');
    ?>
    <div class="modal fade" id="memoirModal" role="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <?php
                echo $this->Form->create('User', array('role' => 'form', 'action' => 'user_memoir'));
                echo $this->Form->hidden('id');
                ?>
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Write a Memoir</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo $this->Form->input('memoir', array('type' => 'textarea', 'class' => 'form-control', 'placeholder' => 'Reason'));?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-primary', 'div' => false)); ?>
                </div>
                <?php echo $this->Form->end() ?>
            </div>
        </div>
    </div>
</div> <!-- end col md 9 -->