<?php
/**
 *  _uninstall.php
 *
 *  @author Ivan Milincic <kreativan@outlook.com>
 *  @copyright 2019 Kreativan
 *
 *
*/

// get api module
$api = $this->modules->get("KreativanApi");

// define templates and fields
$temps_array = ["TEMPLATE_NAME", "TEMPLATE_NAME_2"];
$fields_arr = ["FIELD_NAME", "FIELD_NAME_2", "FIELD_NAME_3"];

// delete
$api->deleteTemplateStructure($temps_array, $fields_arr);