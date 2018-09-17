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

defined('MOODLE_INTERNAL') || die();

function xmldb_tool_alpha_mail_upgrade($oldversion) {
    global $CFG, $DB;

    if ($oldversion < 2018091200) {
        $table = new xmldb_table('tool_alpha_mail_messages');

        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null);
        $table->add_field('userid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null);
        $table->add_field('created', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null);
        $table->add_field('body', XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL, null, null, null);
        $table->add_field('read', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, 0, null);

        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);

        if(!$DB->get_manager()->table_exists($table)) {
            $DB->get_manager()->create_table($table);
        }

        upgrade_plugin_savepoint(true, 2018091200, 'tool', 'alpha_mail');
    }

    return true;
}
