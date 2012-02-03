<!--

Copyright (C) 2010  Leandro Vázquez Cervantes (leandro[-at-]leandro[-dot-]org)
Copyright (C) 2010  Octavio Benedí Sánchez (octaviobenedi[-at-]gmail[-dot-]com)
Copyright (C) 2010  Verónica Pazos (verocorella[-at-]gmail[-dot-]com)

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

-->

<?php
require "inc/functions.inc.php";
require "inc/Mustache.php";

check_lang();

$m = new Mustache();

$obj = new stdClass();
$obj->TITLE   = TITLE;
$obj->BLOG    = BLOG;
$obj->VERSION = VERSION;
$obj->VERSION_LINK   = VERSION_LINK;
$obj->OTHER_TOOLS_LINK = OTHER_TOOLS_LINK;

$obj->BTN_ADD_TASK = BTN_ADD_TASK;
$obj->BTN_ADD_COL  = BTN_ADD_COL;
$obj->BTN_DEL_COL  = BTN_DEL_COL;


$obj->COLUMN_1    = COLUMN_1;
$obj->COLUMN_2    = COLUMN_2;
$obj->COLUMN_3    = COLUMN_3;
$obj->COLUMN_NAME = COLUMN_NAME;
$obj->COLUMN_WIP  = COLUMN_WIP;
$obj->UNLIMITED   = UNLIMITED;

$obj->WHAT_IS_TEXT= WHAT_IS_TEXT;
$obj->BUTTON_TEXT = BUTTON_TEXT;

$obj->JOIN    = JOIN;
$obj->COPY    = COPY;

$template = file_get_contents('html/index.html');
echo $m->render($template, $obj);
