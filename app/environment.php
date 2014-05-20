<?php
	
	/**
	 * --------------------------------
	 * APPLICATION ENVIRONMENT SETTINGS
	 * --------------------------------
	 */
	
	defined('SYSTEM_STARTED') or die('You are not permitted to access this resource.');
	
	/**
	 * Set the locale to a standard locale string.
	 * 
	 * List of valid locales can be found at:
	 * http://www.loc.gov/standards/iso639-2/php/code_list.php
	 * 
	 * Default is 0 (current locale).
	 */
	$env_locale					 = 'en_EN';
	
	/**
	 * Set the timezone to a standard timezone string.
	 * 
	 * List of valid timezones can be found at:
	 * http://www.php.net/manual/en/timezones.php
	 */
	$env_time_zone				 = 'Asia/Kolkata';
	
	/**
	 * Sets the mode of operation of this app.
	 * 
	 * If the app is in production phase,set to true.
	 * If in development phase, set to false.
	 */
	$env_production_mode 		 = false;
	
	/**
	 * Set the base URI of the app.
	 * 
	 * By default this is set to /. 
	 * However, if your app resides in a sub-directory of 
	 * your domain, then you must change this value to the 
	 * appropriate name of the sub-directory.
	 */
	$env_base_uri 				 = 'http://localhost/researchers/';
	
	/**
	 * Set the type of CDN to be used by your app.
	 * 
	 * The valid types are:
	 * 1. legacy
	 * 2. proxy
	 * 3. cloudstore
	 */
	$cdn_type 				 = 'legacy';
	
	/**
	 * Set the domain suffix for the proxy CDN used.
	 * 
	 * eg: .nyud.net
	 */
	$cdn_proxy_domain_suffix = '.nyud.net';
	
	/**
	 * Set the base URL of your CDN domain.
	 * 
	 * eg: http://myapp.akamai.net/
	 */
	$cdn_legacy_base_url     = '';
	
	/**
	 * Set the base URL for the cloud store account.
	 * 
	 * eg: https://dl.dropboxusercontent.com/u/21414141241/
	 */
	$cdn_cloud_base_url      = '';

?>
