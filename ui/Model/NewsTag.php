<?php

App::uses('AppModel', 'Model');

/**
 * NewsTag Model
 *
 * @property News $News
 * @property Tag $Tag
 */
class NewsTag extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'id';


    // The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'News' => array(
            'className' => 'News',
            'foreignKey' => 'news_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Tag' => array(
            'className' => 'Tag',
            'foreignKey' => 'tag_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

}
