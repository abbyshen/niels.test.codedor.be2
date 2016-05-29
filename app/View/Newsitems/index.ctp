<!-- File: /app/View/Posts/index.ctp -->
<table>
    <tr>
        <th>Title</th>
        <th>Published</th>
        <th>Actions</th>
    </tr>

<!-- Here's where we loop through our $posts array, printing out post info -->

    <?php foreach ($newsitems as $news): 
    if($news['Newsitem']['embargo_date'] <= date('Y-m-d')){
        ?>
    <tr>
        <td>
            <?php
                echo $this->Html->link(
                    $news['Newsitem']['title'],
                    array('action' => 'view', $news['Newsitem']['id'])
                );
            ?>
        </td>
        <td><?php echo $news['Newsitem']['publish_date']; ?></td>
        <td>
            <?php
                echo $this->Form->postLink(
                    'Delete',
                    array('action' => 'delete', $news['Newsitem']['id']),
                    array('confirm' => 'Are you sure?')
                );
            ?>
            <?php
                echo $this->Html->link(
                    'Edit', array('action' => 'edit', $news['Newsitem']['id'])
                );
            ?>
        </td>
    </tr>
    <?php }?>
    <?php endforeach; ?>
</table>