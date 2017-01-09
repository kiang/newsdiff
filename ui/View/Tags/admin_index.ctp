<?php
if (!isset($url)) {
    $url = array();
}
?>
<div id="TagsAdminIndex">
    <h2>標籤</h2>
    <div class="btn-group">
        <?php echo $this->Html->link('新增', array('action' => 'add'), array('class' => 'btn btn-default dialogControl')); ?>
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
                <th><?php echo $this->Paginator->sort('Tag.name', '標籤', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Tag.count', '數量', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Tag.created', '時間', array('url' => $url)); ?></th>
                <th class="actions">操作</th>
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
                    <td>
                        <div class="btn-group">
                            <?php echo $this->Html->link('刪除', array('action' => 'delete', $item['Tag']['id']), array('class' => 'btn btn-default'), __('Delete the item, sure?', true)); ?>
                        </div>
                    </td>
                </tr>
            <?php } // End of foreach ($items as $item) {  ?>
        </tbody>
    </table>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <div id="TagsAdminIndexPanel"></div>
</div>