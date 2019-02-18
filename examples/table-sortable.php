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

    <?php if($items->count) :?>
        <thead>
            <tr>
                <th></th>
                <th>Title</th>
                <th>ID / Link</th>
                <th>Type</th>
                <th></th>
            </tr>
        </thead>  
    <?php endif;?>  

    <tbody>
        <?php foreach($items as $item):?>

            <?php
                $class = $item->isHidden() || $item->isUnpublished() ? "ivm-is-hidden" : "";
            ?>

            <tr class="<?= $class ?> ivm-ajax-parent" data-sort='<?= $item->sort ?>' data-id='<?= $item->id ?>' class="<?= $class ?>">

                <td class="uk-table-shrink">
                    <i class="fa fa-<?= $item->template->getIcon();?>">
                </td>

                <td>
                    <a href="<?= $this_module->pageEditLink($item->id) ?>">
                        <?= $item->title ?>
                    </a>
                </td>

                <td class="uk-text-muted uk-text-small">
                    <em>#<?= $item->name ?></em>
                </td>

                <td class="uk-text-muted uk-text-small">
                    <em><?= $item->template ?></em>
                </td>

                <td class="ivm-actions ivm-actions--circle uk-text-right">

                    <a href="#" class="ivm-ajax-button" title="Publish / Unpublish" uk-tooltip 
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

<?php
if($items->count < 1) echo "<div class='uk-padding'><h3 class='uk-margin-remove'>No items to display</h3></div>";
?>