<div class="tags view">
    <h2><?php echo __('Tag'); ?></h2>
    <dl>
        <dt><?php echo __('Id'); ?></dt>
        <dd>
            <?php echo h($tag['Tag']['id']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Name'); ?></dt>
        <dd>
            <?php echo h($tag['Tag']['name']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Count'); ?></dt>
        <dd>
            <?php echo h($tag['Tag']['count']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Created'); ?></dt>
        <dd>
            <?php echo h($tag['Tag']['created']); ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Edit Tag'), array('action' => 'edit', $tag['Tag']['id'])); ?> </li>
        <li><?php echo $this->Form->postLink(__('Delete Tag'), array('action' => 'delete', $tag['Tag']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $tag['Tag']['id']))); ?> </li>
        <li><?php echo $this->Html->link(__('List Tags'), array('action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Tag'), array('action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List News'), array('controller' => 'news', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New News'), array('controller' => 'news', 'action' => 'add')); ?> </li>
    </ul>
</div>
<div class="related">
    <h3><?php echo __('Related News'); ?></h3>
    <?php if (!empty($tag['News'])): ?>
        <table cellpadding = "0" cellspacing = "0">
            <tr>
                <th><?php echo __('Id'); ?></th>
                <th><?php echo __('Url'); ?></th>
                <th><?php echo __('Normalized Id'); ?></th>
                <th><?php echo __('Normalized Crc32'); ?></th>
                <th><?php echo __('Source'); ?></th>
                <th><?php echo __('Created At'); ?></th>
                <th><?php echo __('Last Fetch At'); ?></th>
                <th><?php echo __('Last Changed At'); ?></th>
                <th><?php echo __('Error Count'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
            <?php foreach ($tag['News'] as $news): ?>
                <tr>
                    <td><?php echo $news['id']; ?></td>
                    <td><?php echo $news['url']; ?></td>
                    <td><?php echo $news['normalized_id']; ?></td>
                    <td><?php echo $news['normalized_crc32']; ?></td>
                    <td><?php echo $news['source']; ?></td>
                    <td><?php echo $news['created_at']; ?></td>
                    <td><?php echo $news['last_fetch_at']; ?></td>
                    <td><?php echo $news['last_changed_at']; ?></td>
                    <td><?php echo $news['error_count']; ?></td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View'), array('controller' => 'news', 'action' => 'view', $news['id'])); ?>
                        <?php echo $this->Html->link(__('Edit'), array('controller' => 'news', 'action' => 'edit', $news['id'])); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'news', 'action' => 'delete', $news['id']), array('confirm' => __('Are you sure you want to delete # %s?', $news['id']))); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('New News'), array('controller' => 'news', 'action' => 'add')); ?> </li>
        </ul>
    </div>
</div>
