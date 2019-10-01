<?php namespace ProcessWire;
/**
 *  Tabs Admin UI
 *
 *  @author Ivan Milincic <kreativan@outlook.com>
 *  @copyright 2018 Kreativan
 *
 *  @var string $page_name
 *
*/

?>


<ul class="uk-tab uk-position-relative">

    <li class="<?= ($page_name == "main") ? "uk-active" : ""; ?>">
        <a href="<?= $page->url ?>">
            <?= $page->title ?>
        </a>
    </li>

    <?php if($this->user->isSuperuser()):?>
        <li>
            <a href="<?= $this->config->urls->admin ?>page/add/?parent_id=<?= $widgets->id ?>" title="Create new">
                <i class="fa fa-plus"></i>
            </a>
        </li>
    <?php endif;?>

    <li class="uk-flex uk-flex-middle">
        <button class="ivm-group-action-button uk-button uk-button-link uk-height-1-1 uk-padding-small uk-padding-remove-vertical" 
            type="submit" 
            form="group-actions" 
            name="admin_action_group_publish" 
            value="1" 
            title="Publish / Unpublish" 
            uk-tooltip
            disabled
        >
            <i class="fa fa-toggle-on"></i>
        </button>
    </li>

    <li class="uk-flex uk-flex-middle">
        <button class="ivm-group-action-button uk-button uk-button-link uk-height-1-1 uk-padding-small uk-padding-remove-vertical"
            title="Clone" 
            uk-tooltip
            disabled
            data-form="#group-actions"
            data-action="admin_action_group_clone"
            onclick="formSubmitConfirm()"
        >
            <i class="fa fa-copy"></i>
        </button>
    </li>

    <li class="uk-flex uk-flex-middle">
        <button class="ivm-group-action-button uk-button uk-button-link uk-height-1-1 uk-padding-small uk-padding-remove-vertical" 
            title="Delete" 
            uk-tooltip
            disabled
            data-form="#group-actions"
            data-action="admin_action_group_delete"
            onclick="formSubmitConfirm()"
        >
            <i class="fa fa-trash"></i>
        </button>
    </li>

</ul>
