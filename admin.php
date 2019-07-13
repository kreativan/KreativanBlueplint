<?php
/**
 *  Module Admin UI
 *
 *  @author Ivan Milincic <kreativan@outlook.com>
 *  @copyright 2018 Kreativan
 *  @link http://www.kreativan.net
 *
 *  @var Module|object $this_module
 *  @var string $page_name
 *  @var string $module_edit_URL
 *  @var Module|object $helper
 *  
 *  Use helper methods:
 *	$helper->pageEditLink($id)
 *	$helper->newPageLink($parent_id)
 *
*/

$adminURL 		= $this->config->urls->admin;
$moduleURL 		= $this_module->page->url;


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
    <?php echo $this_module->items()->renderPager(); ?>
</div>