<div id="NewsInfosAdminReport">
    <div class="col-lg-12">
        <div class="input-group pull-left col-lg-6">
            <input type="text" class="form-control date-field" value="<?php echo $dateBegin; ?>" placeholder="開始日期" id="dateBegin" />
            <span class="input-group-addon btn btn-primary"> - </span>
            <input type="text" class="form-control date-field" value="<?php echo $dateEnd; ?>" placeholder="結束日期" id="dateEnd" />
            <a class="input-group-addon btn btn-primary btn-search" href="#">送出</a>
        </div>
        <div class="col-lg-6"></div>
    </div>
    <div class="col-lg-12"><?php
        if (!empty($items)) {
            foreach ($tagMap AS $tag) {
                ?><h3><?php echo $tags[$tag['tag_id']]; ?></h3><table class="table table-boarded"><?php
                    ksort($tag['news']);
                    foreach ($tag['news'] AS $newsId) {
                        ?><tr>
                            <td><?php echo $this->Html->link($titles[$newsId], $items[$newsId]['News']['url'], array('target' => '_blank')); ?></td>
                            <td><?php echo $this->Olc->sources[$items[$newsId]['News']['source']]; ?></td>
                            <td><?php echo date('Y-m-d H:i:s', $items[$newsId]['News']['created_at']); ?></td>
                        </tr><?php
                    }
                    ?></table><?php
            }
        }
        ?></div>
</div>
<script>
    var currentBase = '<?php echo $this->Html->url(array('action' => 'report', $isPrint)); ?>';
    $(function () {
        $('input.date-field').datepicker({
            dateFormat: 'yy-mm-dd'
        });
        $('a.btn-search').click(function () {
            var dateBegin = $('input#dateBegin').val();
            var dateEnd = $('input#dateEnd').val();
            if (dateEnd && dateBegin) {
                location.href = currentBase + '?dateBegin=' + dateBegin + '&dateEnd=' + dateEnd;
            }
            return false;
        });
    })
</script>
