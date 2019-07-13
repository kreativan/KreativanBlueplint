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
    'Rating',
    'User',
    'Email',
    'IP',
    'Date',
    'Actions'
]);

// Table Data
foreach($this_module->itemsTrash() as $item) {

    $title = $this->pages->get($item->page_id)->title;
    $related_page = $this->sanitizer->truncate($title, 20);

    $rating = (!empty($item->rating) &&  $item->rating > 0) ?  $item->rating : "-";

    $actions = "
        <a href='#' class='ivm-ajax-button' title='Restore' uk-tooltip
            data-id='$item->id'
            data-action='restore'
        >
            <i class='fa fa-refresh uk-text-primary'></i>
        </a>

        <a href='#' class='ivm-ajax-button uk-text-danger' title='Delete' uk-tooltip
            data-id='$item->id'
            data-action='delete'
        >
            <i class='fa fa-trash'></i>
        </a>
    ";


    //Add Row
    $table->row(
        [
            '<i class="fa fa-comment-o uk-text-danger" title="Edit Comment"></i>' => $helper->pageEditLink($item->id), // <td> link
            [$related_page, "uk-text-small"],
            ["<em title='$item->text'>{$this->sanitizer->truncate($item->text, 30)}</em>", "uk-text-small"],
            [$rating, "uk-text-small"],
            [$item->user_name, "uk-text-small"],
            [$item->email, "uk-text-small"],
            [$item->ip, "uk-text-small"],
            [date("d F y h:s:i A", $item->created), "uk-text-small"],
            [$actions, 'ivm-pw-table-actions'],

        ],
        [
            "class" => $item->isUnpublished() ? "ivm-ajax-parent ivm-is-hidden" : "ivm-ajax-parent", // <tr> class
            "attrs" => ["data-id" => "$item->id"] ,// <tr> attr
        ],
    );

}

if($this_module->itemsTrash()->count < 1) {
    $table->row([
        ["No items to display", "uk-h3 uk-padding uk-margin-remove"]
    ]);
}

echo $table->render();
