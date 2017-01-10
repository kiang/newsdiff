<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-TW">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            經濟部工友處新聞室::
            <?php echo $title_for_layout; ?>
        </title><?php
        echo $this->Html->meta('icon');
        echo $this->Html->css('jquery-ui');
        echo $this->Html->css('bootstrap');
        echo $this->Html->css('default');
        echo $this->Html->script('jquery');
        echo $this->Html->script('jquery-ui');
        echo $this->Html->script('bootstrap.min');
        echo $this->Html->script('olc');
        echo $scripts_for_layout;
        ?>
    </head>
    <body>
        <div class="container">
            <div id="viewContent"><?php echo $content_for_layout; ?></div>
        </div>
    </body>
</html>
