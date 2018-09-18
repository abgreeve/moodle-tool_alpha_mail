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
 * Alpha Mail setting.
 *
 * @package    tool_alpha_mail
 * @copyright  2018 Cameron Ball <cameron@cameron1729.xyz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class alpha_mail_message_setting extends admin_setting_configtextarea {
    public function get_setting() {
        global $DB;
        $latestmessage = $DB->get_record_sql('SELECT body FROM {tool_alpha_mail_messages} ORDER BY id DESC LIMIT 1');

        return $latestmessage->body ?? '';
    }

    public function write_setting($data) {
        global $DB;
        $records = [];
        foreach ($DB->get_records('user') as $user) {
            $records[] = (object)[
                'userid' => $user->id,
                'created' => time(),
                'body' => $data
            ];
        }

        $DB->insert_records('tool_alpha_mail_messages', $records);
        return '';
    }
}