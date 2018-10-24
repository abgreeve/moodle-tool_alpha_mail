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
 * See all Alpha Mail messages.
 *
 * @package    tool_alpha_mail
 * @copyright  2018 Cameron Ball <cameron@cameron1729.xyz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../../config.php');
defined('MOODLE_INTERNAL') || die();

$PAGE->set_context(context_user::instance($USER->id));
$PAGE->set_url('/admin/tool/alpha_mail/seeall.php');
$messages = $DB->get_records('tool_alpha_mail_messages', ['userid' => $USER->id]);

echo $OUTPUT->header();

echo $OUTPUT->render_from_template('tool_alpha_mail/seeall', ['messages' => array_values($messages)]);

echo $OUTPUT->footer();