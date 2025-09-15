<?php

$conditions = array ( 
                        'select' 	=> ''.COUNTRIES.'.country_id, '.COUNTRIES.'.country_name, '.COUNTRIES.'.country_ordering, '.COUNTRIES.'.country_iso2digit, '.COUNTRIES.'.country_iso3digit,'.COUNTRIES.'.country_callingcode,'.COUNTRIES.'.country_latitude,'.COUNTRIES.'.country_longitude,'.COUNTRIES.'.id_timezone,'.COUNTRIES.'.id_currency, '.COUNTRIES.'.id_region, '.COUNTRIES.'.country_status, '.REGIONS.'.region_id, '.REGIONS.'.region_name, '.CURRENCIES.'.currency_id, '.CURRENCIES.'.currency_name',
                        'join' 		=> "INNER JOIN ".CURRENCIES." ON ".CURRENCIES.".currency_id = ".COUNTRIES.".id_currency
                                        INNER JOIN ".REGIONS." ON ".REGIONS.".region_id = ".COUNTRIES.".id_region",
                        'where' 	=> array( 
                                            ''.COUNTRIES.'.is_deleted' 	=> 0 
                                        ), 
                        'order_by' 		=> ''.COUNTRIES.'.country_ordering ASC',
                        'return_type' 	=> 'all' 
                    ); 
$Countries 	= $dblms->getRows(COUNTRIES, $conditions);
    echo '
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title mb-0 mt-3" >Country List</h3>
                            </div>
                            <div class="col-sm-6 text-end">
                                <a class="btn btn-primary" onclick="showAjaxModalZoom(\'include/modals/countries/add.php\');"><i class="ri-add-box-fill align-bottom me-1"></i>Country</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="data-table" class="table text-nowrap mb-0 table-bordered">
                            <thead class="table-head">
                                <tr>
                                    <th class="bg-transparent border-bottom-0 text-center wp-5">Sr#</th>
                                    <th class="bg-transparent border-bottom-0">Name</th>
                                    <th class="bg-transparent border-bottom-0 wp-7">Ordering</th>
                                    <th class="bg-transparent border-bottom-0 wp-7">Calling Code</th>
                                    <th class="bg-transparent border-bottom-0 wp-7">ISO (2 Digit)</th>
                                    <th class="bg-transparent border-bottom-0 wp-7">ISO (3 Digit)</th>
                                    <th class="bg-transparent border-bottom-0 wp-7">Latitude</th>
                                    <th class="bg-transparent border-bottom-0 wp-7">Longitude</th>
                                    <th class="bg-transparent border-bottom-0 wp-7">Timezone</th>
                                    <th class="bg-transparent border-bottom-0 wp-7">Currency</th>
                                    <th class="bg-transparent border-bottom-0 wp-7">Region</th>
                                    <th class="bg-transparent border-bottom-0 text-center  wp-7">Status</th>
                                    <th class="bg-transparent border-bottom-0 text-center  wp-7">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">';
                                if($Countries):
                                    $sr = 0;
                                    foreach($Countries as $country):
                                        $sr++;
                                        echo '
                                        <tr>
                                            <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                                            <td class="text-muted fs-14 fw-semibold">'.$country['country_name'].'</td>
                                            <td class="text-muted fs-14 text-center">'.$country['country_ordering'].'</td>
                                            <td class="text-muted fs-14 text-center">'.$country['country_callingcode'].'</td>
                                            <td class="text-muted fs-14 text-center">'.$country['country_iso2digit'].'</td>
                                            <td class="text-muted fs-14 text-center">'.$country['country_iso3digit'].'</td>
                                            <td class="text-muted fs-14 text-center">'.$country['country_latitude'].'</td>
                                            <td class="text-muted fs-14 text-center">'.$country['country_longitude'].'</td>
                                            <td class="text-muted fs-14 text-center">'.get_timezonetypes($country['id_timezone']).'</td>
                                            <td class="text-muted fs-14 text-center">'.$country['currency_name'].'</td>
                                            <td class="text-muted fs-14 text-center">'.$country['region_name'].'</td>
                                            <td class="text-muted fs-14 text-center">'.get_status($country['country_status']).'</td>
                                            <td class="text-muted fs-14 text-center">
                                                <a class="btn btn-xs btn-primary" onclick="showAjaxModalZoom(\'include/modals/countries/edit.php?country_id='.$country['country_id'].'&country_name='.$country['country_name'].'&country_callingcode='.$country['country_callingcode'].'&country_iso2digit='.$country['country_iso2digit'].'&country_iso3digit='.$country['country_iso3digit'].'&country_latitude='.$country['country_latitude'].'&country_longitude='.$country['country_longitude'].'&id_timezone='.$country['id_timezone'].'&id_currency='.$country['id_currency'].'&id_region='.$country['id_region'].'&country_status='.$country['country_status'].'&country_ordering='.$country['country_ordering'].'\');"><i class="fe fe-edit"></i></a>
                                                <a class="btn btn-xs  btn-danger" onclick="confirm_modal(\'countries.php?deleteid='.$country['country_id'].'\');"><i class="fe fe-trash"></i></a>
                                            </td>
                                        </tr>';
                                    endforeach;
                                endif;
                                echo '
                            </tbody>
                        </table>
                    </div>s
                </div>
            </div>
        </div>
    </div> ';
?>