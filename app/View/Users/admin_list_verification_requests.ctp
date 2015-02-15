<div class="col-md-9">
    <table cellpadding="0" cellspacing="0" class="table table-striped">
        <thead>
        <tr>
            <th>Email</th>
            <th>Karmi Name</th>
            <th>Initiated Name</th>
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
                    <?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'verify_user', $user['User']['id']), array('escape' => false), __('Are you sure you want to verify # %s?', $user['User']['initiated_name'])); ?>
                    <?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'reject_user', $user['User']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div> <!-- end col md 9 -->