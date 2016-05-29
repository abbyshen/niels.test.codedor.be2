<!-- File: /app/View/Elements/menu.ctp -->
<?php
  $menus = $this->requestAction(
    'menus/index/sort:created/direction:asc'
  );
?>

<?php foreach ($menus as $menu): 
    if($menu['Menu']['parent'] === NULL){ 
      $id = $menu['Menu']['id'];
      $parent = $menu['Menu']['title'];?>
      <ul><?php echo $this->Html->link($menu['Menu']['title'], array('controller' => $parent,'action' => $menu['Menu']['type'])); 
          foreach ($menus as $menu): 
              if($menu['Menu']['parent']===$id){ ?>
                  <li><?php echo $this->Html->link($menu['Menu']['title'], array('controller' => $parent,'action' => $menu['Menu']['type'])); ?></li><?php
              }
          endforeach; ?>  
      </ul>
    <?php
    }
endforeach; ?>
