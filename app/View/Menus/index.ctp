<!-- File: /app/View/Posts/index.ctp -->

<h1>menuitems</h1>
<p><?php echo $this->Html->link('Add Menuitem', array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>parent</th>
        <th>Actions</th>
        <th>Created</th>
    </tr>

<!-- Here's where we loop through our $posts array, printing out post info -->

    <?php foreach ($menus as $menu): ?>
    <tr>
        <td><?php echo $menu['Menu']['id']; ?></td>
        <td><?php echo $menu['Menu']['title']; ?></td>
        <td><?php echo $menu['Menu']['parent']; ?></td>
        <td>
            <?php
                echo $this->Form->postLink(
                    'Delete',
                    array('action' => 'delete', $menu['Menu']['id']),
                    array('confirm' => 'Are you sure?')
                );
            ?>
            <?php
                echo $this->Html->link(
                    'Edit', array('action' => 'edit', $menu['Menu']['id'])
                );
            ?>
        </td>
        <td> <?php echo $menu['Menu']['created']; ?> </td>
    </tr>
    <?php endforeach; ?>

</table>