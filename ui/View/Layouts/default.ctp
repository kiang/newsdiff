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
            <div id="header">
                <h1><?php echo $this->Html->link('經濟部工友處新聞室', '/'); ?></h1>
            </div>
            <div id="content">
                <div class="btn-group">
                    <?php if ($this->Session->read('Auth.User.id')): ?>
                        <?php echo $this->Html->link('新聞', '/admin/news_infos', array('class' => 'btn btn-default')); ?>
                        <?php echo $this->Html->link('標籤', '/admin/tags', array('class' => 'btn btn-default')); ?>
                        <?php echo $this->Html->link('帳號', '/admin/members', array('class' => 'btn btn-default')); ?>
                        <?php echo $this->Html->link('群組', '/admin/groups', array('class' => 'btn btn-default')); ?>
                        <?php echo $this->Html->link('登出', '/members/logout', array('class' => 'btn btn-default')); ?>
                    <?php else: ?>
                        <?php echo $this->Html->link('登入', '/members/login', array('class' => 'btn btn-default')); ?>
                    <?php endif; ?>
                    <?php
                    if (!empty($actions_for_layout)) {
                        foreach ($actions_for_layout as $title => $url) {
                            echo $this->Html->link($title, $url, array('class' => 'btn'));
                        }
                    }
                    ?>
                </div>

                <?php echo $this->Session->flash(); ?>
                <div id="viewContent"><?php echo $content_for_layout; ?></div>
            </div>
            <div class="clearfix"></div>
            <div id="footer">
                <?php
                echo $this->Html->link(
                        $this->Html->image('cake.power.gif', array(
                            'alt' => __("CakePHP: the rapid development php framework", true), 'border' => "0")
                        ), 'http://www.cakephp.org/', array('target' => '_blank', 'escape' => false)
                );
                ?>
            </div>
        </div>
        <?php
        echo $this->element('sql_dump');
        ?>
        <script type="text/javascript">
            //<![CDATA[
            $(function () {
                $('a.dialogControl').click(function () {
                    dialogFull(this);
                    return false;
                });
            });
            //]]>
        </script>
    </body>
</html>
