<?php
/**
 *  KreativanBlueprint Module
 *
 *  @author Ivan Milincic <kreativan@outlook.com>
 *  @copyright 2019 kraetivan.net
 *  @link http://www.kraetivan.net
 *
 *
*/

class KreativanBlueprint extends Process {
	
	
	public function init() {
        parent::init(); // always remember to call the parent init
    }

	
    /**
     *  Execute
     *  Module Page
     *  @see includeAdminFile()
     * 
     */
    public function ___execute() {

        // set a new headline, replacing the one used by our page
        // this is optional as PW will auto-generate a headline
        $this->headline('Kreativan Blueprint');

        // add a breadcrumb that returns to our main page
        // this is optional as PW will auto-generate breadcrumbs
        $this->breadcrumb('./', 'Kreativan Blueprint');

        // include admin file
        return $this->modules->get("KreativanHelper")->includeAdminFile($this, "admin.php", "main");

    }
    
	
    /**
	 *	Page Edit
     *  This is custom page edit for this module
     * 
     *  Edit URL example: admin/MODULE_URL/edit/id?=PAGE_ID
     * 
     */
    public function executeEdit() {
        return $this->modules->get("KreativanHelper")->adminPageEdit();
    }
	
	/**
	 *	Get Items
	 *
	 */
	public function items() {
		
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
		
		return $items;

	}
	
	/**
	 *	Get Trashed Items
	 *
	 */
	public function itemsTrash() {
		$template = "comment";
		$trashed = $this->pages->find("template=$template, status=trash");
		return $trashed;
	}
	

	/**
	 * Called only when your module is installed
	 *
	 * If you don't need anything here, you can simply remove this method.
	 *
	 */
	public function ___install() {
		parent::___install(); // always remember to call parent method
		// include("./_install.php");
	}

	/**
	 * Called only when your module is uninstalled
	 *
	 * This should return the site to the same state it was in before the module was installed.
	 *
	 * If you don't need anything here, you can simply remove this method.
	 *
	 */
	public function ___uninstall() {
		parent::___uninstall(); // always remember to call parent method
		// include("./_uninstall.php");
	}

}
