<?php
$condition = array ( 
                    'select'        =>  ''.STATES.'.state_id, '.STATES.'.state_status, '.STATES.'.state_ordering, '.STATES.'.state_name, '.STATES.'.state_codedigit, '.STATES.'.state_codealpha, '.STATES.'.state_latitude, '.STATES.'.state_longitude, '.STATES.'.id_country, '.COUNTRIES.'.country_name',
                    'join' 		    =>  'INNER JOIN '.COUNTRIES.' ON '.COUNTRIES.'.country_id = '.STATES.'.id_country',
                    'where'         =>  array( 
                                                ''.STATES.'.is_deleted' => 0,
                                            ), 
                    'order_by' 		=>  ''.STATES.'.state_ordering ASC',
                    'return_type'   =>  'all'
                   ); 
$States 	= $dblms->getRows(STATES, $condition);

    echo '
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title mb-0 mt-3" >State List</h3>
                            </div>
                            <div class="col-sm-6 text-end">
                                <a class="btn btn-primary" onclick="showAjaxModalZoom(\'include/modals/states/add.php\');"><i class="ri-add-box-fill align-bottom me-1"></i>State</a>
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
                                    <th class="bg-transparent border-bottom-0 wp-10">Country</th>
                                    <th class="bg-transparent border-bottom-0 text-center wp-7">Status</th>
                                    <th class="bg-transparent border-bottom-0 text-center wp-7">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">';
                                if($States):
                                    $sr = 0;
                                    foreach($States as $state):
                                        $sr++;
                                        echo '
                                        <tr>
                                            <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                                            <td class="text-muted fs-14 fw-semibold">'.$state['state_name'].'</td>
                                            <td class="text-muted fs-14 text-center">'.$state['state_ordering'].'</td>
                                            <td class="text-muted fs-14 text-center">'.$state['state_codedigit'].'</td>
                                            <td class="text-muted fs-14 text-center">'.$state['state_codealpha'].'</td>
                                            <td class="text-muted fs-14">'.$state['state_latitude'].'</td>
                                            <td class="text-muted fs-14">'.$state['state_longitude'].'</td>
                                            <td class="text-muted fs-14">'.$state['country_name'].'</td>
                                            <td class="text-muted fs-14 text-center">'.get_status($state['state_status']).'</td>
                                            <td class="text-muted fs-14 text-center">
                                                <a class="btn btn-xs btn-primary" onclick="showAjaxModalZoom(\'include/modals/states/edit.php?state_id='.$state['state_id'].'&state_name='.$state['state_name'].'&state_codedigit='.$state['state_codedigit'].'&state_codealpha='.$state['state_codealpha'].'&state_latitude='.$state['state_latitude'].'&state_longitude='.$state['state_longitude'].'&id_country='.$state['id_country'].'&state_status='.$state['state_status'].'&state_ordering='.$state['state_ordering'].'\');"><i class="fe fe-edit"></i></a>
                                                <a class="btn btn-xs btn-danger" onclick="confirm_modal(\'states.php?deleteid='.$state['state_id'].'\');"><i class="fe fe-trash"></i></a>
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