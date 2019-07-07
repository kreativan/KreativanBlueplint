<?php
/**
 *  _seselctor.php
 *
 *  @author Ivan Milincic <kreativan@outlook.com>
 *  @copyright 2019 kraetivan.net
 *  @link http://www.kraetivan.net
 *
 *
*/


$template = "comment";

// Selector
$selector = "template=$template, sort=-created, limit=20";


// Status
if($this->input->get->status) {
    $status = $this->input->get->status;
    $this->input->whitelist('status', $status);
    if($status != "active") {
        $selector .= ", status=$status";
    }
} else {
    $selector .= ", include=all, status!=trash";
}


// Search
if($this->input->get->q) {
    $q = $this->input->get->q;
    $this->input->whitelist('q', $q);
    $selector .= ",title*=$q";
}

// items
$items = $this->pages->find($selector);

// trashed items
$trashed = $this->pages->find("template=$template, status=trash");

// render pagination results
// $pagination = $items->renderPager();
