<?php

class Menu extends Model {
    public $validate = array(
        'title' => array(
            'rule' => 'notBlank'),
        'link'  => array(
            'rule' => 'notBlank')
    );
}