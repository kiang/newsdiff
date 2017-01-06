<div id="NewsInfosAdminAdd">
    <?php echo $this->Form->create('NewsInfo', array('type' => 'file')); ?>
    <div class="NewsInfos form">
        <fieldset>
            <legend><?php
                echo __('Add news', true);
                ?></legend>
            <?php
            echo $this->Form->input('NewsInfo.news_id', array(
                'label' => 'news',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('NewsInfo.time', array(
                'label' => 'time',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('NewsInfo.title', array(
                'label' => 'title',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('NewsInfo.body', array(
                'label' => 'body',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            ?>
        </fieldset>
    </div>
    <?php
    echo $this->Form->end(__('Submit', true));
    ?>
</div>