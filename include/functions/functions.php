<?php
// LOGIN TYPES
function get_logintypes($id = '') {
	$listlogintypes = array (
								  '1'	=> 'headoffice'
								, '2'	=> 'accountant'
							);
	if(!empty($id)){
		return $listlogintypes[$id];
	}else{
		return $listlogintypes;
	}
}

// LOGIN FILE ACTION
function get_logfile($id = '') {

	$listlogfile = array (
							  '1' => 'Add'		 
							, '2' => 'Update'		 
							, '3' => 'Delete'		
							, '4' => 'Login'	
						 );
	if(!empty($id)){
		return $listlogfile[$id];
	}else{
		return $listlogfile;
	}
}

// ARRAY SEARCH
function arrayKeyValueSearch($array, $key, $value)
{
    $results = array();
    if (is_array($array)) {
        if (isset($array[$key]) && $array[$key] == $value) {
            $results[] = $array;
        }
        foreach ($array as $subArray) {
            $results = array_merge($results, arrayKeyValueSearch($subArray, $key, $value));
        }
    }
    return $results;
}

// GET CURRENT URL
function curPageURL() {
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
 	return $pageURL;
}

// PARENT REGION
function get_parentregiontypes($id = '') {
	$listparentregiontypes = array (
										  '1'	=> 'Parent Region 1'
										, '2'	=> 'Parent Region 2'
										, '3'	=> 'Parent Region 3'
										, '4'	=> 'Parent Region 4'
										, '5'	=> 'Parent Region 5'
										, '6'	=> 'Parent Region 6'
										, '7'	=> 'Parent Region 7'
								   );
	if(!empty($id)){
		return $listparentregiontypes[$id];
	}else{
		return $listparentregiontypes;
	}
}

// STATUS (ACTIVE & INACTIVE)
function get_status($id = '') {
	$liststatus= array (
						  '1' => 'Active' 
						, '2' => 'Inactive'
					   );
	if(!empty($id)){
		$liststatuslabel= array (
									  '1' => '<span class="badge bg-primary">Active</span>' 
									, '2' => '<span class="badge bg-danger">Inactive</span>'
								); 
		return $liststatuslabel[$id];
	}
	return $liststatus;
}

// CURRENCY POSITION
function get_currency_postition($id = '') {
	$list_currency_postitions= array (
										  '1' => 'Before'
										, '2' => 'After'
									);
	if(!empty($id)){
		$currencyPostionLabel= array (
										  '1' => '<span class="badge bg-primary">Before</span>' 
										, '2' => '<span class="badge bg-danger">After</span>'
									); 
		return $currencyPostionLabel[$id];
	}else{
		return $list_currency_postitions;
	}
}

// TIMEZONES
function get_timezonetypes($id = '') {
	$listtimezonetypes = array (
									 '1'	=> 'Asia'
									,'2'	=> 'USA'
									,'3'	=> 'UK'
								);
	if(!empty($id)){
		return $listtimezonetypes[$id];
	}else{
		return  $listtimezonetypes;
	}
}

// GENDERS
function get_gendertypes($id = '') {
	$gendertypes = array (
							 '1'	=> 'Male'
							,'2'	=> 'Female'
							,'3'	=> 'Others'
						);
	if(!empty($id)){
		return $gendertypes[$id];
	}else{
		return $gendertypes;
	}
}

// YES NO
function get_YesNoStatus($id = '') {
	$yesNoStatus = array (
							 '0'	=> 'NO'
							,'1'	=> 'Yes'
						 );
	if(!empty($id)){
		return $yesNoStatus[$id];
	}else{
		return $yesNoStatus;
	}
}

// DONATION TYPES
function get_DonationTypes($id = '') {
	$donationTypes = array (
								 '1'	=> 'Package'
								,'2'	=> 'Cause'
							);
	if(!empty($id)){
		return $donationTypes[$id];
	}else{
		return $donationTypes;
	}
}

// DONATION TYPES
function get_DurationTypes($id = '') {
	$durationTypes = array (
								 '1'	=> 'Day'
								,'2'	=> 'Month'
								,'3'	=> 'Year'
							);
	if(!empty($id)){
		return $durationTypes[$id];
	}else{
		return $durationTypes;
	}
}
// FILE TYPE
function get_FileTypes($id = '') {
	$fileTypes = array (
							 '1'	=> 'Image'
							,'2'	=> 'Video'
						 );
	if(!empty($id)){
		return $fileTypes[$id];
	}else{
		return $fileTypes;
	}
}



//--------------- Status ------------------
$admstatus = array (
						array('status_id'=>1, 'status_name'=>'Active'), 
						array('status_id'=>2, 'status_name'=>'Inactive')
				   );
$ad_status = array (
						array('status_id'=>1, 'status_name'=>'Active'), 
						array('status_id'=>2, 'status_name'=>'Inactive')
				   );

function get_admstatus($id) {
	$listadmstatus= array (
							'1' => '<span class="badge bg-success">Active</span>', 
							'2' => '<span class="label label-danger" id="bns-status-badge">Inactive</span>'
						  );
	return $listadmstatus[$id];
}




//Application Status 
$applicationstatus = array (
								array('id'=>1,  'name'=>'Approved'),
								array('id'=>2,  'name'=>'Not Approved'),
								array('id'=>3,  'name'=>'Pending')
							);
//Get Application Status
function get_applicationstatus($id) {
	$listapplicationstatus = array (
										'1'	=> '<span class="badge bg-success">Approved</span>',
										'2'	=> '<span class="badge bg-danger">Not Approved</span>',
										'3'	=> '<span class="badge bg-warning">Pending</span>'
								   );
	return $listapplicationstatus[$id];
}

//--------------- Salutation ------------------
$salutationtypes = array (
	array('id'=>1, 'name'=>'Mr.'),
	array('id'=>2, 'name'=>'Mrs.'),
	array('id'=>3, 'name'=>'Other')
);

function get_salutationtypes($id) {
	$listsalutationtypes = array (
		'1'	=> 'Mr.',
		'2'	=> 'Mrs.',
		'3'	=> 'Other'
	);
	return $listsalutationtypes[$id];
}


//--------------- Marital Status ------------------
$maritalstatustypes = array (
	array('id'=>1, 'name'=>'Single'),
	array('id'=>2, 'name'=>'Married'),
	array('id'=>3, 'name'=>'Widowed'),
	array('id'=>4, 'name'=>'Divorced')
);

function get_maritalstatustypes($id) {
	$listmaritalstatustypes = array (
		'1'	=> 'Single',
		'2'	=> 'Married',
		'3'	=> 'Widowed',
		'4'	=> 'Divorced'
	);
	return $listmaritalstatustypes[$id];
}

//--------------- Education ------------------
$educationtypes = array (
	array('id'=>1, 'name'=>'Below Matric'),
	array('id'=>2, 'name'=>'Matric'),
	array('id'=>3, 'name'=>'Intermediate'),
	array('id'=>4, 'name'=>'Graduation'),
	array('id'=>5, 'name'=>'Master'),
	array('id'=>6, 'name'=>'Phd')
);

function get_educationtypes($id) {
	$listeducationtypes = array (
		'1'	=> 'Below Matric',
		'2'	=> 'Matric',
		'3'	=> 'Intermediate',
		'4'	=> 'Graduation',
		'5'	=> 'Master',
		'6'	=> 'Phd'
	);
	return $listeducationtypes[$id];
}

//--------------- Job Status ------------------
$jobstatustypes = array (
	array('id'=>1, 'name'=>'Employed'),
	array('id'=>2, 'name'=>'Un Employed'),
	array('id'=>3, 'name'=>'Personal Business')
);

function get_jobstatustypes($id) {
	$listjobstatustypes = array (
		'1'	=> 'Employed',
		'2'	=> 'Un Employed',
		'3'	=> 'Personal Business'
	);
	return $listjobstatustypes[$id];
}

//--------------- Residence Status ------------------
$residencestatustypes = array (
	array('id'=>1, 'name'=>'Owned'),
	array('id'=>2, 'name'=>'Rented')
);

function get_residencestatustypes($id) {
	$listresidencestatustypes = array (
		'1'	=> 'Owned',
		'2'	=> 'Rented'
	);
	return $listresidencestatustypes[$id];
}

//--------------- Organization Types ------------------
$organizationtypes = array (
	array('id'=>1, 'name'=>'Private Ltd.'),
	array('id'=>2, 'name'=>'Govt. Employee')
);

function get_organizationtypes($id) {
	$listorganizationtypes = array (
		'1'	=> 'Private Ltd.',
		'2'	=> 'Govt. Employee'
	);
	return $listorganizationtypes[$id];
}

//--------------- Years of known ------------------
$knownyears = array (
						array('id'=>0, 'name'=>'Less Than Year'),
						array('id'=>1, 'name'=>'1 Year'),
						array('id'=>2, 'name'=>'2 Years'),
						array('id'=>3, 'name'=>'3 Years'),
						array('id'=>4, 'name'=>'4 Years'),
						array('id'=>5, 'name'=>'5 Years'),
						array('id'=>6, 'name'=>'6 Years'),
						array('id'=>7, 'name'=>'7 Years'),
						array('id'=>8, 'name'=>'8 Years'),
						array('id'=>9, 'name'=>'9 Years'),
						array('id'=>10, 'name'=>'10 Years'),
						array('id'=>11, 'name'=>'11 Years'),
						array('id'=>12, 'name'=>'12 Years'),
						array('id'=>13, 'name'=>'13 Years'),
						array('id'=>14, 'name'=>'14 Years'),
						array('id'=>15, 'name'=>'15 Years'),
						array('id'=>16, 'name'=>'16 Years'),
						array('id'=>17, 'name'=>'17 Years'),
						array('id'=>18, 'name'=>'18 Years'),
						array('id'=>19, 'name'=>'19 Years'),
						array('id'=>20, 'name'=>'20 Years'),
						array('id'=>21, 'name'=>'More Than 20 Years'),
					);

function get_knownyears($id) {
	$listknownyears = array (
								'0'		=> 'Less Than Year',
								'1'		=> '1 Year',
								'2'		=> '2 Years',
								'3'		=> '3 Years',
								'4'		=> '4 Years',
								'5'		=> '5 Years',
								'6'		=> '6 Years',
								'7'		=> '7 Years',
								'8'		=> '8 Years',
								'9'		=> '9 Years',
								'10'	=> '10 Years',
								'11'	=> '11 Years',
								'12'	=> '12 Years',
								'13'	=> '13 Years',
								'14'	=> '14 Years',
								'15'	=> '15 Years',
								'16'	=> '16 Years',
								'17'	=> '17 Years',
								'18'	=> '18 Years',
								'19'	=> '19 Years',
								'20'	=> '20 Years',
								'21'	=> 'More Than 20 Years'
							);
							return $listknownyears[$id];
}



//--------------- Payments Status ------------------
$payments = array (
						array('id'=>1, 'name'=>'Paid')		, 
						array('id'=>2, 'name'=>'Pending')	, 
						array('id'=>3, 'name'=>'Unpaid')
				   );

function get_payments($id) {
	$listpayments = array (
							'1' => '<span class="badge bg-success">Paid</span>'		, 
							'2' => '<span class="badge bg-warning">Pending</span>'	,
							'3' => '<span class="badge bg-danger">Unpaid</span>'
						  );
	return $listpayments[$id];
}


//--------------- Admins Rights ----------
$admtypes = array (
	array('id'=>1, 'name'=>'Super Admin'),
	array('id'=>2, 'name'=>'Administrator'),
	array('id'=>3, 'name'=>'Simple')
   );

function get_admtypes($id) {
$listadmrights = array (
			'1'	=> 'Super Admin',
			'2'	=> 'Administrator',
			'3'	=> 'Simple'
			);
return $listadmrights[$id];
}

//--------------- Item Types ----------
$itemtype = array (
					array('id'=>1, 'name'=>'Book')		,
					array('id'=>2, 'name'=>'Work Book')	,
					array('id'=>3, 'name'=>'Note Book')	,
					array('id'=>4, 'name'=>'Uniforms')
				   );

function get_itemtypes($id) {
	$listitem = array (
							'1'	=> 'Book'		,
							'2'	=> 'Work Book'	,
							'3'	=> 'Note Book'	,
							'4'	=> 'Uniforms'
							);
	return $listitem[$id];
}



//--------------- Ordders Status ----------
$orders = array (
					array('id'=>1, 'name'=>'Save & Hold')		,
					array('id'=>2, 'name'=>'Pending')			,
					array('id'=>3, 'name'=>'In-Progress')		,
					array('id'=>4, 'name'=>'Dispatched')		,
					array('id'=>5, 'name'=>'Cancel')
				   );

function get_orders($id) {
	$listorders = array (
							'1'	=> '<span class="label bg-warning-dark" id="bns-status-badge"> Save & Hold</span>'	,
							'2'	=> '<span class="label bg-orange" id="bns-status-badge">Pending</span>'				,
							'3'	=> '<span class="label bg-info-dark" id="bns-status-badge">In-Progress</span>'		,
							'4'	=> '<span class="label bg-success-dark" id="bns-status-badge">Dispatched</span>'	,
							'5'	=> '<span class="label bg-danger" id="bns-status-badge">Cancel</span>'
							);
	return $listorders[$id];
}



//--------------- Ordders Status ----------
$saletypes = array (
					array('id'=>1, 'name'=>'Pending')			,
					array('id'=>2, 'name'=>'Save & Hold')		,
					array('id'=>3, 'name'=>'Confirmed')			,
					array('id'=>4, 'name'=>'Dispatched')		,
					array('id'=>5, 'name'=>'Completed')			,
					array('id'=>6, 'name'=>'Cancel')
				   );

function get_saletypes($id) {
	$list = array (
							'1'	=> '<span class="label label-warning" id="bns-status-badge">Pending</span>'		,
							'2'	=> '<span class="label label-danger" id="bns-status-badge">Save & Hold</span>'	,
							'3'	=> '<span class="label label-success" id="bns-status-badge">Confirmed</span>' 	,
							'4'	=> '<span class="label label-info" id="bns-status-badge">Dispatched</span>'		,
							'5'	=> '<span class="label bg-primary-dark" id="bns-status-badge">Completed</span>'	,
							'6'	=> '<span class="label label-danger" id="bns-status-badge">Cancel</span>'
				);
	return $list[$id];
}


//--------------- Ordders Item Status ----------
$ordersitem = array (
					array('id'=>1, 'name'=>'Dispatched')		,
					array('id'=>2, 'name'=>'Pending')			,
					array('id'=>3, 'name'=>'Cancel')
				   );

function get_ordersitem($id) {
	$listordersitem = array (
							'1'	=> 'Dispatched'				,
							'2'	=> 'Pending'				,
							'3'	=> 'Cancel'		
							);
	return $listordersitem[$id];
}

//--------------- Status Yes No ----------
$statusyesno = array (
						array('id'=>1, 'name'=>'Yes') 
						,array('id'=>0, 'name'=>'No')
				   );

function get_statusyesno($id) {
	
	$liststatusyesno = array (
								'1'	=> 'Yes',	'0'	=> 'No'
							 );
	return $liststatusyesno[$id];
}

//--------------- CHALLAN HEADS ----------
$challanHeads = array (
						array('id'=>1, 'name'=>'Security Amount / Down Payment')
						,array('id'=>2, 'name'=>'Principal Amount')
						,array('id'=>3, 'name'=>'Service Charges')
						,array('id'=>4, 'name'=>'Late Payment Charges')
						,array('id'=>5, 'name'=>'Application Charges')
						,array('id'=>6, 'name'=>'Processing Fee')
						,array('id'=>7, 'name'=>'Registeration Charges')
						,array('id'=>8, 'name'=>'Legal & Professional Charges')
						,array('id'=>9, 'name'=>'Other Charges')
					  );

function get_challanHead($id) {
	$challanHeads = array (
							'1'		=> 'Security Amount / Down Payment'
							,'2'	=> 'Principal Amount'
							,'3'	=> 'Service Charges'		
							,'4'	=> 'Late Payment Charges'		
							,'5'	=> 'Application Charges'		
							,'6'	=> 'Processing Fee'		
							,'7'	=> 'Registeration Charges'		
							,'8'	=> 'Legal & Professional Charges'		
							,'9'	=> 'Other Charges'		
						  );
	return $challanHeads[$id];
}

//--------------- Months Keywords ----------
$monthTypes = array (
						array('id'=>'01', 'name'=>'January'),
						array('id'=>'02', 'name'=>'February'),
						array('id'=>'03', 'name'=>'March'),
						array('id'=>'04', 'name'=>'April'),
						array('id'=>'05', 'name'=>'May'),
						array('id'=>'06', 'name'=>'June'),
						array('id'=>'07', 'name'=>'July'),
						array('id'=>'08', 'name'=>'August'),
						array('id'=>'09', 'name'=>'September'),
						array('id'=>'10', 'name'=>'October'),
						array('id'=>'11', 'name'=>'November'),
						array('id'=>'12', 'name'=>'December'),
					);
//--------------- Get Month ----------
function get_month($id) {
	$months = array (
						'01'		=> 'January',
						'02'		=> 'February',
						'03'		=> 'March',
						'04'		=> 'April',
						'05'		=> 'May',
						'06'		=> 'June',
						'07'		=> 'July',
						'08'		=> 'August',
						'09'		=> 'September',
						'10'	=> 'October',
						'11'	=> 'November',
						'12'	=> 'December',
					);
	return $months[$id];
}

function cleanvars($str){ 
	$str = trim($str);
	return is_array($str) ? array_map('cleanvars', $str) : str_replace("\\", "\\\\", htmlspecialchars((stripslashes($str)), ENT_QUOTES)); 
}

function to_seo_url($str){
   // if($str !== mb_convert_encoding( mb_convert_encoding($str, 'UTF-32', 'UTF-8'), 'UTF-8', 'UTF-32') )
      //  $str = mb_convert_encoding($str, 'UTF-8', mb_detect_encoding($str));
    $str = htmlentities($str, ENT_NOQUOTES, 'UTF-8');
    $str = preg_replace('`&([a-z]{1,2})(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', '\1', $str);
    $str = html_entity_decode($str, ENT_NOQUOTES, 'UTF-8');
    $str = preg_replace(array('`[^a-z0-9]`i','`[-]+`'), '-', $str);
    $str = trim($str, '-');
	$str = strtolower($str);
    return $str;
}

// roletypes
$roletypes = array (
						array('id'=>1,  'name'=>'Sales')			, 
						array('id'=>2,  'name'=>'Purchase')			,
						array('id'=>3,  'name'=>'Vendors')			,
						array('id'=>4,  'name'=>'Payments')			,
						array('id'=>5,  'name'=>'Customers')		,
						array('id'=>6,  'name'=>'Items')			,
						array('id'=>7,  'name'=>'Ledgers')			,
						array('id'=>9,  'name'=>'Reporting')		,
						array('id'=>8,  'name'=>'Setting')			
						
				   );

function get_roletypes($id) {

	$listroletypes = array (
							'1'  => 'Sales'			,
							'2'  => 'Purchase'		,
							'3'  => 'Vendors'		,
							'4'  => 'Payments'		,
							'5'  => 'Customers'		,
							'6'  => 'Items'			,
							'7'  => 'Ledgers'		,
							'8'  => 'Setting'		,
							'9'  => 'Reporting'		
							
						  );
	return $listroletypes[$id];

}


function nice_number($n) {
	// first strip any formatting;
	$n = (0+str_replace(",", "", $n));

	// is this a number?
	if (!is_numeric($n)) return false;

	// now filter it;
	if ($n > 1000000000000) return round(($n/1000000000000), 4).' T';
	elseif ($n > 1000000000) return round(($n/1000000000), 4).' B';
	elseif ($n > 1000000) return round(($n/1000000), 4).' M';
	elseif ($n > 1000) return round(($n/1000), 4).' K';

	return number_format($n);
}

//Rupees in Word
function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}

$days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');

//Time Format
function get_hours_range( $start = 0, $end = 86400, $step = 1800, $format = 'g:i a' ) {
        $times = array();
        foreach ( range( $start, $end, $step ) as $timestamp ) {
                $hour_mins = gmdate( 'H:i', $timestamp );
                if ( ! empty( $format ) )
                        $times[$hour_mins] = gmdate( $format, $timestamp );
                else $times[$hour_mins] = $hour_mins;
        }
        return $times;
}

function searchArrayKeyVal($sKey, $id, $array) {
	foreach ($array as $key => $val) {
		if ($val[$sKey] == $id) {
			return $key;
		}
	}
	return null;
}

function welcome($H){
 
   if($H < 12){
 
     return "Good Morning";
 
   }elseif($H > 11 && $H < 18){
 
     return "Good Afternoon";
 
   }elseif($H > 17){
 
     return "Good Evening";
 
   }
 
}
// DONATION STEPS
function get_DonationSteps($id = '') {
	$DonationSteps = array (
								 'Step 1'	=> 'Open your any banking mobile app.'
								,'Step 2'	=> 'Select "FUND TRANSFER"'
								,'Step 3'	=> 'Select FINJA BUSINESS'
								,'Step 4'	=> 'Send your donation to Alfalah BANK ACT #: 5001814188 IBAN No: PK72ALFH5510005001814188'
								,'Step 5'	=> 'Enter Amount that you want to donate to Apportion Relief Foundation'
								,'Step 6'	=> 'Press "PROCEED" and pay'
								,'Note'		=> 'You can also donate from Mobile wallet (Easypaisa & Jazz Cash)'
							);
	if(!empty($id)){
		return $DonationSteps[$id];
	}else{
		return $DonationSteps;
	}
}
$TEAM = array(
                 array( 'name' => 'Rizwan Rauf'                     , 'designation' => 'CEO'                                        , 'img' => 'rizwan_rauf.png')
                ,array( 'name' => 'Syed Tanweer Abbas Tabish'       , 'designation' => 'Country Head'                               , 'img' => 'tabish_sb.png')
                ,array( 'name' => 'Farhan Javed'                    , 'designation' => 'General Manager Project and Operations'     , 'img' => 'farhan_javed.png')
                ,array( 'name' => 'Qasim Ali Khan'                  , 'designation' => 'Director'                                   , 'img' => 'qasim_khan.png')
                ,array( 'name' => 'Amjid Ali'                       , 'designation' => 'Director'                                   , 'img' => 'amjad.png')
                ,array( 'name' => 'Rana Waseem Anjum'               , 'designation' => 'Project Coordinator'                        , 'img' => 'rana_waseem.png')
                ,array( 'name' => 'Aftab Qadri'                     , 'designation' => 'Lead External Relations & PR'               , 'img' => 'aftab_qadri.png')
                ,array( 'name' => 'Major Sulman'                    , 'designation' => 'Fund Raising'                               , 'img' => 'major_salman.png')
                ,array( 'name' => 'Muhib Hassan Pairzada'           , 'designation' => 'Fund Raising'                               , 'img' => 'mohib_hassan_pairzada.jpg')
                ,array( 'name' => 'Zohaib'                          , 'designation' => 'Fund Raising'                               , 'img' => 'zohaib.png')
                ,array( 'name' => 'Asghar Ali'                      , 'designation' => 'Volunteer'                                  , 'img' => 'asghar_ali.png')
                ,array( 'name' => 'Azam Virk'                       , 'designation' => 'Volunteer'                                  , 'img' => 'azam_virk.png')
                ,array( 'name' => 'Ali Raza'                        , 'designation' => 'Volunteer'                                  , 'img' => 'ali_raza.png')
                ,array( 'name' => 'Raza Malik'                      , 'designation' => 'Volunteer'                                  , 'img' => 'raza_malik.png')
                ,array( 'name' => 'Talha Rriaz'                     , 'designation' => 'Volunteer'                                  , 'img' => 'talha_raiz.png')
);
function get_report_type($id = '') {
	$listreport_type = array (
								  '1'	=> 'Reports'
								, '2'	=> 'Downloads'
							);
	if(!empty($id)){
		return $listreport_type[$id];
	}else{
		return $listreport_type;
	}
}