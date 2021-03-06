<?php
/**
 *  _install.php
 *
 *  @author Ivan Milincic <kreativan@outlook.com>
 *  @copyright 2019 Kreativan
 *
 *
*/

$api = $this->modules->get("KreativanApi");

/* =========================================================== 
    1. Fields
=========================================================== */

/**
 *  Page Reference Field
 * 
 */
$f = new Field(); 
$f->type = $this->modules->get("FieldtypePage");
$f->name = 'FIELD_NAME';
$f->label = 'FIELD_LABEL';
$f->derefAsPage = "1";
$f->inputfield = 'InputfieldPageListSelect';
$f->parent_id = 1;
$f->tags = "FIELD_TAG";
$f->save();


/**
 *  Text Field
 * 
 */

$f = new Field(); 
$f->type = $this->modules->get("FieldtypeText"); 
$f->name = 'FIELD_NAME';
$f->label = 'FIELD_LABEL';
$f->tags = "FIELD_TAG";
$f->save();

/**
 *  Options Field (KreativanApi)
 * 
 */

$options = ["Option 1", "Option 2", "Option 3"];
$api->createOptionsField("InputfieldCheckboxes", "FIELD_NAME", "FIELD_LABEL", $options, "FIELD_TAG");


/**
 *  Repeater Field (KreativanApi)
 * 
 */

$fields_array = ["title", "FIELD_NAME_1", "FIELD_NAME_2", "FIELD_NAME_3"];
$api->createRepeater("REPEATER_NAME", "REPEATER_LABEL", $fields_array, "{title}", "FIELD_TAG");

// Set fields options for repeater
$api->setRepeaterFieldOptions("REPEATER_NAME", "FIELD_NAME", ["showIf" => "link_type=2"]);


/* =========================================================== 
    2. Templates + Fieldgroups
=========================================================== */

// new fieldgroup
$fg = new Fieldgroup();
$fg->name = 'TEMPLATE_NAME';
$fg->add($this->fields->get('title'));
$fg->add($this->fields->get('body')); 
$fg->save();

// new template using the fieldgroup and a template
$t = new Template();
$t->name = 'TEMPLATE_NAME';
$t->label = 'TEMPLATE_LABEL';
$t->fieldgroup = $fg; 
$t->pageLabelField = 'fa-html5';
$t->save();

// set template options
$t = wire('templates')->get("TEMPLATE_NAME");
$t->noParents = '-1';
$t->allowPageNum = '1';
$t->urlSegments = '1';
$t->tags = 'TEMPLATE_TAG';
$t->parentTemplates = array(wire('templates')->get('PARENT_TEMPLATE_NAME')); // allowedForParents
$t->childTemplates = array(wire('templates')->get('CHILD_TEMPLATE_NAME')); // allowedForChildren
$t->save();


/**
 *  Template Structire (KreativanApi)
 * 
 */
$main = [
    "name" => "MAIN_TEMPLATE_NAME",
    "fields" => ["title", "FIELD_NAME_1", "FIELD_NAME_2", "FIELD_NAME_3"],
    "icon" => "fa-sitemap",
    "parent" => "PARENT_ID",
    "page_title" => "MAIN_PAGE_TITLE",
];

$item = [
    "name" => "ITEM_TEMPLATE_NAME",
    "fields" => ["title", "FIELD_NAME_1", "FIELD_NAME_2", "FIELD_NAME_3"],
    "icon" => "fa-bars",
    "page_title" => "ITEM_PAGE_TITLE",
];

$api->createTemplateStructure($main, $item);


/* =========================================================== 
    2.1 Add Fields To Existing Template
=========================================================== */

// add field to the template
$t = $this->templates->get('TEMPLATE_NAME');
$t->fields->add("FIELD_NAME");
$t->fields->save(); 

/**
 *  Add field to a specific position
 * 
 */

 // get template
$template = $page->template;

// get existing field from the template, 
// we will insert new field before or after this field
$existingField = $template->fieldgroup->fields->get("body");
 
// new field that we want to insert
$new_field = $fields->get("headline");
 
// insert new field before existing one
$template->fieldgroup->insertBefore($new_field, $existingField);
$template->fieldgroup->save();

// 
//	Or use KreativanApi
//
$api->addTemplateField("TEMPLATE_NAME", "NEW_FIELD", "EXISTING_FIELD", "before");


/* =========================================================== 
    3. Fields Options
=========================================================== */

// change field settings for this template
$t = wire('templates')->get('TEMPLATE_NAME');
$f = $t->fieldgroup->getField('FIELD_NAME', true);
$f->columnWidth = "50";
$this->fields->saveFieldgroupContext($f, $t->fieldgroup);

// using KreativanApi
$api->setFieldOptions("TEMPLATE_NAME", "FIELD_NAME", ["showIf" => "link_type=2"]);


/* =========================================================== 
    4. Pages
=========================================================== */

// Create new page
$p = new Page();
$p->template = "TEMPLATE_NAME";
$p->parent = "PARENT_ID";
$p->title = "PAGE_TITLE";
$p->save();
// add image (need to save before add image)
$p->img->add("img_url");
$p->save();