<div id="NewsInfosAdminTag">
    <h2><?php
    echo $this->Html->link('標籤', '/admin/tags/index') . ' > ';
    echo $tag['Tag']['name'];
    ?></h2>
    <div class="clearfix"><br /></div>
    <div class="col-md-12">
        <div class="input-group pull-left col-md-6">
            <input type="text" class="form-control input-search" value="<?php echo $keywords; ?>" placeholder="關鍵字">
            <a class="input-group-addon btn btn-primary btn-search" href="#">搜尋</a>
        </div>
        <div class="paging col-md-6"><div class="pull-right"><?php echo $this->element('paginator'); ?></div></div>
    </div>

    <?php
    $i = 0;
    foreach ($items as $item) {
        if(strlen($item['NewsInfo']['body']) < 20) {
            continue;
        }
        ?>
        <div class="col-md-12">
            <div class="pull-right"><?php echo date('Y-m-d H:i:s', $item['NewsInfo']['time']); ?> / <?php echo $this->Olc->sources[$item['News']['source']]; ?></div>
            <h4><a href="<?php echo $item['News']['url']; ?>" target="_blank"><?php echo $item['NewsInfo']['title']; ?></a></h4>
            <p class="bg-info"><?php echo nl2br(strip_tags($item['NewsInfo']['body'])); ?></p>
        </div>
    <?php } // End of foreach ($items as $item) {  ?>
    <div class="paging pull-right"><?php echo $this->element('paginator'); ?></div>
</div>
<script>
    var currentBase = '<?php echo $this->Html->url(array('action' => 'tag', $tag['Tag']['id'])); ?>';
    $(function () {
        $('a.btn-search').click(function () {
            location.href = currentBase + '?keyword=' + encodeURI($('input.input-search').val());
            return false;
        });
    })
</script>
