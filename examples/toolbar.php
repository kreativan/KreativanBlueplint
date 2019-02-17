<?php
/**
 *  Toolbar
 * 
 * 
 */

$sorting_options = array(
    '-created' => 'Latest',
    'created' => 'Oldest',
    '-modified' => 'Modified',
    '-comments.count' => 'Comments',
    'title' => 'A-Z',
    '-title' => 'Z-A'
);

// status options
$status_options = array(
    'active' => 'Active',
    'hidden' => 'Hidden',
    'unpublished' => 'Unpublished',
    'trash' => 'Trashed'
);


?>

<div class="uk-padding-small">
    <form action="./submissions" method="GET">
        <div class="uk-grid-small" uk-grid>

            <div class="uk-width-expand@m">
                <select class="uk-select" name="form" onchange="this.form.submit()">
                    <option value="">- Select Form -</option>
                    <?php foreach($items as $item) :?>
                        <option value="<?= $item->id ?>" <?= ($this->input->get->form == $item->id) ? "selected" : "" ?>>
                            <?= $item->title ?>
                        </option>
                    <?php endforeach?>
                </select>
            </div>

            <div class="uk-width-medium@m">
                <select class="uk-select" name="status" onchange="this.form.submit()">
                    <option value="">- Select Form -</option>
                    <?php foreach($items as $item) :?>
                        <option value="<?= $item->id ?>" <?= ($this->input->get->form == $item->id) ? "selected" : "" ?>>
                            <?= $item->title ?>
                        </option>
                    <?php endforeach?>
                </select>
            </div>
        
        </div>
    </form>
</div>