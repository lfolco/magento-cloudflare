<?php

	/**
	 * This model is used to simplify getting and setting a Cloudflare setting
	 * though their API. This class inherits from the Getter class that handles
	 * the getting of the setting. This class implements the setting part. All
	 * setters have a data type that the passed value is cast to. This is set
	 * using class data members.
	 * @version     1.0.0
	 * @package     JetRails® Cloudflare
	 * @author      Rafael Grigorian <development@jetrails.com>
	 * @copyright   © 2018 JETRAILS, All rights reserved
	 */
	class JetRails_Cloudflare_Model_Adminhtml_Api_Setter
	extends JetRails_Cloudflare_Model_Adminhtml_Api_Getter {

		/**
		 * These class constants serve as an enum values for the type that is
		 * associated with with the value that is passed to this model.
		 */
		const TYPE_BOOLEAN = 0;
		const TYPE_SWITCH  = 1;
		const TYPE_INTEGER = 2;
		const TYPE_STRING  = 3;

		/**
		 * @var     string       _dataKey             The key name for val obj
		 * @var     integer      _settingType         Enum value that is chosen
		 */
		protected $_dataKey = "value";
		protected $_settingType = self::TYPE_STRING;

		/**
		 * This method takes in a value that can be of mixed type and it casts
		 * said value based on the set enum type that is set internally within
		 * the instance.
		 * @param   mixed        value                The value to cast
		 * @return  mixed                             Cast value based on enum
		 */
		protected function _castValue ( $value ) {
			switch ( $this->_settingType ) {
				case self::TYPE_BOOLEAN: return $value == "true" ? true : false;
				case self::TYPE_SWITCH:  return $value ? "on" : "off";
				case self::TYPE_INTEGER: return intval ( $value );
				case self::TYPE_STRING:  return "$value";
				default:                 return "";
			}
		}

		/**
		 * This method takes in a value of mixed type and based on the setting
		 * type, that value is cast and sent though the Cloudflare API to be
		 * changed.
		 * @param   mixed        value                Value to pass to setting
		 */
		public function setValue ( $value ) {
			$value = $this->_castValue ( $value );
			$zoneId = Mage::getSingleton ("cloudflare/api_overview_configuration")->getZoneId ();
			$endpoint = sprintf ( "zones/%s/%s", $zoneId, $this->_endpoint );
			$api = Mage::getModel ("cloudflare/api_request");
			$api->setType ( $api::REQUEST_PATCH );
			$api->setData ( array ( "$this->_dataKey" => $value ) );
			return $api->resolve ( $endpoint );
		}

	}