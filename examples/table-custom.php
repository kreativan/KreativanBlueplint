<?php namespace ProcessWire;
/**
 *  Table Admin UI
 *
 *  @author Ivan Milincic <kreativan@outlook.com>
 *  @copyright 2018 Kreativan
 *
 *
*/

?>

<form class="pw-table-sortable" id='group-actions' action="./" method="POST">
	<table class="AdminDataTableSortable ivm-table uk-table uk-table-striped uk-table-middle uk-table-small uk-margin-remove">

		<thead>
			<tr>
				<th>Sort</th>
				<th>Title</th>
				<th>Link</th>
				<th>SEO Title</th>
				<th>SEO Description</th>
				<th class="uk-text-center">Views</th>
				<th class="uk-text-right sorter-false">
					<span class="uk-margin-small-right"></span>
					<input id="ivm-checkbox-all" type="checkbox" name="select_all" value="1" />
				</th>
			</tr>
		</thead>

		<tbody id="ivm-sortable">
			<?php foreach($this_module->items() as $item):?>

				<?php
					$class = $item->isHidden() || $item->isUnpublished() ? "ivm-is-hidden" : "";
					$img = $item->img->first();
				?>

				<tr class="ivm-ajax-parent <?= $class ?>" data-sort='<?= $item->sort ?>' data-id='<?= $item->id ?>' class="<?= $class ?>">

					<td class="uk-width-auto" style="width:100px;">
						<span class="uk-hidden"><?= $item->sort ?></span>
						<div class="handle uk-border-circle" 
							title="Drag & drop to sort" 
							style="width:36px;height:36px;padding:0;background: #f5f5f5;border:1px solid #ddd;"
						>
							<?php if(!empty($img)) :?>
								<img class="uk-border-circle" src="<?= $img->size(36, 36)->url ?>" />
							<?php endif;?>
						</div>
					</td>

					<td>
						<a href="<?= $helper->pageEditLink($item->id) ?>">
							<?= $item->title ?>
						</a>
					</td>

					<td class="uk-text-small">
						<a class='uk-text-muted' href='<?= $item->url ?>' target='_blank'>
							<i class="fa fa-external-link" style='font-size:13px;'></i>
							<?= $item->name ?>
						</a>
					</td>

					<td class="uk-text-small uk-text-muted">
						<?= $item->seo->meta->title ?>
					</td>

					<td class="uk-text-small uk-text-muted">
						<span title="<?= $item->seo->meta->description ?>" uk-tooltip>
							<?php 
								if($item->seo->meta->description != "") {
									echo $this->sanitizer->truncate($item->seo->meta->description, 40);
								} else {
									echo "...";
								}
							?>
						</span>
					</td>

					<td class="uk-text-muted uk-text-center uk-text-small">
						<?= ($item->phits > 0) ? $item->phits : "-"; ?>
					</td>

					<td class="uk-text-right">
						<input class='ivm-checkbox' type='checkbox' name='admin_items[]' value='<?= $item->id ?>' />
					</td>

				</tr>

			<?php endforeach;?>
		</tbody>

	</table>
</form>

<?php
// Pagination
echo $this_module->items()->renderPager(); 
?>

<?php
// No items
if($this_module->items()->count < 1) echo "<div class='uk-padding'><h3 class='uk-margin-remove'>No items to display</h3></div>";
?>


<?php
// Load Table Sorter
$tableSorter = $this->modules->get('JqueryTableSorter');
?>
<script>
$(function() {
    $(".AdminDataTableSortable").tablesorter({
        headers: {
            '.sorter-false' : {
                // disable it by setting the property sorter to false
                sorter: false
            }
        }
    });
});
</script>
