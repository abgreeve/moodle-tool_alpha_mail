<?php
defined('MOODLE_INTERNAL') || die;
$functions = [
    'tool_alpha_mail_clear_messages' => [
        'classname'     => 'tool_alpha_mail_external',
        'methodname'    => 'clear_messages',
        'description'   => 'Clears messages for the user',
        'type'          => 'write',
        'ajax'          => true,
        'loginrequired' => true,
    ]
];