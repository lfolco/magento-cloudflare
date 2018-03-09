<?php

	class JetRails_Cloudflare_Block_Adminhtml_Dashboard_Section extends Mage_Core_Block_Template {

		public function getFormKey () {
			return Mage::getSingleton ("core/session")->getFormKey ();
		}

		public function getApiEndpoint () {
			$caller = explode ( "_section_", strtolower ( get_class ( $this ) ) ) [ 1 ];
			return Mage::getUrl ("cloudflare/api_$caller");
		}

	}