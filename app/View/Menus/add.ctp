<!-- File: /app/View/Menus/add.ctp -->

<h1>Add Menu</h1>
<?php
$list = array(null=>'geen');
foreach ($Cats as $cat){
    if($cat['Menu']['parent']=== null){
        $parentid = $cat['Menu']['id'];
        $parenttitle = $cat['Menu']['title'];
        $list[$parentid] = $parenttitle;
    }
};
echo $this->Form->create('Menu');
echo $this->Form->input('title');
echo $this->Form->input('parent', array('options' => array($list)));
echo $this->Form->input('type', array(
            'options' => array('index' => 'Index', 'add' => 'Add')
        ));
echo $this->Form->end(__('Save Menu'));