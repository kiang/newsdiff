<?php
if (!isset($url)) {
    $url = array();
}
?>
<div id="NewsInfosAdminIndex">
    <h2><?php echo __('news', true); ?></h2>
    <div class="btn-group">
        <?php echo $this->Html->link(__('Add', true), array('action' => 'add'), array('class' => 'btn btn-default dialogControl')); ?>
    </div>
    <div><?php
        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?></div>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <table class="table table-bordered" id="NewsInfosAdminIndexTable">
        <thead>
            <tr>

                <th><?php echo $this->Paginator->sort('NewsInfo.news_id', 'news', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('NewsInfo.time', 'time', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('NewsInfo.title', 'title', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('NewsInfo.body', 'body', array('url' => $url)); ?></th>
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
                        echo $item['NewsInfo']['news_id'];
                        ?></td>
                    <td><?php
                        echo $item['NewsInfo']['time'];
                        ?></td>
                    <td><?php
                        echo $item['NewsInfo']['title'];
                        ?></td>
                    <td><?php
                        echo $item['NewsInfo']['body'];
                        ?></td>
                    <td>
                        <div class="btn-group">
                            <?php echo $this->Html->link(__('View', true), array('action' => 'view', $item['NewsInfo']['id']), array('class' => 'btn btn-default dialogControl')); ?>
                            <?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $item['NewsInfo']['id']), array('class' => 'btn btn-default dialogControl')); ?>
                            <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $item['NewsInfo']['id']), array('class' => 'btn btn-default'), __('Delete the item, sure?', true)); ?>
                        </div>
                    </td>
                </tr>
            <?php } // End of foreach ($items as $item) {  ?>
        </tbody>
    </table>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <div id="NewsInfosAdminIndexPanel"></div>
    <script type="text/javascript">
        //<![CDATA[
        $(function () {
        });
        //]]>
    </script>
</div>