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
 * Automatically generated strings for Moodle installer
 *
 * Do not edit this file manually! It contains just a subset of strings
 * needed during the very first steps of installation. This file was
 * generated automatically by export-installer.php (which is part of AMOS
 * {@link http://docs.moodle.org/dev/Languages/AMOS}) using the
 * list of strings defined in /install/stringnames.txt.
 *
 * @package   installer
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['cannotcreatedboninstall'] = '<p>Kan inte skapa databasen.</p>
<p>Den specificerade databasen existerar inte och den givna användaren har inte rättighet att skapa databasen.</p>
<p>Administratören för webbplatsen bör verifiera databaskonfigurationen.</p>';
$string['cannotcreatelangdir'] = 'Det går inte att skapa en lang-katalog';
$string['cannotcreatetempdir'] = 'Det går inte att skapa en temp-katalog';
$string['cannotdownloadcomponents'] = 'Det går inte att ladda ner komponenter';
$string['cannotdownloadzipfile'] = 'Det går inte att ladda ner ZIP-fil.';
$string['cannotfindcomponent'] = 'Det går inte att hitta komponent';
$string['cannotsavemd5file'] = 'Det går inte att spara md5-fil';
$string['cannotsavezipfile'] = 'Det går inte att spara ZIP-fil';
$string['cannotunzipfile'] = 'Det går inte att packa upp fil';
$string['componentisuptodate'] = 'Komponenten är av en aktuell version';
$string['dmlexceptiononinstall'] = '<p>Ett databasfel har inträffat [{$a->errorcode}].<br />{$a->debuginfo}</p>';
$string['downloadedfilecheckfailed'] = 'Det gick inte att kontrollera den nedladdade filen';
$string['invalidmd5'] = 'Kontrollvariabeln var felaktig - försök igen';
$string['missingrequiredfield'] = 'Det saknas några obligatoriska fält';
$string['remotedownloaderror'] = 'Nedladdningen av en komponent till din server misslyckades, var snäll och verifiera inställningar för proxy. <br /><br />Du måste ladda ner <a href="{$a->url}">{$a->url}</a> filen manuellt, kopiera den till "{$a->dest}" på din server och packa upp den där.';
$string['wrongdestpath'] = 'Fel sökväg';
$string['wrongsourcebase'] = 'Fel bas-URL till källan';
$string['wrongzipfilename'] = 'Fel namn på ZIP-filen';
