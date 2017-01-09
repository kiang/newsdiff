<?php

App::uses('AppModel', 'Model');

/**
 * Tag Model
 *
 * @property News $News
 */
class Tag extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';


    // The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasAndBelongsToMany associations
     *
     * @var array
     */
    public $hasAndBelongsToMany = array(
        'News' => array(
            'className' => 'News',
            'joinTable' => 'news_tags',
            'foreignKey' => 'tag_id',
            'associationForeignKey' => 'news_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        )
    );
    
    public $hasMany = array(
        'NewsTag' => array(
            'className' => 'NewsTag',
            'foreignKey' => 'tag_id',
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
