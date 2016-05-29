<?php

class Newsitem extends Model {
    public $validate = array(
        'title' => array(
            'rule' => 'notBlank'
        ),
        'body' => array(
            'rule' => 'notBlank'
        ),
        'publish_date' => array(
            'rule' => 'notblank'
        ),
        'embargo_date' => array(
            'rule' => 'notblank'
        )
    );
    
    public function isOwnedBy($post, $user) {
        return $this->field('id', array('id' => $post, 'user_id' => $user)) !== false;
    }
}