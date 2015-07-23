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
 * Behat message-related steps definitions.
 *
 * @package    core_message
 * @category   test
 * @copyright  2013 David Monllaó
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// NOTE: no MOODLE_INTERNAL test here, this file may be required by behat before including /config.php.

require_once(__DIR__ . '/../../../lib/behat/behat_base.php');

use Behat\Behat\Context\Step\Given as Given,
    Behat\Mink\Exception\ElementNotFoundException as ElementNotFoundException;

/**
 * Messaging system steps definitions.
 *
 * @package    core_message
 * @category   test
 * @copyright  2013 David Monllaó
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class behat_message extends behat_base {

    /**
     * Sends a message to the specified user from the logged user.
     *
     * @Given /^I send "(?P<message_contents_string>(?:[^"]|\\")*)" message to "(?P<username_string>(?:[^"]|\\")*)"$/
     * @throws ElementNotFoundException
     * @param string $messagecontent
     * @param string $tousername
     */
    public function i_send_message_to_user($messagecontent, $tousername) {

        global $DB;

        // Runs by CLI, same PHP process that created the user.
        $touser = $DB->get_record('user', array('username' => $tousername));
        if (!$touser) {
            throw new ElementNotFoundException($this->getSession(), '"' . $tousername . '" ');
        }
        $tofullname = fullname($touser);

        $steps = array();
        $steps[] = new Given('I am on homepage');

        if ($this->running_javascript()) {
            $steps[] = new Given('I expand "' . get_string('myprofile') . '" node');
        }

        $steps[] = new Given('I follow "' . get_string('messages', 'message') . '"');
        $steps[] = new Given('I fill in "' . get_string('searchcombined', 'message') . '" with "' . $this->escape($tofullname) . '"');
        $steps[] = new Given('I press "' . get_string('searchcombined', 'message') . '"');
        $steps[] = new Given('I follow "' . $this->escape(get_string('sendmessageto', 'message', $tofullname)) . '"');
        $steps[] = new Given('I fill in "id_message" with "' . $this->escape($messagecontent) . '"');
        $steps[] = new Given('I press "' . get_string('sendmessage', 'message') . '"');

        return $steps;
    }

}
