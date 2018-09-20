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
 * Prints the admin form for alpha mail.
 *
 * @copyright 2018 onwards Adrian Greeve <adriangreeve.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package tool_dataprivacy
 */

require_once(__DIR__ . '/../../../config.php');
require_once($CFG->dirroot . '/' . $CFG->admin . '/tool/alpha_mail/lib.php');

require_login(null, false);

$PAGE->set_context(context_system::instance());

$url = new \moodle_url('/' . $CFG->admin . '/tool/alpha_mail/admin.php');
$PAGE->set_url($url);
$PAGE->set_title('Alpha Mail');
$PAGE->set_heading('Alpha Mail');

$adminform = new \tool_alpha_mail\form\admin();

echo $OUTPUT->header();
echo $adminform->render();
print_object($adminform->get_data());


echo $OUTPUT->footer();
