<div class="tags form">
    <?php echo $this->Form->create('Tag'); ?>
    <fieldset>
        <?php
        echo $this->Form->input('name');
        ?>
    </fieldset>
    <?php echo $this->Form->end('建立'); ?>
</div>