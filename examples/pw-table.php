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

$table = $this->modules->get('MarkupAdminDataTable');
$table->set("encodeEntities", false);
$table->set("sortable", true);
$table->set("resizable", false);
$table->set("class", "uk-table-striped uk-table-middle");
// $table->set("id", "ivm-pw-data-table");
// $table->set("caption", "PW Table Caption");

// Table Heading
$table->headerRow([
    '',
	'Related Page',
    'Text',
    'User',
    'Email',
    'IP',
    'Date',
    ['Actions', 'uk-text-right']
]);

// Table Data
foreach($this_module->items() as $item) {

    //Add Row
    $table->row(
        [
            '<i class="fa fa-comment-o" title="Edit Comment"></i>' => $helper->pageEditLink($item->id), // <td> link
            [$this->sanitizer->truncate($item->parent->title, 20), "uk-text-small"],
            ["<em title='$item->text'>{$this->sanitizer->truncate($item->text, 30)}</em>", "uk-text-small"],
            [$item->user_name, "uk-text-small"],
            [$item->email, "uk-text-small"],
            [$item->ip, "uk-text-small"],
            [date("d F y h:s:i A", $item->created), "uk-text-small"],
            [$helper->tableActions($item), 'uk-text-right ivm-pw-table-actions'],

        ],
        [
            "class" => $item->isUnpublished() ? "ivm-ajax-parent ivm-is-hidden" : "ivm-ajax-parent", // <tr> class
            "attrs" => ["data-id" => "$item->id"] ,// <tr> attr
        ]
    );

}

// Render Pagination
$this_module->items()->renderPager();

if($this_module->items()->count < 1) {
    $table->row([
        ["No items to display", "uk-h3 uk-padding uk-margin-remove"]
    ]);
}

echo $table->render();
