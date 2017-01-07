<?php
if (!isset($url)) {
    $url = array();
}
?>
<div id="TagsAdminIndex">
    <h2>標籤</h2>
    <div class="btn-group">
        <?php echo $this->Html->link(__('Add', true), array('action' => 'add'), array('class' => 'btn btn-default dialogControl')); ?>
    </div>
    <div><?php
        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?></div>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <table class="table table-bordered" id="TagsAdminIndexTable">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('Tag.name', 'Name', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Tag.count', 'Count', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Tag.created', 'Created', array('url' => $url)); ?></th>
                <th class="actions"><?php echo __('Action', true); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($items as $item) {
                $class = null;
                if ($i++ % 2 == 0) {
                    $class = ' class="altrow"';
                }
                ?>
                <tr<?php echo $class; ?>>

                    <td><?php
                        echo $item['Tag']['name'];
                        ?></td>
                    <td><?php
                        echo $item['Tag']['count'];
                        ?></td>
                    <td><?php
                        echo $item['Tag']['created'];
                        ?></td>
            <div class="btn-group">
                <?php echo $this->Html->link(__('View', true), array('action' => 'view', $item['Tag']['id']), array('class' => 'btn btn-default dialogControl')); ?>
                <?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $item['Tag']['id']), array('class' => 'btn btn-default dialogControl')); ?>
                <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $item['Tag']['id']), array('class' => 'btn btn-default'), __('Delete the item, sure?', true)); ?>
            </div>
            </td>
            </tr>
        <?php } // End of foreach ($items as $item) {  ?>
        </tbody>
    </table>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <div id="TagsAdminIndexPanel"></div>
</div>