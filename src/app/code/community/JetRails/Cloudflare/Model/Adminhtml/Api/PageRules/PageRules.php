<?php

	class JetRails_Cloudflare_Model_Adminhtml_Api_PageRules_PageRules extends Mage_Core_Model_Abstract {

		public function create ( $target, $actions, $status = true ) {
			foreach ( $actions as $index => $action ) {
				if ( $action ["id"] == "browser_cache_ttl" ) $actions [ $index ] ["value"] = intval ( $action ["value"] );
				if ( $action ["id"] == "edge_cache_ttl" ) $actions [ $index ] ["value"] = intval ( $action ["value"] );
			}
			$zoneId = Mage::getModel ("cloudflare/api_overview_configuration")->getZoneId ();
			$endpoint = sprintf ( "zones/%s/pagerules", $zoneId );
			$api = Mage::getModel ("cloudflare/api_request");
			$api->setType ( $api::REQUEST_POST );
			$api->setData ( array (
				"targets" => array (
					array (
						"target" => "url",
						"constraint" => array (
							"operator" => "matches",
							"value" => $target
						)
					)
				),
				"actions" => $actions,
				"priority" => 1,
				"status" => $status === true ? "active" : "disabled"
			));
			return $api->resolve ( $endpoint );
		}

	}
