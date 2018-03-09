<?php

	class JetRails_Cloudflare_Api_Caching_PurgeCacheController extends JetRails_Cloudflare_Controller_ApiAction {

		function everythingAction () {
			$api = Mage::getModel ("cloudflare/api_caching_purgecache");
			$response = $api->purgeEverything ();
			if ( $response->success ) $response->messages = [
				"Successfully purged all assets. Please allow up to 30 seconds for changes to take effect."
			];
			return $this->_formatAndSend ( $response );
		}

		function individualAction () {
			$api = Mage::getModel ("cloudflare/api_caching_purgecache");
			$response = $api->purgeIndividual ( $this->_request->getParam ("files") );
			if ( $response->success ) $response->messages = [
				"Successfully purged all assets. Please allow up to 30 seconds for changes to take effect."
			];
			return $this->_formatAndSend ( $response );
		}

	}