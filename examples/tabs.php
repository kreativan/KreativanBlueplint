<?php
/**
 *  Tabs Admin UI
 *
 *  @author Ivan Milincic <kreativan@outlook.com>
 *  @copyright 2018 Kreativan
 * 
 *  @var page_name   string, defined on main file include in @method includeAdminFile() 
 *
*/

// TABS
$tabs_arr = [
    "main-menu" => [
        "title" => "Main Menu",
        "icon" => "",
        "url" => $page->url,
    ],
];

// new item parent_id
$parent_id = $this->pages->get("template=main-menu");

?>


<div class="ivm-tabs uk-tab uk-position-relative">

    <?php foreach($tabs_arr as $key => $value) :?>
        <li class="<?= ($page_name == $key) ? "uk-active" : ""; ?>">
            <a href="<?= $value["url"]?>">
                <?= $value["title"] ?>
            </a>
        </li>
    <?php endforeach;?> 

    <?php if($page_name == "main-menu") :?>
        <li>
            <a href="<?= $this_module->newPageLink($parent_id) ?>">
                <i class="fa fa-plus-circle"></i>
                Add New
            </a>
        </li>
    <?php endif;?>

    <li>
        <a href="<?= $module_edit_URL ?>">
            <i class="fa fa-cog"></i>
            Settings
        </a>
    </li>

</div>