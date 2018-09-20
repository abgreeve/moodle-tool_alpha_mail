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
 * Alpha Mail message repository.
 *
 * @package    tool_alpha_mail
 * @copyright  2018 Cameron Ball <cameron@cameron1729.xyz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_alpha_mail\local;
defined('MOODLE_INTERNAL') || die();

use context_user;
use moodle_database;

/**
 * Repository of messages.
 *
 * @copyright 2018 Cameron Ball <cameron@cameron1729.xyz>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class message_repository {
    private $db;

    public function __construct(moodle_database $db) {
        $this->db = $db;
    }

    public function get_messages_for_user(int $userid) {
        if (!has_capability('tool/alpha_mail:viewmessages', context_user::instance($userid))) {
            throw new moodle_exception('nopermissions', 'error', '', 'access site messages');
        }

        return array_values($this->db->get_records('tool_alpha_mail_messages', ['userid' => $userid]));
    }

    public function mark_messages_as_read_for_user(int $userid) {
        if (!has_capability('tool/alpha_mail:viewmessages', context_user::instance($userid))) {
            throw new moodle_exception('nopermissions', 'error', '', 'access site messages');
        }

        $this->db->execute("UPDATE {tool_alpha_mail_messages} SET read=1 WHERE userid=:userid", ['userid' => $userid]);
    }
}
