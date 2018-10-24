<?php

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/externallib.php');

class tool_alpha_mail_external extends external_api {

    protected static function clear_messages_parameters() {
        return new external_function_parameters([]);
    }

    public function clear_messages() {
        global $DB, $USER;
        $DB->execute("UPDATE {tool_alpha_mail_messages} set read = 1 WHERE userid=:userid", ['userid' => $USER->id]);
    }

    protected static function clear_messages_returns() {
        return null;
    }

}