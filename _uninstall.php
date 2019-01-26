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
$temps_array = ["menu-item", "main-menu"];
$fields_arr = ["km_dropdown", "km_link_type", "km_page", "km_link", "km_link_attr"];

// delete
$helper->deleteTemplateStructure($temps_array, $fields_arr);