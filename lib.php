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
    global $USER, $CFG, $DB, $OUTPUT, $PAGE;

    if (!isloggedin()) {
        return '';
    }

    $PAGE->requires->js(new moodle_url('https://code.jquery.com/jquery-3.3.1.min.js'));
    $PAGE->requires->js(new moodle_url('/admin/tool/alpha_mail/clearmessages.js'));

    $message = $DB->get_record_sql('SELECT * FROM {tool_alpha_mail_messages} WHERE userid=:userid ORDER BY id DESC LIMIT 1', ['userid' => $USER->id]);

    if ($message->read) {
        return '';
    }

    if ($message) {
        $output =
                $OUTPUT->pix_icon('i/info', '', 'moodle', ['class' => 'trigger_alpha_mail']) .
                html_writer::start_tag('div', ['id' => 'alpha_mail_container']) .
                $message->body .
                html_writer::start_tag('div', ['id' => 'alpha_mail_acknowledge']) .
                'Dismiss' .
                html_writer::end_tag('div') .
                html_writer::link(new moodle_url('/admin/tool/alpha_mail/seeall.php'), 'See all') .
                html_writer::end_tag('div');

        return $output;
    }

    return '';
}
