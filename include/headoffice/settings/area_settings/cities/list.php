<?php
$condition = array ( 
                    'select'        =>  ''.CITIES.'.city_id, '.CITIES.'.id_substate, '.CITIES.'.id_state, '.CITIES.'.city_ordering, '.CITIES.'.id_country, '.CITIES.'.city_name, '.CITIES.'.city_codedigit, '.CITIES.'.city_codealpha, '.CITIES.'.city_latitude, '.CITIES.'.city_longitude, '.CITIES.'.city_status, '.SUB_STATES.'.substate_name, '.STATES.'.state_name, '.COUNTRIES.'.country_name',
                    'join' 		    =>  'INNER JOIN '.SUB_STATES.' ON '.SUB_STATES.'.substate_id = '.CITIES.'.id_substate
                                         INNER JOIN '.STATES.' ON '.STATES.'.state_id = '.CITIES.'.id_state
                                         INNER JOIN '.COUNTRIES.' ON '.COUNTRIES.'.country_id = '.CITIES.'.id_country',
                    'where'         =>  array( 
                                                ''.CITIES.'.is_deleted' => 0
                                            ), 
                    'order_by' 		=>  ''.CITIES.'.city_ordering ASC',
                    'return_type'   =>  'all'
                   ); 
$Cities 	= $dblms->getRows(CITIES, $condition);

    echo '
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title mb-0 mt-3" >City List</h3>
                            </div>
                            <div class="col-sm-6 text-end">
                                <a class="btn btn-primary" onclick="showAjaxModalZoom(\'include/modals/cities/add.php\');"><i class="ri-add-box-fill align-bottom me-1"></i>City</a>
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
                                    <th class="bg-transparent border-bottom-0 wp-8">Ordering</th>
                                    <th class="bg-transparent border-bottom-0 wp-10">Code (Digit)</th>
                                    <th class="bg-transparent border-bottom-0 wp-10">Code (Alpha)</th>
                                    <th class="bg-transparent border-bottom-0 wp-10">Latitude</th>
                                    <th class="bg-transparent border-bottom-0 wp-10">Longitude</th>
                                    <th class="bg-transparent border-bottom-0 wp-10">Sub State</th>
                                    <th class="bg-transparent border-bottom-0 text-center wp-7">Status</th>
                                    <th class="bg-transparent border-bottom-0 text-center wp-7">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">';
                                if($Cities):
                                    $sr = 0;
                                    foreach($Cities as $city):
                                        $sr++;
                                        echo '
                                        <tr>
                                            <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                                            <td class="text-muted fs-14 fw-semibold">'.$city['city_name'].'</td>
                                            <td class="text-muted fs-14 text-center">'.$city['city_ordering'].'</td>
                                            <td class="text-muted fs-14">'.$city['city_codedigit'].'</td>
                                            <td class="text-muted fs-14">'.$city['city_codealpha'].'</td>
                                            <td class="text-muted fs-14">'.$city['city_latitude'].'</td>
                                            <td class="text-muted fs-14">'.$city['city_longitude'].'</td>
                                            <td class="text-muted fs-14 text-center">'.$city['substate_name'].'</td>
                                            <td class="text-muted fs-14 text-center">'.get_status($city['city_status']).'</td>
                                            <td class="text-muted fs-14 text-center">
                                                <a class="btn btn-xs btn-primary" onclick="showAjaxModalZoom(\'include/modals/cities/edit.php?city_id='.$city['city_id'].'&city_name='.$city['city_name'].'&city_codedigit='.$city['city_codedigit'].'&city_codealpha='.$city['city_codealpha'].'&city_latitude='.$city['city_latitude'].'&city_longitude='.$city['city_longitude'].'&id_country='.$city['id_country'].'&id_state='.$city['id_state'].'&id_substate='.$city['id_substate'].'&city_status='.$city['city_status'].'&city_ordering='.$city['city_ordering'].'\');"><i class="fe fe-edit"></i></a>

                                                <a class="btn btn-xs btn-danger" onclick="confirm_modal(\'cities.php?deleteid='.$city['city_id'].'\');"><i class="fe fe-trash"></i></a>
                                            </td>
                                        </tr>';
                                    endforeach;
                                endif;
                                echo '
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- COL END -->
    </div> ';
?>