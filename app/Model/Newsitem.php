<?php

class Newsitem extends Model {
    public $validate = array(
        'title' => array(
            'rule' => 'notBlank'
        ),
        'body' => array(
            'rule' => 'notBlank'
        ),
        'file' => array(
            'rule' => array(
                'extension',
                array('gif', 'pdf', 'png', 'jpg'),
                'message' => 'please supply a valid file type( jpg, png, gif, pdf)'
            ),
            'rule2' => array('fileSize', '<=', '15MB'),
            'message' => 'please supply a file smaller then 15MB'
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