<!-- File: /app/View/Newsitem/add.ctp -->

<h1>Add Newsitem</h1>
<?php
echo $this->Form->create('Newsitem');
echo $this->Form->input('title');
echo $this->Form->input('body', array('rows' => '3'));
echo $this->Form->input('publish_date', array(
    'label' => 'publish date',
    'dateFormat' => 'DMY',
    'valueDay' => date('D'),
    'valueMonth' => date('M'),
    'valueYear' => date('Y')
));
echo $this->Form->input('embargo_date', array(
    'label' => 'embargo date',
    'dateFormat' => 'DMY',
    'minDay' => date('D'),
    'minMonth' => date('M'),
    'minYear' => date('Y')
));
echo $this->Form->end('Save Newsitem');
?>