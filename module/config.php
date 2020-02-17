<?php
/*
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * This work is licensed under a Creative Commons Attribution 4.0 International Public License.
 *      http://creativecommons.org/licenses/by/4.0/
 *
 * This file is important, but should be used with caution
*/

namespace dvc\module;

abstract class config extends \config {

	/**
	 * Don't set global things here, set things specifc to the module
	 * Don't set these:
	 * 	static $DATE_FORMAT = 'd/m/Y';
	 * 	static $DB_TYPE = 'sqlite';
	 *
	 * static $TIMEZONE = 'Australia/Brisbane';
	 *
	 */

	const module_db_version = 0.01;
	static protected $_MODULE_VERSION = 0;

	static function module_checkdatabase() {
		if ( self::module_version() < self::module_db_version) {
			config::module_version( self::module_db_version);

			$dao = new dao\dbinfo;
			$dao->dump( $verbose = false);

		}

	}

	static function module_config() {
		return implode([
			rtrim( self::dataPath(), '/ '),
			DIRECTORY_SEPARATOR,
			'module.json',

		]);

	}

	static function module_init() {
		if ( file_exists( $config = self::module_config())) {
			$j = json_decode( file_get_contents( $config));

			if ( isset( $j->module_version)) {
				self::$_MODULE_VERSION = (float)$j->module_version;

			};

		}

	}

	static protected function module_version( $set = null) {
		$ret = self::$_MODULE_VERSION;

		if ( (float)$set) {
			$config = self::module_config();

			$j = file_exists( $config) ?
				json_decode( file_get_contents( $config)):
				(object)[];

			self::$_MODULE_VERSION = $j->module_version = $set;

			file_put_contents( $config, json_encode( $j, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));

		}

		return $ret;

	}

}

config::module_init();
