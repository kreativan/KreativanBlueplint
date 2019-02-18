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


/* =========================================================== 
    Selector
=========================================================== */

$tmpl = "my-template";

// selector
$selector	= "template=$tmpl, include=all, sort=sort, status!=trash";

// items
$items 		= $this->pages->find($selector);

// trashed items
$trashed    = $this->pages->find("template=$tmpl, status=trash");


/* =========================================================== 
    Admin UI
=========================================================== */
?>

<?php
    include("./inc/tabs.php");
?>

<div class="ivm-white ivm-border ivm-box-shadow">

    <?php 
        if($page_name == "main") {
            include("./inc/table-sortable.php"); 
        } elseif($page_name == "trash") {
            include("./inc/table-trash.php"); 
        }
    ?>

</div>

<!-- Pagination -->
<div class="uk-margin-top" style="margin-left:10px;">
    <?php echo $items->renderPager(); ?>
</div>