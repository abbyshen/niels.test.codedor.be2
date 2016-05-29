<!-- File: /app/View/Newsitems/edit.ctp -->

<h1>Edit Newsitem</h1>
<?php
echo $this->Form->create('Newsitem');
echo $this->Form->input('title');
echo $this->Form->input('body', array('rows' => '3'));
echo $this->Form->input('publish_date', array(
    'label' => 'publish date',
    'dateFormat' => 'DMY',
    'value' => date('DMY')
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