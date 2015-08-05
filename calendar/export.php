<?php

/////////////////////////////////////////////////////////////////////////////
//                                                                         //
// NOTICE OF COPYRIGHT                                                     //
//                                                                         //
// Moodle - Calendar extension                                             //
//                                                                         //
// Copyright (C) 2003-2004  Greek School Network            www.sch.gr     //
//                                                                         //
// Designed by:                                                            //
//     Avgoustos Tsinakos (tsinakos@teikav.edu.gr)                         //
//     Jon Papaioannou (pj@moodle.org)                                     //
//                                                                         //
// Programming and development:                                            //
//     Jon Papaioannou (pj@moodle.org)                                     //
//                                                                         //
// For bugs, suggestions, etc contact:                                     //
//     Jon Papaioannou (pj@moodle.org)                                     //
//                                                                         //
// The current module was developed at the University of Macedonia         //
// (www.uom.gr) under the funding of the Greek School Network (www.sch.gr) //
// The aim of this project is to provide additional and improved           //
// functionality to the Asynchronous Distance Education service that the   //
// Greek School Network deploys.                                           //
//                                                                         //
// This program is free software; you can redistribute it and/or modify    //
// it under the terms of the GNU General Public License as published by    //
// the Free Software Foundation; either version 2 of the License, or       //
// (at your option) any later version.                                     //
//                                                                         //
// This program is distributed in the hope that it will be useful,         //
// but WITHOUT ANY WARRANTY; without even the implied warranty of          //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the           //
// GNU General Public License for more details:                            //
//                                                                         //
//          http://www.gnu.org/copyleft/gpl.html                           //
//                                                                         //
/////////////////////////////////////////////////////////////////////////////

/**
 * This file is part of the User section Moodle
 *
 * @copyright 2003-2004 Jon Papaioannou (pj@moodle.org)
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v2 or later
 * @package calendar
 */

require_once('../config.php');
require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot.'/calendar/lib.php');

if (empty($CFG->enablecalendarexport)) {
    die('no export');
}

$courseid = optional_param('course', SITEID, PARAM_INT);
$action = optional_param('action', '', PARAM_ALPHA);
$day = optional_param('cal_d', 0, PARAM_INT);
$mon = optional_param('cal_m', 0, PARAM_INT);
$year = optional_param('cal_y', 0, PARAM_INT);
$time = optional_param('time', 0, PARAM_INT);
$generateurl = optional_param('generateurl', 0, PARAM_BOOL);

// Get the calendar type we are using.
$calendartype = \core_calendar\type_factory::get_calendar_instance();

// If a day, month and year were passed then convert it to a timestamp. If these were passed
// then we can assume the day, month and year are passed as Gregorian, as no where in core
// should we be passing these values rather than the time. This is done for BC.
if (!empty($day) && !empty($mon) && !empty($year)) {
    if (checkdate($mon, $day, $year)) {
        $time = make_timestamp($year, $mon, $day);
    } else {
        $time = time();
    }
} else if (empty($time)) {
    $time = time();
}

if ($courseid != SITEID && !empty($courseid)) {
    $course = $DB->get_record('course', array('id' => $courseid));
    $courses = array($course->id => $course);
    $issite = false;
} else {
    $course = get_site();
    $courses = calendar_get_default_courses();
    $issite = true;
}
require_course_login($course);

$url = new moodle_url('/calendar/export.php', array('time' => $time));

if ($action !== '') {
    $url->param('action', $action);
}

if ($course !== NULL) {
    $url->param('course', $course->id);
}
$PAGE->set_url($url);

$calendar = new calendar_information(0, 0, 0, $time);
$calendar->prepare_for_view($course, $courses);

$pagetitle = get_string('export', 'calendar');
$now = $calendartype->timestamp_to_date_array($time);

// Print title and header
if ($issite) {
    $PAGE->navbar->add($course->shortname, new moodle_url('/course/view.php', array('id'=>$course->id)));
}
$link = new moodle_url(CALENDAR_URL.'view.php', array('view'=>'upcoming', 'course'=>$calendar->courseid));
$PAGE->navbar->add(get_string('calendar', 'calendar'), calendar_get_link_href($link, 0, 0, 0, $time));
$PAGE->navbar->add($pagetitle);

$PAGE->set_title($course->shortname.': '.get_string('calendar', 'calendar').': '.$pagetitle);
$PAGE->set_heading($course->fullname);
$PAGE->set_pagelayout('standard');
$PAGE->set_button(calendar_preferences_button($course));

$renderer = $PAGE->get_renderer('core_calendar');
$calendar->add_sidecalendar_blocks($renderer);

echo $OUTPUT->header();
echo $renderer->start_layout();
switch($action) {
    case 'advanced':
        // Why nothing?
        break;
    case '':
    default:
        $weekend = CALENDAR_DEFAULT_WEEKEND;
        if (isset($CFG->calendar_weekend)) {
            $weekend = intval($CFG->calendar_weekend);
        }

        // Get the number of days.
        $numberofdaysinweek = $calendartype->get_num_weekdays();

        $authtoken = sha1($USER->id . $DB->get_field('user', 'password', array('id'=>$USER->id)). $CFG->calendar_exportsalt);
        // Let's populate some vars to let "common tasks" be somewhat smart...
        // If today it's weekend, give the "next week" option.
        $allownextweek = $weekend & (1 << $now['wday']);
        // If it's the last week of the month, give the "next month" option.
        $allownextmonth = calendar_days_in_month($now['mon'], $now['year']) - $now['mday'] < $numberofdaysinweek;
        // If today it's weekend but tomorrow it isn't, do NOT give the "this week" option.
        $allowthisweek = !(($weekend & (1 << $now['wday'])) && !($weekend & (1 << (($now['wday'] + 1) % $numberofdaysinweek))));
        echo $renderer->basic_export_form($allowthisweek, $allownextweek, $allownextmonth, $USER->id, $authtoken);
        break;
}

if (!empty($generateurl)) {
    $params['userid']      = optional_param('userid', 0, PARAM_INT);
    $params['authtoken']   = optional_param('authtoken', '', PARAM_ALPHANUM);
    $params['preset_what'] = optional_param('preset_what', 'all', PARAM_ALPHA);
    $params['preset_time'] = optional_param('preset_time', 'weeknow', PARAM_ALPHA);

    $link = new moodle_url('/calendar/export_execute.php', $params);
    print html_writer::tag('div', get_string('calendarurl', 'calendar', $link->out()), array('class' => 'generalbox calendarurl'));
}

echo $renderer->complete_layout();
echo $OUTPUT->footer();
