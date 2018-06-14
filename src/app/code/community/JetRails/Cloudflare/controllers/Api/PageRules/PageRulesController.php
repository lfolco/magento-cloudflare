<?php

	class JetRails_Cloudflare_Api_PageRules_PageRulesController
	extends JetRails_Cloudflare_Controller_Action {

		public function indexAction () {
			$api = Mage::getModel ("cloudflare/api_pageRules_pageRules");
			$response = $api->load ();
			return $this->_sendResponse ( $response );
		}

		public function createAction () {
			$api = Mage::getModel ("cloudflare/api_pageRules_pageRules");
			$response = $api->create (
				$this->_request->getParam ("target"),
				$this->_request->getParam ("actions"),
				$this->_request->getParam ("status") == "true",
				intval ( $this->_request->getParam ("priority") )
			);
			return $this->_sendResponse ( $response );
		}

		public function editAction () {
			$api = Mage::getModel ("cloudflare/api_pageRules_pageRules");
			$response = $api->edit (
				$this->_request->getParam ("id"),
				$this->_request->getParam ("target"),
				$this->_request->getParam ("actions"),
				$this->_request->getParam ("status") == "true"
			);
			return $this->_sendResponse ( $response );
		}

		public function toggleAction () {
			$api = Mage::getModel ("cloudflare/api_pageRules_pageRules");
			$response = $api->toggle (
				$this->_request->getParam ("id"),
				$this->_request->getParam ("state") == "true"
			);
			return $this->_sendResponse ( $response );
		}

		public function deleteAction () {
			$api = Mage::getModel ("cloudflare/api_pageRules_pageRules");
			$response = $api->delete ( $this->_request->getParam ("id") );
			return $this->_sendResponse ( $response );
		}

		public function priorityAction () {
			$api = Mage::getModel ("cloudflare/api_pageRules_pageRules");
			$response = $api->priority (
				$this->_request->getParam ("priorities")
			);
			return $this->_sendResponse ( $response );
		}

	}
