<?php

/**
 * KreativanBlueprint.config.php
 *
 * This type of configuration method requires ProcessWire 2.5.5 or newer.
 * For backwards compatibility with older versions of PW, you'll want to
 * instead want to look into the getModuleConfigInputfields() method, which
 * is specified with the .module file. So we are assuming you only need to
 * support PW 2.5.5 or newer here.
 *
 * For more about configuration methods, see here:
 * http://processwire.com/blog/posts/new-module-configuration-options/
 *
 */

class KreativanBlueprintConfig extends ModuleConfig {

	public function getInputfields() {
		
		/* =========================================================== 
			Run some code
		=========================================================== */
		
		if($this->input->get->test) {
			// Do something
		}
	
		/* =========================================================== 
			Options Arrays
		=========================================================== */

		// create templates options array
		$templatesArr = array();
		foreach($this->templates as $tmp) {
			$templatesArr["$tmp"] = $tmp->name;
		}

		// create pages options array
		$pagesArr = array();
		foreach($this->pages->get("/")->children("include=hidden") as $p) {
			$pagesArr["$p"] = $p->title;
		}
		
	
		/* =========================================================== 
			Config Fields
		=========================================================== */
	
		$inputfields = parent::getInputfields();
		$wrapper = new InputfieldWrapper();


		/**
		 * 	Options
		 *
		 */
		 
		$SET_options = $this->wire('modules')->get("InputfieldFieldset");
		$SET_options->label = __("Options");
		//$options->collapsed = 1;
		$SET_options->icon = "fa-cog";
		$wrapper->add($SET_options);


			// radio
			$f = $this->wire('modules')->get("InputfieldRadios");
			$f->attr('name', 'radio_option');
			$f->label = 'Radio Options';
			$f->options = array(
				'1' => $this->_('Yes'),
				'0' => $this->_('No'),
			);
			$f->required = true;
			$f->defaultValue = 1;
			$f->optionColumns = 1;
			$f->columnWidth = "100%";
			$f->collapsed = 0;
			$SET_options->add($f);


		// render fieldset
		$inputfields->add($SET_options);
		
		
		
		/**
		 * 	Buttons / Actions
		 *
		 */
		
		$thisUrl = "edit?name=KreativanBlueprint&collapse_info=1";
			
		$SET_buttons = $this->wire('modules')->get("InputfieldFieldset");
		$SET_buttons->label = __("Actions");
		$SET_buttons->icon = "fa-mouse-pointer";
		$wrapper->add($SET_buttons);
			
			// Button
			$f = $this->wire('modules')->get("InputfieldButton");
			$f->attr('name', 'create_user');
			$f->attr('href', "{$thisUrl}&test=123");
			$f->class = "uk-button uk-button-primary uk-margin-right";
			$f->value = 'Button';
			$SET_buttons->add($f);
			
			// Markup - Can use <a> and modalConfirm()
			$f = $this->wire('modules')->get("InputfieldMarkup");
			$f->value = "
				<a class='uk-button uk-button-primary' href='{$thisUrl}&test=123' onclick='modalConfirm()'>
					Import Cities
				</a>
			";
			$buttons_set->add($f);
			

		// render fieldset
		$inputfields->add($SET_buttons);

		
		
		//
		// Render Fields
		//
		return $inputfields;


	}

}
