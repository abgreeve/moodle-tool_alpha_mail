<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Alpha Mail external APIs.
 *
 * @package    tool_alpha_mail
 * @copyright  2018 Cameron Ball <cameron@cameron1729.xyz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

use tool_alpha_mail\local\message_repository;

require_once($CFG->libdir . '/externallib.php');

class tool_alpha_mail_external extends external_api {
    /**
     * Get popup messages from the site admin.
     *
     * @return string
     */
    public static function get_popup_messages() {
        global $DB, $USER;

        self::validate_context(context_system::instance());
        return (new message_repository($DB))->get_messages_for_user($USER->id);
    }

    protected static function get_popup_messages_returns() {
        return new external_multiple_structure(
            new external_single_structure(
                [
                    'read' => new external_value(PARAM_BOOL, 'is the message read or not'),
                    'body' => new external_value(PARAM_TEXT, 'the message body')
                ]
            )
        );
    }

    protected static function get_popup_messages_parameters() {
        return new external_function_parameters([]);
    }

    public static function mark_popup_messages_as_read() {
        global $DB, $USER;

        self::validate_context(context_system::instance());
        return (new message_repository($DB))->mark_messages_as_read_for_user($USER->id);
    }

    protected static function mark_popup_messages_as_read_returns() {
        return null;
    }

    protected static function mark_popup_messages_as_read_parameters() {
        return new external_function_parameters([]);
    }
}
