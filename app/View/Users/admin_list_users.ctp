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
                    <?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'depart_user', $user['User']['id']), array('escape' => false), __('Are you sure you want to mark the user as departed # %s?', $user['User']['initiated_name']));
                    if ($user['User']['active'] == 1) {
                        echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'user_status', $user['User']['id'], 0), array('escape' => false), __('Are you sure you want to mark the user as inactive # %s?', $user['User']['initiated_name']));
                    } else {
                        echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'user_status', $user['User']['id']), array('escape' => false), __('Are you sure you want to mark the user as active # %s?', $user['User']['initiated_name'], 1));
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php
    echo $this->element('paging');
    ?>
</div>
<!-- end col md 9 -->