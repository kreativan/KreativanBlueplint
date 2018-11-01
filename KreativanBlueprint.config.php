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
		$inputfields = parent::getInputfields();


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


		$wrapper = new InputfieldWrapper();


		/**
		 * 	Options
		 *
		 */
		$options = $this->wire('modules')->get("InputfieldFieldset");
		$options->label = __("Options");
		//$options->collapsed = 1;
		$options->icon = "fa-cog";
		$wrapper->add($options);


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
			$options->add($f);


		// render fieldset
		$inputfields->add($options);



		// render fields
		return $inputfields;


	}

}
