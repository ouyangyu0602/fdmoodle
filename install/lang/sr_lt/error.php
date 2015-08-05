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

$string['cannotcreatedboninstall'] = '<p>Nije moguće kreirati bazu podataka.</p> <p>Navedena baza ne postoji, a dati korisnik nema ovlašćenja da kreira bazu podataka.</p> <p>Administrator sajta treba da proveri konfiguraciju baze podataka.</p>';
$string['cannotcreatelangdir'] = 'Nije moguće kreirati direktorijum jezika';
$string['cannotcreatetempdir'] = 'Nije moguće kreirati privremeni direktorijum';
$string['cannotdownloadcomponents'] = 'Nije moguće preuzeti komponente.';
$string['cannotdownloadzipfile'] = 'Nije moguće preuzeti arhivu';
$string['cannotfindcomponent'] = 'Nije moguće pronaći komponentu.';
$string['cannotsavemd5file'] = 'Nije moguće sačuvati md5 datoteku.';
$string['cannotsavezipfile'] = 'Nije moguće sačuvti ZIP arhivu.';
$string['cannotunzipfile'] = 'Nije moguće raspakovati ZIP datoteku.';
$string['componentisuptodate'] = 'Komponenta je dostupna u svojoj najnovijoj verziji';
$string['dmlexceptiononinstall'] = '<p>Došlo je do greške u bazi podataka [{$a->errorcode}].<br />{$a->debuginfo}</p>';
$string['downloadedfilecheckfailed'] = 'Nije uspela provera preuzete datoteke';
$string['invalidmd5'] = 'Neispravna md5 datoteka';
$string['missingrequiredfield'] = 'Nedostaje neko obavezno polje';
$string['remotedownloaderror'] = 'Preuzimanje komponente na Vaš server nije uspelo. Proverite podešavanja proksi serevera. PHP cURL ekstenzija se preporučuje.<br /><br />Morate da preuzmete <a href="{$a->url}">{$a->url}</a> datoteku ručno, kopirate je u direktorijum "{$a->dest}" na svom sereveru tamo je raspakujete.';
$string['wrongdestpath'] = 'Pogrešna odredišna putanja';
$string['wrongsourcebase'] = 'Pogrešna baza izvornog URL-a';
$string['wrongzipfilename'] = 'Pogrešan naziv arhive';
