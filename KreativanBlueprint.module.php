<?php
/**
 *  KreativanBlueprint Module
 *
 *  @author Ivan Milincic <kreativan@outlook.com>
 *  @copyright 2019 kraetivan.net
 *  @link 2019 http://www.kraetivan.net
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
