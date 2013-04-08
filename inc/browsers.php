<?php
/**
 * Browsers & Devices Check
 *
 * @package DW Page
 * @since DW Page 1.0
 */

$useragent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "";

/***************************************************************
* Function is_iphone
* Detect the iPhone
***************************************************************/

function is_iphone() {
	global $useragent;
	return(preg_match('/iphone/i',$useragent));
}

/***************************************************************
* Function is_ipad
* Detect the iPad
***************************************************************/

function is_ipad() {
	global $useragent;
	return(preg_match('/ipad/i',$useragent));
}

/***************************************************************
* Function is_ipad
* Detect the iPad
***************************************************************/

function is_kindle() {
	global $useragent;
	return(preg_match('/kindle/i',$useragent));
}

/***************************************************************
* Function nexus
* Detect the nexus
***************************************************************/

function is_nexus() {
	global $useragent;
	return(preg_match('/nexus/i',$useragent));
}



/***************************************************************
* Function is_ipod
* Detect the iPod, most likely the iPod touch
***************************************************************/

function is_ipod() {
	global $useragent;
	return(preg_match('/ipod/i',$useragent));
}

/***************************************************************
* Function is_android
* Detect an android device. They *SHOULD* all behave the same
***************************************************************/

function is_android() {
	global $useragent;
	return(preg_match('/android/i',$useragent));
}

/***************************************************************
* Function is_blackberry
* Detect a blackberry device 
***************************************************************/

function is_blackberry() {
	global $useragent;
	return(preg_match('/blackberry/i',$useragent));
}

/***************************************************************
* Function is_opera_mobile
* Detect both Opera Mini and hopfully Opera Mobile as well
***************************************************************/

function is_opera_mobile() {
	global $useragent;
	return(preg_match('/opera mini/i',$useragent));
}

/***************************************************************
* Function is_palm
* Detect a webOS device such as Pre and Pixi
***************************************************************/

function is_palm() {
	global $useragent;
	return(preg_match('/webOS/i', $useragent));
}

/***************************************************************
* Function is_symbian
* Detect a symbian device, most likely a nokia smartphone
***************************************************************/

function is_symbian() {
	global $useragent;
	return(preg_match('/Series60/i', $useragent) || preg_match('/Symbian/i', $useragent));
}

/***************************************************************
* Function is_windows_mobile
* Detect a windows smartphone
***************************************************************/

function is_windows_mobile() {
	global $useragent;
	return(preg_match('/WM5/i', $useragent) || preg_match('/WindowsMobile/i', $useragent) || preg_match('/Windows\sPhone/i', $useragent));
}

/***************************************************************
* Function is_lg
* Detect an LG phone
***************************************************************/

function is_lg() {
	global $useragent;
	return(preg_match('/LG/i', $useragent));
}

/***************************************************************
* Function is_motorola
* Detect a Motorola phone
***************************************************************/

function is_motorola() {
	global $useragent;
	return(preg_match('/\ Droid/i', $useragent) || preg_match('/XT720/i', $useragent) || preg_match('/MOT-/i', $useragent) || preg_match('/MIB/i', $useragent));
}

/***************************************************************
* Function is_nokia
* Detect a Nokia phone
***************************************************************/

function is_nokia() {
	global $useragent;
	return(preg_match('/Series60/i', $useragent) || preg_match('/Symbian/i', $useragent) || preg_match('/Nokia/i', $useragent));
}

/***************************************************************
* Function is_samsung
* Detect a Samsung phone
***************************************************************/

function is_samsung() {
	global $useragent;
	return(preg_match('/Samsung/i', $useragent));
}

/***************************************************************
* Function is_samsung_galaxy_tab
* Detect the Galaxy tab
***************************************************************/

function is_samsung_galaxy_tab() {
	global $useragent;
	return(preg_match('/SPH-P100/i', $useragent));
}

/***************************************************************
* Function is_sony_ericsson
* Detect a Sony Ericsson
***************************************************************/

function is_sony_ericsson() {
	global $useragent;
	return(preg_match('/SonyEricsson/i', $useragent));
}

/***************************************************************
* Function is_nintendo
* Detect a Nintendo DS or DSi
***************************************************************/

function is_nintendo() {
	global $useragent;
	return(preg_match('/Nintendo DSi/i', $useragent) || preg_match('/Nintendo DS/i', $useragent));
}

/***************************************************************
* Function is_handheld
* Wrapper function for detecting ANY handheld device
***************************************************************/

function is_handheld() {
	return(is_iphone() || is_ipad() || is_kindle() || is_ipod() || is_android() || is_blackberry() || is_opera_mobile() || is_palm() || is_symbian() || is_windows_mobile() || is_lg() || is_motorola() || is_nokia() || is_samsung() || is_samsung_galaxy_tab() || is_sony_ericsson() || is_nintendo());
}

/***************************************************************
* Function is_mobile
* Wrapper function for detecting ANY mobile phone device
***************************************************************/

function is_mobile() {
	if (is_tablet()) { return false; }  // this catches the problem where an Android device may also be a tablet device
	return(is_iphone() || is_ipod() || is_android() || is_blackberry() || is_opera_mobile() || is_palm() || is_symbian() || is_windows_mobile() || is_lg() || is_motorola() || is_nokia() || is_samsung() || is_sony_ericsson() || is_nintendo());
}

/***************************************************************
* Function is_ios
* Wrapper function for detecting ANY iOS/Apple device
***************************************************************/

function is_ios() {
	return(is_iphone() || is_ipad() || is_ipod());

}


/***************************************************************
* Function is_tablet
* Wrapper function for detecting tablet devices (needs work)
***************************************************************/

function is_tablet() {
	return(is_ipad() || is_samsung_galaxy_tab() || is_kindle() || is_nexus() );
}

function is_tablet_but_ipad(){
	return( is_samsung_galaxy_tab() || is_kindle() || is_nexus() );
}
/***************************************************************
* Function custom_body_class
* Add mobilie info to the body class if activated in settings
***************************************************************/
if (!is_admin()) {	
	add_filter('body_class','custom_body_class');
}

function custom_body_class($classes) {

	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome;

	// Top level
	if (is_handheld()) { $classes[] = "handheld"; };
	if (is_mobile()) { $classes[] = "mobile"; };
	if (is_ios()) { $classes[] = "ios"; };
	if (is_tablet()) { $classes[] = "tablet"; };

	// Specific 
	if (is_iphone()) { $classes[] = "iphone"; };
	if (is_ipad()) { $classes[] = "ipad"; };
	if (is_ipod()) { $classes[] = "ipod"; };
	if (is_android()) { $classes[] = "android"; };
	if (is_blackberry()) { $classes[] = "blackberry"; };
	if (is_opera_mobile()) { $classes[] = "opera-mobile";}
	if (is_palm()) { $classes[] = "palm";}
	if (is_symbian()) { $classes[] = "symbian";}
	if (is_windows_mobile()) { $classes[] = "windows-mobile"; }
	if (is_lg()) { $classes[] = "lg"; }
	if (is_motorola()) { $classes[] = "motorola"; }
	if (is_nokia()) { $classes[] = "nokia"; }
	if (is_samsung()) { $classes[] = "samsung"; }
	if (is_samsung_galaxy_tab()) { $classes[] = "samsung-galaxy-tab"; }
	if (is_sony_ericsson()) { $classes[] = "sony-ericsson"; }
	if (is_nintendo()) { $classes[] = "nintendo"; }
	
	// Computer browser
	if (!is_handheld()) { $classes[] = "desktop"; }
	if ($is_lynx) { $classes[] = "lynx"; }
	if ($is_gecko) { $classes[] = "gecko"; }
	if ($is_opera) { $classes[] = "opera"; }
	if ($is_NS4) { $classes[] = "ns4"; }
	if ($is_safari) { $classes[] = "safari"; }
	if ($is_chrome) { $classes[] = "chrome"; }
	if ($is_IE) { $classes[] = "ie"; }

	// IE Version check
	$ie_check = array();
	$ie_classes = array( 'ie7', 'ie8', 'ie9', 'ie10' );
	$version = 7;
	while ( $version < 11 ) {
		$ie_check[] = strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE ' . $version . '.' ) !== FALSE;
		++$version;
	}
	$ie = '';
	foreach ( $ie_check as $key => $value  ) {
		if ( $value == 1 ) {
			$ie = $ie_classes[$key] . ' oldie';
		}
	}
	$classes[] = $ie;

	// Check user logged in?
	if( ! is_user_logged_in() ) {
		$classes[] = 'not-login';
	}
	
	return $classes;
}
