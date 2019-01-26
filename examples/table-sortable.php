<?php
/**
 *  Table Admin UI
 *
 *  @author Ivan Milincic <kreativan@outlook.com>
 *  @copyright 2018 Kreativan
 *
 *  @var items
 *
*/


?>

<table class="ivm-table uk-table uk-table-striped uk-table-middle uk-margin-remove">

    <thead>
        <tr>
            <th></th>
            <th>Title</th>
            <th>Link Type</th>
            <th>Link</th>
            <th class="uk-text-center">Dropdown</th>
            <th></th>
        </tr>
    </thead>  

    <tbody id="ivm-sortable">
        <?php foreach($items as $item):?>

            <?php
                $class = $item->isHidden() || $item->isUnpublished() ? "ivm-is-hidden" : "";
            ?>

            <tr data-sort='<?= $item->sort ?>' data-id='<?= $item->id ?>' class="<?= $class ?>">

                <td class="uk-table-shrink">
                    <div class="handle">
                        <i class='fa fa-bars'></i>
                    </div>  
                </td>

                <td>
                    <a href="<?= $this_module->pageEditLink($item->id) ?>">
                        <?= $item->title ?>
                    </a>
                </td>

                <td class="uk-text-muted">
                    <em><?= $item->km_link_type->title ?></em>
                </td>

                <td class="uk-text-muted uk-text-small">
                    <?php
                        if($item->km_link_type == '2' && !empty($item->km_page_link)) {
                            $page_link = $this->pages->get("id={$item->km_page_link}");
                            if($page_link->parent->id == "1") {
                                echo "/{$page_link->name}/";
                            } else {
                                echo "/{$page_link->parent->name}/{$page_link->name}/";
                            }
                        }
                    ?>
                    <?= ($item->km_link_type == '3') ? "<em>{$item->km_link}</em>" : ""; ?>
                </td>

                <td class="uk-text-center uk-text-muted">
                    <?= ($item->km_dropdown->count) ? $item->km_dropdown->count : "-"; ?>
                </td>

                <td class="uk-text-right">

                    <?php
                        $tooltip = $item->isUnpublished() ? "Publish" : "Unpublish";
                    ?>

                    <a href="#" class="ivm-ajax-button" title="<?= $tooltip ?>" uk-tooltip 
                        data-id="<?= $item->id ?>" 
                        data-action="publish"
                    >
                        <i class="fa fa-toggle-on"></i>
                    </a>

                    <a href="#" class="ivm-ajax-button" title="Trash" uk-tooltip 
                        data-id="<?= $item->id ?>" 
                        data-action="trash"
                    >
                        <i class="fa fa-close"></i>
                    </a>

                </td>

            </tr>

        <?php endforeach;?>
    </tbody>

</table>