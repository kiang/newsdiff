<?php
if (!isset($url)) {
    $url = array();
}
?>
<div id="NewsInfosAdminIndex">
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <?php
    $i = 0;
    foreach ($items as $item) {
        ?>
        <div class="col-md-12">
            <div class="pull-right"><?php echo date('Y-m-d H:i:s', $item['NewsInfo']['time']); ?> / <?php echo $this->Olc->sources[$item['News']['source']]; ?></div>
            <h4><a href="<?php echo $item['News']['url']; ?>" target="_blank"><?php echo $item['NewsInfo']['title']; ?></a></h4>
            <p class="bg-info"><?php echo nl2br(mb_substr(strip_tags($item['NewsInfo']['body']), 0, 350, 'utf-8')); ?>...</p>
        </div><hr />
    <?php } // End of foreach ($items as $item) {  ?>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
</div>