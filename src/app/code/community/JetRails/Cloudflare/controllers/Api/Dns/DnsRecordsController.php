<?php

	class JetRails_Cloudflare_Api_Dns_DnsRecordsController extends JetRails_Cloudflare_Controller_Action {

		protected function _isAllowed () {
			$session = Mage::getSingleton ("admin/session");
			return $session->isAllowed ("jetrails/cloudflare/dns/dns_records");
		}

		public function indexAction () {
			$api = Mage::getModel ("cloudflare/api_dns_dnsRecords");
			$response = $api->listRecords ();
			return $this->_formatAndSend ( $response );
		}

		public function deleteAction () {
			$api = Mage::getModel ("cloudflare/api_dns_dnsRecords");
			$response = $api->deleteRecord ( $this->_request->getParam ("id") );
			return $this->_formatAndSend ( $response );
		}

		public function createAction () {
			$api = Mage::getModel ("cloudflare/api_dns_dnsRecords");
			$response = $api->createRecord (
				trim ( strtoupper ( $this->_request->getParam ("type") ) ),
				trim ( $this->_request->getParam ("name") ),
				trim ( $this->_request->getParam ("content") ),
				intval ( $this->_request->getParam ("ttl") ),
				$this->_request->getParam ("proxied") == "true",
				intval ( $this->_request->getParam ("priority") )
			);
			return $this->_formatAndSend ( $response );
		}

		public function searchAction () {
			$api = Mage::getModel ("cloudflare/api_dns_dnsRecords");
			$response = $api->searchRecords ( trim ( $this->_request->getParam ("query") ) );
			return $this->_formatAndSend ( $response );
		}

		public function exportAction () {
			$api = Mage::getModel ("cloudflare/api_dns_dnsRecords");
			return $this->_sendRaw ( $api->export () );
		}

		public function uploadAction () {
			$api = Mage::getModel ("cloudflare/api_dns_dnsRecords");
			$file = $_FILES ["file"] ["tmp_name"];
			if ( file_exists ( $file ) ) {
				$response = $api->import ( $_FILES ["file"] );
				return $this->_sendResponse ( $response, false );
			}
			else {
				return $this->_sendResponse ( array ( "success" => false ) );
			}
		}

	}
