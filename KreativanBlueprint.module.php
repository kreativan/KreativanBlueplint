<?php
/**
 *  KreativanBlueprint Module
 *
 *  @author Ivan Milincic <kreativan@outlook.com>
 *  @copyright 2018 Kreativan
 *
 *
*/

class KreativanBlueprint extends Process {


    /**
     *  Execute
     *  Module Page
     *  @method includeAdminFile()
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
        return $this->includeAdminFile("admin.php", "main");

    }



	/* =========================================================== 
        Init
    =========================================================== */

	public function init() {
        parent::init(); // always remember to call the parent init

        /**
         *  Set @var new_back session
         * 
         *  This is used this to redirect back to module page,
         *  after creating new page.
         *  See @method newPageLink()
         * 
         */
        if($this->input->get->new_back) {
            $this->session->set("new_back", $this->input->get->new_back);
        }

        /**
         *  If there is @var new_back session,
         *  redirect back to the module on page save + exit
         *  See @method redirect 
         * 
         */
        if($this->session->get("new_back")) {
            if(($this->input->post('submit_save') == 'exit') || ($this->input->post('submit_publish') == 'exit')) {
                $this->input->post->submit_save = 1;
                $this->addHookAfter("Pages::saved", $this, "redirect");
            }
        }

    }

    
    /* ========================================================================== 
        UI / Render Methods
    ========================================================================== */

    /**
     *  Include Admin File
     *  This will include admin php file from the module folder
     *  @var file_name		php file name from module folder
	 *	@var page_name		used to indentify active page
     *
     */
    private function includeAdminFile($file_name, $page_name) {

        /** 
         *  Remove @var back_url session 
         *  Remove @var new_back session 
         *  This will reset current session vars,
         *  used for redirects on page save + exit
         * 
         */
        $this->session->remove("back_url");
        $this->session->remove("new_back");

        $vars = [
            "this_module" => $this,
			"page_name" => $page_name,
            "module_edit_URL" => $this->urls->admin . "module/edit?name=" . $this->className() . "&collapse_info=1",
        ];

        $template_file = $this->config->paths->siteModules . $this->className() . "/" . $file_name;
        return $this->files->render($template_file, $vars);

    }

    /**
     *  Page Edit Link
     *  Use this method to generate page edit link.
     *  @var id     integer, page id 
     *  @example    href='{$this->pageEditLink($item->id)}';
     * 
     */
    public function pageEditLink($id) {

        /**
         *	Get current url and it's last segment so we can go back to same page later on.
         *	We are looking for pagination related segments like "page2, page3...", 
         *  including current GET variables.
         *	We will be passing this segment string as a GET variable via page edit link.
         *
         */
        $currentURL = $_SERVER['REQUEST_URI'];
        $url_segment = explode('/', $currentURL);
        $url_segment = $url_segment[sizeof($url_segment)-1];
        return $this->page->url . "edit/?id=$id&back_url={$url_segment}";

    }

    /**
     *  New Page Link
     *  Use this method to generate new page link
     *  @var parent_id      integer, parent page id
     *  @example            href='{$this->newPageLink($parent_id)}';
     * 
     */
    public function newPageLink($parent_id) {
        return $this->config->urls->admin . "page/add/?parent_id={$parent_id}&new_back={$this->page->name}";
    }


    /* =========================================================================
        Page Edit
    ========================================================================== */

    /**
     *  This is custom page edit for this module
     *  Edit URL @example admin/MODULE_URL/edit/id?=PAGE_ID
     * 
     *  For module page edits, we are using custom page edit url, 
     *  see @method pageEditLink()
     * 
     */
    public function executeEdit() {

        /**
         *  Set @var back_url session var
         *  So we can redirect back where we left
         * 
         */
        if($this->input->get->back_url) {
            $this->session->set("back_url", $this->input->get->back_url);
        }

        /**
         *  Redirect on save + exit
         *  based on the @var back_url using @method redirect 
         * 
         */
        if($this->session->get("back_url")) {
            if(($this->input->post('submit_save') == 'exit') || ($this->input->post('submit_publish') == 'exit')) {
                $this->input->post->submit_save = 1;
                $this->addHookAfter("Pages::saved", $this, "redirect");
            }
        }


        /**
         *  Set the breadcrumbs 
         *  add @var back_url to the breacrumb link 
         * 
         */
        $this->fuel->breadcrumbs->add(new Breadcrumb($this->page->url.$this->input->get->back_url, $this->page->title));

        // Execute Page Edit
        $processEdit = $this->modules->get('ProcessPageEdit');
        return $processEdit->execute();

    }


    /* ======================================================================
       Admin Methods
    ========================================================================= */


    /**
     *	This is our main redirect function.
     *	We are using this function to redirect back to previews page 
     *  on save+exit and save+publish actions
     *  based on @var back_url and @var new_back session
     * 
     */
    public function redirect() {

        if($this->session->get("back_url")) {
            $goto = "./../" . $this->session->get("back_url");
        } elseif($this->session->get("new_back")) {
            $new_back   = $this->session->get("new_back");
            $goto       = $this->pages->get("template=admin, name=$new_back")->url;
        } else {
            $goto = $this->page->url;
        }

        $this->session->redirect($goto);
        
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
