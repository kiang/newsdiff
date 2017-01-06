<?php

App::uses('AppModel', 'Model');

class NewsInfo extends AppModel {

    public $name = 'NewsInfo';
    public $useTable = 'news_info';
    public $belongsTo = array(
        'News' => array(
            'className' => 'News',
            'foreignKey' => 'news_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
    );

}
