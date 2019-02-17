<?php
/**
 *  Blog Posts Selector
 *
 *  @author Ivan Milincic <lokomotivan@gmail.com>
 *  @copyright 2018 Ivan Milincic
 *
 *
*/

// get limit for another module settins
$limit = $this->modules->get('SoftnaBlog')->admin_limit;
if(isset($_GET['limit']) && $_GET['limit'] != '') {
    $limit = $_GET['limit'];
    $this->input->whitelist('limit', $limit);
}

$sort = '-created';
if(isset($_GET['sort']) && $_GET['sort'] != '') {
    $sort = $_GET['sort'];
    $this->input->whitelist('sort', $sort);
}

// Include all by default
$status = 'status!=trash,include=all,';
// if active leave status selector empty
if(isset($_GET['status']) && $_GET['status'] == 'active') {
    $status = "";
}
// if sattus is set add status selector
elseif(isset($_GET['status']) && $_GET['status'] != '') {
    $get_status = $_GET['status'];
    $this->input->whitelist('status', $get_status);
    $status = "status=$get_status,";
}

// start selector
$selector = "template=blog-post,{$status}limit={$limit},sort={$sort}";

// check for aditional GET avriables and update selector
if(isset($_GET['q']) && $_GET['q'] != '') {
    $q = $this->input->get->q;
    $this->input->whitelist('q', $q);
    $selector .= ",title*=$q";
}

// category
if(isset($_GET['category']) && $_GET['category'] != '') {
    $category_id = $_GET['category'];
    $category = $this->pages->get($category_id);
    $this->input->whitelist('status', $category);
    $selector .= ",blog_categories=$category";
}

// find pages
$items = $this->pages->find($selector);

// render pagination results
$pagination = $items->renderPager();
