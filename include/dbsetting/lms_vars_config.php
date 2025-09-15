<?php
//----------------------------------------------------
	error_reporting(0);
	ob_start();
	ob_clean();
//----------------------------------------------------
	date_default_timezone_set("Asia/Karachi");

	define('LMS_HOSTNAME'			, 'localhost');
	define('LMS_NAME'				, 'jo370xfr_apportion23');
	define('LMS_USERNAME'			, 'root');
	define('LMS_USERPASS'			, '');

	// define('LMS_HOSTNAME'			, 'localhost');
	// define('LMS_NAME'				, 'jo370xfr_apportion23');
	// define('LMS_USERNAME'			, 'jo370xfr_arforgpk');
	// define('LMS_USERPASS'			, 'z4BDMLR}GKX#');
	

///-----------------DB Tables ------------------------
	define('ADMINS'					, 'app_admins');
	define('ADMIN_ROLES'			, 'app_admins_roles');
	define('LOGS'					, 'app_logfile');
	define('LOGIN_HISTORY'			, 'app_login_history');
	define('CURRENCIES'				, 'app_currencies');
	define('REGIONS'				, 'app_regions');
	define('COUNTRIES'				, 'app_countries');
	define('STATES'				    , 'app_states');
	define('SUB_STATES'             , 'app_substates');
	define('CITIES'                 , 'app_cities');
	define('CATEGORIES'             , 'app_categories');
	define('SUB_CATEGORIES'         , 'app_sub_categories');
	define('FAQS'         			, 'app_faqs');
	define('DESIGNATIONS'         	, 'app_designations');
	define('TEAM_MEMBERS'         	, 'app_team_members');
	define('DONORS_VOLUNTREES'      , 'app_donors_volunteers');
	define('ORGANIZATIONS'          , 'app_organizations');
	define('PACKAGES_CAUSES'        , 'app_packages_causes');
	define('DISTRIBUTION_PLACES'    , 'app_distribution_places');
	define('GALLERY'    			, 'app_gallery');
	define('DONATIONS'    			, 'app_donations');

	define('SLIDER'    				, 'app_slider');
	define('ABOUT'					, 'app_about');
	define('TESTIMONIALS'			, 'app_testimonials');
	define('EVENTS'					, 'app_events');
	define('EVENT_PHOTOS'			, 'app_event_photos');
	define('GALLERY_PHOTOS'			, 'app_gallery_photos');
	define('NEWSLETTER'			    , 'app_newsletter');
	define('REPORTS_DOWNLOADS'		, 'app_reports_downloads');

//--------------------------------------------------
	$control 		= (isset($_REQUEST['control']) && $_REQUEST['control'] != '') ? $_REQUEST['control'] : '';
	$zone 	 		= (isset($_REQUEST['zone']) && $_REQUEST['zone'] != '') ? $_REQUEST['zone'] : '';
	$ip	  			= (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] != '') ? $_SERVER['REMOTE_ADDR'] : '';
	$do	  			= (isset($_REQUEST['do']) && $_REQUEST['do'] != '') ? $_REQUEST['do'] : '';
	$view 			= (isset($_REQUEST['view']) && $_REQUEST['view'] != '') ? $_REQUEST['view'] : '';
	$page			= (isset($_REQUEST['page']) && $_REQUEST['page'] != '') ? $_REQUEST['page'] : '';
	$current_page	= (isset($_REQUEST['page']) && $_REQUEST['page'] != '') ? $_REQUEST['page'] : 1;
	$Limit			= (isset($_REQUEST['Limit']) && $_REQUEST['Limit'] != '') ? $_REQUEST['Limit'] : '';
//--------------------------------------------------
define('TITLE_HEADER'		, 'Apportion Relief Foundation');
define("SITE_NAME"			, "Apportion Relief Foundation");
define("SITE_PHONE"			, "+32 60 87 78 29");
define("SITE_WHATSAPP"		, "+92 326 087 7829");
define("SITE_EMAIL"			, "apportionfoundation@gmail.com");
define("SITE_ADDRESS"		, "Signature plaza Civil defense road near bikes market, Township Lahore.");
define("SITE_BIO"			, "Empowering society, reducing dependency & improving lives");
define("SITE_URL"	    	, "https://portal.arf.org.pk/");
define('LMS_IP'				, $ip);
define('LMS_DO'				, $do);
define('LMS_EPOCH'			, date("U"));
define('LMS_VIEW'			, $view);
define("COPY_RIGHTS"		, "Green Professional Technologies");
define("COPY_RIGHTS_ORG"	, "Copyright &copy; ".date("Y")." - All Rights Reserved.");
define("COPY_RIGHTS_URL"	, "https://gptech.pk/");
//--------------------------------------------------