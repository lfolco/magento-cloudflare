<?php

	class JetRails_Cloudflare_Block_Adminhtml_Dashboard_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs {

	    public function __construct () {
	        parent::__construct ();
	        $this->setId ("cloudflare_dashboard");
	        $this->setDestElementId ("edit_form");
	        $this->setTitle ("<img class='cloudflare_logo'  src='" . $this->getSkinUrl ('images/cloudflare/cloudflare.svg') . "' /><span>Cloudflare is a registered trademark of Cloudflare, Inc.</span>");
	    }

		protected function _beforeToHtml () {
			$this
			->addTab ( "overview", array (
				"label"  	=> $this->__("Overview"),
				"title"  	=> $this->__("Overview"),
				"content"   => $this->getLayout ()->createBlock ("cloudflare/dashboard_edit_tab_overview")->toHtml (),
			))
			->addTab ( "caching", array (
				"label"  	=> $this->__("Caching"),
				"title"  	=> $this->__("Caching"),
				"content"   => $this->getLayout ()->createBlock ("cloudflare/dashboard_edit_tab_caching")->toHtml (),
			))
			->addTab ( "dns", array (
				"label"  	=> $this->__("DNS"),
				"title"  	=> $this->__("DNS"),
				"content"   => $this->getLayout ()->createBlock ("cloudflare/dashboard_edit_tab_dns")->toHtml (),
			))
			->addTab ( "speed", array (
				"label"  	=> $this->__("Speed"),
				"title"  	=> $this->__("Speed"),
				"content"   => $this->getLayout ()->createBlock ("cloudflare/dashboard_edit_tab_speed")->toHtml (),
			));
			return parent::_beforeToHtml ();
		}

	}
