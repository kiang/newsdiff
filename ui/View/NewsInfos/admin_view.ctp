<div id="NewsInfosAdminView">
    <h3><?php echo __('View news', true); ?></h3><hr />
    <div class="col-md-12">

        <div class="col-md-2">news</div>
        <div class="col-md-9">&nbsp;<?php
            if ($this->data['NewsInfo']['news_id']) {

                echo $this->data['NewsInfo']['news_id'];
            }
            ?>&nbsp;
        </div>
        <div class="col-md-2">time</div>
        <div class="col-md-9">&nbsp;<?php
            if ($this->data['NewsInfo']['time']) {

                echo $this->data['NewsInfo']['time'];
            }
            ?>&nbsp;
        </div>
        <div class="col-md-2">title</div>
        <div class="col-md-9">&nbsp;<?php
            if ($this->data['NewsInfo']['title']) {

                echo $this->data['NewsInfo']['title'];
            }
            ?>&nbsp;
        </div>
        <div class="col-md-2">body</div>
        <div class="col-md-9">&nbsp;<?php
            if ($this->data['NewsInfo']['body']) {

                echo $this->data['NewsInfo']['body'];
            }
            ?>&nbsp;
        </div>
    </div>
    <hr />
    <div class="btn-group">
        <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('NewsInfo.id')), array('class' => 'btn btn-default'), __('Delete the item, sure?', true)); ?>
        <?php echo $this->Html->link(__('news List', true), array('action' => 'index'), array('class' => 'btn btn-default')); ?>
    </div>
    <div id="NewsInfosAdminViewPanel"></div>
    <?php
    echo $this->Html->scriptBlock('

');
    ?>
    <script type="text/javascript">
        //<![CDATA[
        $(function () {
            $('a.NewsInfosAdminViewControl').click(function () {
                $('#NewsInfosAdminViewPanel').parent().load(this.href);
                return false;
            });
        });
        //]]>
    </script>
</div>