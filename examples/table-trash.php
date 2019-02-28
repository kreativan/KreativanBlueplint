<?php
/**
 *  Table Trash Admin UI
 *
 *  @author Ivan Milincic <kreativan@outlook.com>
 *  @copyright 2018 Kreativan
 *
 *  @var items
 *
*/


?>

<table class="ivm-table uk-table uk-table-striped uk-table-middle uk-margin-remove">

    <?php if($trashed->count) :?>
        <thead>
            <tr>
                <th>Title</th>
                <th>ID / Link</th>
                <th>Type</th>
                <th></th>
            </tr>
        </thead> 
    <?php endif;?>    

    <tbody>
        <?php foreach($trashed as $item):?>
            <tr class="ivm-ajax-parent">


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

                <td class="uk-text-right">

                    <a href="#" class="ivm-ajax-button" title="Restore" uk-tooltip 
                        data-id="<?= $item->id ?>" 
                        data-action="restore"
                    >
                        <i class="fa fa-refresh"></i>
                    </a>

                    <a href="#" class="ivm-ajax-button" title="Delete" uk-tooltip 
                        data-id="<?= $item->id ?>" 
                        data-action="delete"
                    >
                        <i class="fa fa-trash"></i>
                    </a>


                </td>

            </tr>
        <?php endforeach;?>
    </tbody>


</table>


<?php
if($trashed->count < 1) echo "<hr><div class='uk-padding'><h3 class='uk-margin-remove'>No items to display</h3></div>";
?>