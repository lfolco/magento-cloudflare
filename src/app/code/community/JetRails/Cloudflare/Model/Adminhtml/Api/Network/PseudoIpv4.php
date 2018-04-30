<?php

	class JetRails_Cloudflare_Model_Adminhtml_Api_Network_PseudoIpv4 extends Mage_Core_Model_Abstract {

		public function getValue () {
			$zoneId = Mage::getModel ("cloudflare/api_overview_configuration")->getZoneId ();
			$endpoint = sprintf ( "zones/%s/settings/pseudo_ipv4", $zoneId );
			$api = Mage::getModel ("cloudflare/api_request");
			$api->setType ( $api::REQUEST_GET );
			return $api->resolve ( $endpoint );
		}

		public function setValue ( $value ) {
			$zoneId = Mage::getModel ("cloudflare/api_overview_configuration")->getZoneId ();
			$endpoint = sprintf ( "zones/%s/settings/pseudo_ipv4", $zoneId );
			$api = Mage::getModel ("cloudflare/api_request");
			$api->setType ( $api::REQUEST_PATCH );
			$api->setData ( array (
				"value" => $value
			));
			return $api->resolve ( $endpoint );
		}

	}