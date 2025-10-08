<?php
require_once("include/dbsetting/lms_vars_config.php");
require_once("include/dbsetting/classdbconection.php");
require_once("include/functions/functions.php");
$dblms = new dblms();
require_once("include/functions/login_func.php");
checkCpanelLMSALogin();
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // GET DATA
    $condition = array(
        'select'     => 'dv.dv_full_name, dv.dv_cnic, dv.dv_email, dv.dv_phone, d.is_by_portal, d.id, d.status, d.id_type, d.dated, d.fullname, d.cnic, d.phone, d.email, d.referrals, d.amount, ' . SUB_CATEGORIES . '.subcat_name, ' . PACKAGES_CAUSES . '.pc_title',
        'join'         => 'LEFT JOIN ' . SUB_CATEGORIES . ' ON ' . SUB_CATEGORIES . '.subcat_id = d.id_pc_subcat
                            LEFT JOIN ' . PACKAGES_CAUSES . ' ON ' . PACKAGES_CAUSES . '.pc_id = d.id_pc_subcat
                            LEFT JOIN ' . DONORS_VOLUNTREES . ' dv ON dv.dv_id = d.id_donor
                            ',
        'where'     => array(
            'd.is_deleted'  => 0,
            'd.id'          => $_GET['id'],
        ),
        'order_by'         => 'd.id  DESC',
        'return_type'     => 'single'
    );
    $donation = $dblms->getRows(DONATIONS . ' d', $condition);
    // echo '<pre>'; print_r($donation); exit;

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
                    body {
                        font-family: Arial, sans-serif;
                        font-size: 12px;
                        background: #f8f9fa;
                        color: #e46a0c;
                    }
                    .receipt {
                        max-width: 800px;
                        margin: 10px auto;
                        border: 2px solid #e46a0c;
                        padding: 10px;
                        background: #fff;
                        border-collapse: collapse;
                    }
                    .receipt th, .receipt td {
                        border: 1px solid #e46a0c;
                        padding: 6px 10px;
                        vertical-align: middle;
                    }
                    .no-border td {
                        border: none;
                    }
                    .center {
                        text-align: center;
                    }
                    .text-orange {color: #e46a0c;}
                </style>
            </head>
            <body>

              <table class="receipt" width="100%">
                <!-- Header Row -->
                <tr class="no-border">
                  <td colspan="4">
                    <div style="display:flex; justify-content:space-between; align-items:center;">

                      <!-- Left side: logo + Apportion text -->
                      <div style="display:flex; align-items:center;">
                          <img src="'.SITE_URL.'assets/images/brand/5.png" style="width:350px; margin-right:8px; height: 80px ;width: 150px;">
                          <span style="font-size:25px; font-weight:bold; color:#e65208; margin-top:30px; display:inline-block;">
                            APPORATION RELIEF FOUNDATION
                          </span>
                      </div>

                      <!-- Right side: RELIEF FOUNDATION + Date & Receipt No -->
                      <div style="text-align:right; font-weight:bold; color:#e76f34;">
                        <br>
                        <span style="font-weight:normal; color:#e65208;">
                          <p style="color: #e65208; margin-top: 0%; font-size:small;">RECEIPT COPY</p>
                          <b>Date:</b> '.date('d M, Y', strtotime($donation['dated'])).'<br>
                          <b>Receipt No:</b> 10001'.$donation['id'].'
                        </span>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td colspan="4" class="center">
                    <strong>---------------- Donation Receipt ----------------</strong>
                  </td>
                </tr>

                <!-- Name/CNIC -->
                <tr>
                  <td width="25%"><b>Name</b></td>
                  <td width="25%">'.($donation['is_by_portal'] == 1 ? $donation['dv_full_name'] : $donation['fullname']).'</td>
                  <td width="25%"><b>CNIC No.</b></td>
                  <td width="25%">'.($donation['is_by_portal'] == 1 ? $donation['dv_cnic'] : $donation['cnic']).'</td>
                </tr>

                <!-- Contact/Email -->
                <tr>
                  <td><b>Contact No.</b></td>
                  <td>'.($donation['is_by_portal'] == 1 ? $donation['dv_phone'] : $donation['phone']).'</td>
                  <td><b>Email Address</b></td>
                  <td>'.($donation['is_by_portal'] == 1 ? $donation['dv_email'] : $donation['email']).'</td>
                </tr>

                <!-- Address/Occupation -->
                <tr>
                  <td width="25%"><b>Address</b></td>
                  <td width="25%"></td>
                  <td width="25%"><b>Occupation</b></td>
                  <td width="25%"></td>
                </tr>

                <!-- Purpose -->
                <tr>
                  <td><b>Purpose</b></td>
                  <td colspan="3">'.($donation['id_type'] == '3' ? $donation['subcat_name'] : $donation['pc_title']).'</td>
                </tr>

                <!-- Mode of Payment Heading -->
                <tr>
                  <td colspan="4" class="text-orange"><b>Mode of Payment</b></td>
                </tr>

                <!-- Cash -->
                <tr>
                  <td><input type="checkbox"> Cash</td>
                  <td colspan="3"></td>
                </tr>

                <!-- Bank -->
                <tr>
                  <td><input type="checkbox"> Bank</td>
                  <td><b>Bank Name: </b></td>
                  <td colspan="3"><b>Transaction ID/Slip No:</b>  </td>
                </tr>

                <!-- Cheque -->
                <tr>
                  <td><input type="checkbox"> Cheque</td>
                  <td><b>Cheque No:</b> </td>
                  <td colspan="2"><b>Description:</b> Deposit</td>
                </tr>

                <!-- In-Kind -->
                <tr>
                  <td><input type="checkbox"> In-Kind</td>
                  <td><b>Estimated Value (PKR)</b>: </td>
                  <td><b>Description:</b> </td>
                  <td>
                    <label><b>
                      <input type="checkbox"> Invoice Received
                    </label></b>
                  </td>
                </tr>


                <!-- Amount -->
                <tr>
                  <td><b>Amount in Digits (PKR)</b></td>
                  <td colspan="3">'.number_format($donation['amount']).'</td>
                </tr>
                <tr>
                  <td><b>Amount in Words</b></td>
                  <td colspan="3">'.ucwords(convert_number_to_words($donation['amount'])).', Rupees Only</td>
                </tr>

                <!-- Footer with Barcode + Contact + QR -->
                <tr class="no-border">
                  <td><img src="'.SITE_URL.'assets/images/barcode.jpg" alt="Barcode" width="100" height="70"></td>
                  <td colspan="2" class="center" style="font-size:11px;">
                    <b>Office</b> #483 1st Floor, Block 2 Sector B-II, Township Lahore.<br>
                    <b>Phone</b>: (+92) 42 35145621-9
                    <b>Email</b>: Apportionfoundation@gmail.com
                    <b>Website</b>: arf.org.pk
                  </td>
                  <td class="center"><img src="'.SITE_URL.'assets/images/qrcode.jpg" alt="QR Code" width="70" height="70"></td>
                </tr>

                <tr class="no-border m-0">
                  <td colspan="4" class="center" style="font-size:10px;">
                    This is a system-generated document and is valid without a signature.<br>
                    Issued at: 
                  </td>
                </tr>
              </table>


            </body>
        </html>
        <script type="text/javascript" language="javascript1.2">
            //Do print the page
            if (typeof(window.print) != "undefined") {
                window.print();
            }
        </script>';
} else {
    header("Location: dashboard.php");
}
