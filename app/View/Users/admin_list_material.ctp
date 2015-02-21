<a class="add-folder" href="javascript:void(0);">Add Folder</a>
<a class="add-image" href="javascript:void(0);">Add Images</a>
<div class="col-md-9">
    <table cellpadding="0" cellspacing="0" class="table table-striped">
        <thead>
        <tr>
            <th>Folder Name</th>
            <th>Created</th>
            <th class="actions">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($folders as $folder): ?>
            <tr>
                <td><?php echo h($folder['Folder']['name']); ?>&nbsp;</td>
                <td><?php echo h($folder['Folder']['created']); ?>&nbsp;</td>
                <td class="actions">
                	<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', 'javascript:void(0)', array('escape' => false, 'data-edit-id' => $folder['Folder']['id'], 'data-edit-name' => $folder['Folder']['name'], 'class' => 'add-folder'))?>&nbsp;
                    <?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete_folder', $folder['Folder']['user_id'], $folder['Folder']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $folder['Folder']['id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <table cellpadding="0" cellspacing="0" class="table table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Created</th>
                <th class="actions">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($images as $image): ?>
                <tr>
                    <td><?php echo h($image['Gallery']['name']); ?>&nbsp;</td>
                    <td><?php echo h($image['Gallery']['created']); ?>&nbsp;</td>
                    <td class="actions">
                    	<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', 'javascript:void(0)', array('escape' => false, 'data-edit-id' => '', 'data-edit-name' => ''))?>

                    	<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit_image', $image['Gallery']['id'], 'class' => 'add-folder'), array('escape' => false), __('Are you sure you want to delete # %s?', $image['Gallery']['id'])); ?>
                        <?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete_image', $image['Gallery']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $image['Gallery']['id'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
</div> <!-- end col md 9 -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        	<?php echo $this->Form->create('Folder', array('role' => 'form', 'id' => 'save-folder-form', 'class' => 'form-horizontal', 'url' => array('controller'=>'users','action'=>'admin_add_folder'))); ?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Folder</h4>
                </div>
                <div class="modal-body">
                    <section class="panel panel-default text-sm">
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-3">Folder</label>
                                <div class="col-md-5 col-sm-9">
                                    <?php echo $this->Form->input('id', array('type' => 'hidden', 'id' => 'folderId'));?>
                                    <?php echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $user_id));?>
                                    <?php echo $this->Form->input('name', array('class' => 'form-control', 'label' => false, 'placeholder' => 'Folder name', 'id' => 'folderName'));?>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="modal-footer">
                	<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-success', 'div' => false));?>&nbsp;
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            <?php echo $this->Form->end() ?>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    $(".add-folder").click(function(event){
		$("#folderId").val('');
		$("#folderName").val('');

    	var rowId = $(this).attr('data-edit-id');;
        if (typeof rowId !== typeof undefined && rowId !== false)
        {
        	$("#folderId").val(rowId);
            $("#folderName").val($(this).attr('data-edit-name'));
        }

        $('#myModal').modal('show');
    });

    $(".add-image").click(function(event){
		$('#imageModal').modal('show');
	});
});
</script>

<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Images</h4>
			</div>
			<div class="modal-body">
				<?php echo $this->element('Users/file_uploader'); ?>
			</div>
        </div>
    </div>
</div>