<?php
/**
 *  _uninstall.php
 *
 *  @author Ivan Milincic <kreativan@outlook.com>
 *  @copyright 2018 Kreativan
 *
 *
*/

// get helper module
$helper = $this->modules->get("KreativanHelper");

// define templates and fields
$temps_array = ["TEMPLATE_NAME", "TEMPLATE_NAME_2"];
$fields_arr = ["FIELD_NAME", "FIELD_NAME_2", "FIELD_NAME_3"];

// delete
$helper->deleteTemplateStructure($temps_array, $fields_arr);