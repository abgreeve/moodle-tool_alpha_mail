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
 * Alpha code for the mail plugin.
 *
 * @package    tool_alpha_mail
 * @copyright  2018 Cameron Ball <cameron@cameron1729.xyz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

function tool_alpha_mail_render_navbar_output(renderer_base $renderer) {
    global $USER, $DB;

    if (!isloggedin()) {
        return '';
    }

    // array_values is needed to reindex the array for the tempalate. Without it the keys have the same ID from the DB.
    $messages = array_values($DB->get_records('tool_alpha_mail_messages', ['userid' => $USER->id]));
    $templatecontext = [
        'messages' => $messages
    ];

    return $renderer->render_from_template('tool_alpha_mail/mail_popover', $templatecontext);
}

function tool_alpha_mail_get_fontawesome_icon_map() {
    return [
        'tool_alpha_mail:i/notifications' => 'fa-info-circle'
    ];
}
