<?php
/**
 *  pw-table.php
 *
 *  @author Ivan Milincic <kreativan@outlook.com>
 *  @copyright 2019 kraetivan.net
 *  @link http://www.kraetivan.net
 *
 *
*/

echo "<form id='group-actions' action='./' method='POST'>";

$table = $this->modules->get('MarkupAdminDataTable');
$table->set("encodeEntities", false);
$table->set("sortable", true);
$table->set("resizable", false);
$table->set("class", "uk-table-striped uk-table-middle");
// $table->set("id", "ivm-pw-data-table");
// $table->set("caption", "PW Table Caption");

// Select All Input Checkbox
$select_all = "<input id='ivm-checkbox-all' type='checkbox' name='select_all' value='1' />";

// Table Heading
$table->headerRow([
    '',
    'Title',
    'Widget',
    'Name',
    'ID',
    [$select_all, 'uk-text-right sorter-false']
]);

// Table Data
foreach($this_module->items() as $item) {

    $icon = $item->template->getIcon();
    $icon = !empty($icon) ? $icon : "html5";

    $tmpl =!empty($item->template->label) ? $item->template->label : $item->template;
    $title = "<a href='{$helper->pageEditLink($item->id)}'>{$item->title}</a>";

    $input = "
        <label class='uk-display-block uk-text-center'>
            <input class='ivm-checkbox' type='checkbox' name='admin_items[]' value='$item->id' />
        </label>
    ";

    //Add Row
    $table->row(
        [
            ["<i class='fa fa-$icon fa-lg uk-margin-small-left'></i>", "uk-table-shrink"], // <td> link
            $title,
            [$tmpl, "uk-text-small"],
            [$item->name, "uk-text-muted uk-text-small"],
            [$item->id, "uk-text-muted uk-text-small"],
            [$input, 'uk-table-shrink'],
        ],
        [
            "class" => $item->isUnpublished() ? "ivm-is-hidden" : "", // <tr> class
            "attrs" => ["data-id" => "$item->id"] ,// <tr> attr
        ],
    );

}


if($this_module->items()->count < 1) {
    $table->row([
        ["No items to display", "uk-h3 uk-padding uk-margin-remove"]
    ]);
}

echo $table->render();

echo "</form>";