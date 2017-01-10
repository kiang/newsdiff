<?php
if (!isset($url)) {
    $url = array();
}
?>
<div id="TagsAdminIndex">
    <h2>標籤</h2>
    <div class="btn-group">
        <?php echo $this->Html->link('新增', array('action' => 'add'), array('class' => 'btn btn-default dialogControl')); ?>
        <?php echo $this->Paginator->sort('Tag.count', '數量排序', array('url' => $url), array('class' => 'btn btn-default')); ?>
        <?php echo $this->Paginator->sort('Tag.created', '時間排序', array('url' => $url), array('class' => 'btn btn-default')); ?>
    </div>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <?php
    $i = 0;
    foreach ($items as $item) {
        ?><div class="btn-group"><?php
        echo $this->Html->link("{$item['Tag']['name']} ({$item['Tag']['count']})", '/admin/news_infos/tag/' . $item['Tag']['id'], array('class' => 'btn btn-default'));
        echo $this->Html->link('[x]', array('action' => 'delete', $item['Tag']['id']), array('class' => 'btn btn-danger'), '確定要刪除？');
        ?></div> &nbsp; | &nbsp; <?php
    }
    ?>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <div id="TagsAdminIndexPanel"></div>
</div>