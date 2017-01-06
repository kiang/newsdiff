<?php

App::uses('Controller', 'Controller');

class AppController extends Controller {

    public $helpers = array('Html', 'Form', 'Js', 'Session');
    public $components = array(
        'Acl',
        'Auth' => array(
            'authorize' => array(
                'Actions' => array(
                    'userModel' => 'Member',
                )
            ),
            'unauthorizedRedirect' => false,
            'loginAction' => '/members/login',
            'loginRedirect' => '/',
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'Member',
                    'scope' => array('Member.user_status' => 'Y'),
                )
            ),
        ),
        'RequestHandler',
        'Session');

}
