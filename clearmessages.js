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
 * JS for Alpha Mail.
 *
 * @package    tool_alpha_mail
 * @copyright  2018 Cameron Ball <cameron@cameron1729.xyz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

var $ = window.jQuery;
var container = $('#alpha_mail_container');
var trigger = $('.trigger_alpha_mail');
var dismiss = $('#alpha_mail_acknowledge');

container.hide();

trigger.click(function() {
    container.toggle();
});

dismiss.click(function() {
    window.console.log('clicked');
    $.ajax({
        url: M.cfg.wwwroot + "/admin/tool/alpha_mail/ajax.php"
    }).done(function() {
        container.hide();
        trigger.hide();
    });
});
