<?php

	class JetRails_Cloudflare_Model_Adminhtml_Api_Firewall_AccessRules extends Mage_Core_Model_Abstract {

		public function load ( $page, $perPage ) {
			$zoneId = Mage::getModel ("cloudflare/api_overview_configuration")->getZoneId ();
			$endpoint = sprintf ( "zones/%s/firewall/access_rules/rules", $zoneId );
			$api = Mage::getModel ("cloudflare/api_request");
			$api->setType ( $api::REQUEST_GET );
			$api->setQuery ( "page", intval ( $page ) );
			$api->setQuery ( "per_page", intval ( $perPage ) );
			return $api->resolve ( $endpoint );
		}

		public function delete ( $id ) {
			$zoneId = Mage::getModel ("cloudflare/api_overview_configuration")->getZoneId ();
			$endpoint = sprintf ( "zones/%s/firewall/access_rules/rules/%s", $zoneId, $id );
			$api = Mage::getModel ("cloudflare/api_request");
			$api->setType ( $api::REQUEST_DELETE );
			return $api->resolve ( $endpoint );
		}

		public function add ( $target, $value, $mode, $notes ) {
			$zoneId = Mage::getModel ("cloudflare/api_overview_configuration")->getZoneId ();
			$endpoint = sprintf ( "zones/%s/firewall/access_rules/rules", $zoneId );
			$api = Mage::getModel ("cloudflare/api_request");
			$api->setType ( $api::REQUEST_POST );
			$api->setData ( array (
				"mode" => $mode,
				"configuration" => array (
					"target" => $target,
					"value" => $value
				),
				"notes" => $notes
			));
			return $api->resolve ( $endpoint );
		}

		public function updateMode ( $id, $mode ) {
			$zoneId = Mage::getModel ("cloudflare/api_overview_configuration")->getZoneId ();
			$endpoint = sprintf ( "zones/%s/firewall/access_rules/rules/%s", $zoneId, $id );
			$api = Mage::getModel ("cloudflare/api_request");
			$api->setType ( $api::REQUEST_PATCH );
			$api->setData ( array (
				"mode" => $mode
			));
			return $api->resolve ( $endpoint );
		}

	}
