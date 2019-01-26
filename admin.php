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

// variable that u may want to pass to the includes
$vars = [
    "this_module"       => $this_module,
    "moduleURL"         => $moduleURL,
    "adminURL"          => $adminURL,
    "module_edit_URL"   => $module_edit_URL,
];

/* =========================================================== 
    Selector
=========================================================== */

$template 	= "my-template";

// selector
$selector	= "template=$template, include=all, sort=sort";
$selector	.= ($this->input->get->status) ? ", status={$this->input->get->status}" : ", status!=trash";

// items
$items 		= $this->pages->find($selector);

// trashed items
$trashed    = $this->pages->find("template=$template, status=trash");


/* =========================================================== 
    Admin UI
=========================================================== */
?>

<?php
    include("./inc/tabs.php");
?>

<div class="ivm-white ivm-border ivm-box-shadow">

    <?php 
        if($items->count) {
            include("./inc/table-sortable.php"); 
        } else {
            echo "<div class='uk-padding'><h3>No items to display</h3></div>";
        }
    ?>

</div>