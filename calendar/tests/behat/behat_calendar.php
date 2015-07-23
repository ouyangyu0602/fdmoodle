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
 * Behat calendar-related steps definitions.
 *
 * @package    core_calendar
 * @category   test
 * @copyright  2013 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// NOTE: no MOODLE_INTERNAL used, this file may be required by behat before including /config.php.
require_once(__DIR__ . '/../../../lib/behat/behat_base.php');

use Behat\Behat\Context\Step\Given as Given;
use Behat\Gherkin\Node\TableNode as TableNode;

/**
 * Contains functions used by behat to test functionality.
 *
 * @package    core_calendar
 * @category   test
 * @copyright  2013 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class behat_calendar extends behat_base {

    /**
     * Create event.
     *
     * @Given /^I create a calendar event with form data:$/
     * @param TableNode $data
     * @return array the list of actions to perform
     */
    public function i_create_a_calendar_event_with_form_data($data) {
        // Get the event name.
        $eventname = $data->getRow(1);
        $eventname = $eventname[1];

        return array(
            new Given('I follow "' . get_string('monththis', 'calendar') . '"'),
            new Given('I click on "' . get_string('newevent', 'calendar') .'" "button"'),
            new Given('I fill the moodle form with:', $data),
            new Given('I press "' . get_string('savechanges') . '"'),
            new Given('I should see "' . $eventname . '"')
        );
    }
}