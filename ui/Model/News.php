<?php

App::uses('AppModel', 'Model');

/**
 * News Model
 *
 * @property NewsInfo $NewsInfo
 * @property NewsRaw $NewsRaw
 */
class News extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'normalized_id';


    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'NewsInfo' => array(
            'className' => 'NewsInfo',
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
        'NewsRaw' => array(
            'className' => 'NewsRaw',
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
        )
    );
    
    public $hasAndBelongsToMany = array(
        'Tag' => array(
            'className' => 'Tag',
            'joinTable' => 'news_tags',
            'foreignKey' => 'news_id',
            'associationForeignKey' => 'tag_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        )
    );

}
