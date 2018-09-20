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
 * This module retrieves notifications and renders them in an element.
 *
 * @module     tool_alpha_mail/messages_popover_controller
 * @package    tool_alpha_mail
 * @copyright  2018 Cameron Ball <cameron@cameron1729.xyz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define(
    [
        'jquery',
        'core/ajax',
        'core/templates',
        'core/popover_region_controller',
        'core/url',
        'core/custom_interaction_events'
    ],
    function($, Ajax, Templates, PopoverController, URL, CustomEvents) {
        var registerEventListeners = function(root) {
            root.on(CustomEvents.events.activate, '[data-action="mark-all-read"]', function(e) {
                Ajax.call([
                    {
                        methodname: 'tool_alpha_mail_mark_popup_messages_as_read',
                        args: []
                    }
                ])[0].done(function() {
                    root.find('[data-region="count-container"]').addClass('hidden');
                    root.find('.notification.unread').removeClass('unread');
                });
            });
        };

        var AlphaMailPopoverController = function(root) {
            registerEventListeners(root);
            PopoverController.call(this, root);
            this.root = root;
        };

        AlphaMailPopoverController.prototype = Object.create(PopoverController.prototype);
        AlphaMailPopoverController.prototype.constructor = AlphaMailPopoverController;

        AlphaMailPopoverController.prototype.renderMessages = function() {
            return Ajax.call([
                {
                    methodname: 'tool_alpha_mail_get_popup_messages',
                    args: []
                }
            ])[0].then(function(result) {
                this.renderUnreadCount(
                    result.filter(function(message) {
                        return !message.read;
                    }
                ).length);
                return Templates.render(
                    'tool_alpha_mail/mail_popover_list',
                    {messages: result}
                ).done(function(html, js) {
                    Templates.replaceNodeContents(this.root.find('.all-notifications'), html, js);
                }.bind(this));
            }.bind(this));
        };

        AlphaMailPopoverController.prototype.renderUnreadCount = function(count) {
            if (count > 0) {
                this.root.find('[data-region="count-container"]').text(count).removeClass('hidden');
            }
        };

        return AlphaMailPopoverController;
    }
);
