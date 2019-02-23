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
    "main" => [
        "title" => "Modals & Offcanvas",
        "icon" => "cog",
        "url" => $page->url,
    ],
];

// new item parent_id
$parent_id = $this->pages->get("template=main-menu");

// Trash
$trashed_class  = $trashed->count < 1 ? "uk-hidden" : "";
$trashed_class  = ($page_name == "trash") ? " uk-active" : $trashed_class;

?>


<ul class="ivm-tabs uk-tab uk-position-relative">

    <?php foreach($tabs_arr as $key => $value) :?>
        <li class="<?= ($page_name == $key) ? "uk-active" : ""; ?>">
            <a href="<?= $value["url"]?>">
				<?php if(!empty($value["icon"])):?>
                    <i class="fa fa-<?= $value["icon"] ?>"></i>
                <?php endif;?>
                <?= $value["title"] ?>
            </a>
        </li>
    <?php endforeach;?> 

    <li class="ivm-trash-link <?= $trashed_class ?>" data-count="<?= $trashed->count ?>">
        <a class="uk-text-danger" href="./trash/">
            <i class="fa fa-trash"></i>
            Trash <span>(<?= $trashed->count ?>)</span>
        </a>
    </li>

    <li>
        <a href="<?= $this_module->newPageLink($parent_id) ?>">
            <i class="fa fa-plus-circle"></i>
            Add New
        </a>
    </li>
	
	<?php if($this->user->isSuperuser()) :?>
		<li>
			<a href="<?= $module_edit_URL ?>">
				<i class="fa fa-cog"></i>
				Settings
			</a>
		</li>
	<?php endif;?>	
    

</ul>