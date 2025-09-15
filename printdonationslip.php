<?php
    require_once("include/dbsetting/lms_vars_config.php");
	require_once("include/dbsetting/classdbconection.php");
	require_once("include/functions/functions.php");
	$dblms = new dblms();
	require_once("include/functions/login_func.php");
	checkCpanelLMSALogin();
    if(isset($_GET['id']) && !empty($_GET['id'])){
        // GET DATA
        $condition = array ( 
            'select' 	=> ''.DONATIONS.'.id, '.DONATIONS.'.status, '.DONATIONS.'.id_type, '.DONATIONS.'.dated, '.DONATIONS.'.fullname, '.DONATIONS.'.cnic, '.DONATIONS.'.phone, '.DONATIONS.'.email, '.DONATIONS.'.referrals, '.DONATIONS.'.amount, '.SUB_CATEGORIES.'.subcat_name, '.PACKAGES_CAUSES.'.pc_title',
            'join' 		=> 'LEFT JOIN '.SUB_CATEGORIES.' ON '.SUB_CATEGORIES.'.subcat_id = '.DONATIONS.'.id_pc_subcat
                            LEFT JOIN '.PACKAGES_CAUSES.' ON '.PACKAGES_CAUSES.'.pc_id = '.DONATIONS.'.id_pc_subcat',
            'where' 	=> array( 
                                ''.DONATIONS.'.is_deleted'  => 0 ,
                                ''.DONATIONS.'.id'          => $_GET['id'] ,
                            ), 
            'order_by' 		=> ''.DONATIONS.'.id  DESC',
            'return_type' 	=> 'single' 
        ); 
        $donation = $dblms->getRows(DONATIONS, $condition);

        echo '
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <title>Donation | Slip</title>
                <!-- meta tags -->
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta name="author" content="irstheme">
                <!-- links tags -->
                <style>
                    .b-b {
                        border-bottom: 1px solid #000;
                        text-align:center;
                    }
                    body {			
                        font-family: "Times New Roman", Times, serif;
                    }
                    td{
                        line-height:18px;
                    }
                    th{
                        line-height:18px;
                    }
                </style>
            </head>
            <body>
                <!-- <table width="960" align="center">
                    <tr>
                        <td>
                            <img height="50" width="960" src="assets/images/brand/6.png">
                        </td>
                    </tr>
                </table> -->
                <table width="960" align="center">
                    <thead>
                        <tr>
                            <td width="600">
                                <img style="width: 450px;" src="assets/images/brand/5.png">     
                            </td>
                            <td>
                                <b>
                                    <br>'.SITE_ADDRESS.'<br>'. SITE_PHONE.'<br> E-mail: '.SITE_EMAIL.'<br>'.SITE_URL.'
                                <b>
                            </td>
                        </tr>
                    </thead>
                </table>
                <table width="960" align="center" style="text-align: left;margin-top: 30px;" >
                    <thead>
                        <tr>
                            <th width="105">RECEIPT NO:</th>
                            <th class="b-b" width="250">10001'.$donation['id'].'</th>
                            <th width="85">BOOK NO:</th>
                            <th class="b-b" width="250">00'.$donation['id'].'</th>
                            <th width="10">DATE:</th>
                            <th class="b-b">'.date('d M, Y', strtotime($donation['dated'])).'</th>
                        </tr>
                    </thead>
                </table>
                <table width="960" align="center" style="text-align: left; margin-top: 18px;">
                    <thead>
                        <tr>
                            <th width="40">NAME:</th>
                            <th class="b-b">'.$donation['fullname'].'</th>
                        </tr>
                    </thead>
                </table>
                <table width="960" align="center" style="text-align: left; margin-top: 18px;">
                    <thead>
                        <tr>
                            <th width="100">Donor CNIC:</th>
                            <th class="b-b" width="250">'.$donation['cnic'].'</th>
                            <th width="80">Phone NO:</th>
                            <th class="b-b" width="230">'.$donation['phone'].'</th>
                            <th width="55">E-mail:</th>
                            <th class="b-b">'.$donation['email'].'</th>
                        </tr>
                    </thead>
                </table>
                <table width="960" align="center" style="text-align: left; margin-top: 18px;">
                    <thead>
                        <tr>
                            <th width="40">Referral:</th>
                            <th class="b-b">'.$donation['referrals'].'</th>
                        </tr>
                    </thead>
                </table>    
                <table width="960" align="center" style="text-align: left; margin-top: 18px;">
                    <thead>
                        <tr>
                            <th width="145">AMOUNT (in digit):</th>
                            <th class="b-b">'.number_format($donation['amount']).'</th>
                        </tr>
                    </thead>
                </table>    
                <table width="960" align="center" style="text-align: left; margin-top: 18px;">
                    <thead>
                        <tr>
                            <th width="155">AMOUNT (in words):</th>
                            <th class="b-b">'.ucwords(convert_number_to_words($donation['amount'])).', Rupees Only</th>
                        </tr>
                    </thead>
                </table>    
                <table width="960" align="center" style="text-align: left; margin-top: 18px;">
                    <thead>
                        <tr>
                            <th width="250">CASH/VIA CHEQUE/ DRAFT NO:</th>
                            <th class="b-b" width="450"></th>
                            <th width="40">DATE:</th>
                            <th class="b-b">'.date('d M, Y', strtotime($donation['dated'])).'</th>
                        </tr>
                    </thead>
                </table>    
                <table width="960" align="center" style="text-align: left; margin-top: 18px;">
                    <thead>
                        <tr>
                            <th width="60">PURPOSE:</th>
                            <th class="b-b" width="650">'.($donation['id_type'] == '3' ? $donation['subcat_name'] : $donation['pc_title']).'</th>
                            <th class="b-b" >RECEIVED WITH THANKS</th>
                        </tr>
                    </thead>
                </table>    
                <table width="960" align="center" style="text-align: left; margin-top: 18px;">
                    <thead>
                        <tr>
                            <th width="165">ACCOUNTANT SIGN:</th>
                            <th class="b-b" width="315"></th>
                            <th width="125">CASHIER SIGN:</th>
                            <th class="b-b"></th>
                        </tr>
                    </thead>
                </table>    
            </body>
        </html>
        <script type="text/javascript" language="javascript1.2">
            //Do print the page
            if (typeof(window.print) != "undefined") {
                window.print();
            }
        </script>';
    }else{
        header("Location: dashboard.php");
    }
?>