<?php
/**
 *  Module Admin UI
 *
 *  @author Ivan Milincic <kreativan@outlook.com>
 *  @copyright 2018 Kreativan
 *
 *  @var this_module
 *	@method $this_module->pageEditLink($id) 
 *	@method $this_module->newPageLink($parent_id) 
 *
*/

$adminURL 		= $this->config->urls->admin;
$moduleURL 		= $this_module->page->url;

$template 	    = "menu-item";
$parent_tmpl    = "main-menu";
$parent_id      = $this->pages->get("template=$parent_tmpl");

// trashed items
$items          = $this->pages->find("template=$template, status=trash");

// tabs
include("./inc/tabs.php");

?>

<div class="ivm-white ivm-border ivm-box-shadow">

    <?php 
        if($items->count) {
            include("./inc/table-trash.php"); 
        } else {
            echo "<div class='uk-padding'><h3>No items to display</h3></div>";
        }
    ?>

</div>