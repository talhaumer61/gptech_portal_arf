<?php
$conditions = array ( 
                        'select' 	=> ''.SUB_STATES.'.substate_id, '.SUB_STATES.'.substate_name, '.SUB_STATES.'.substate_ordering, '.SUB_STATES.'.substate_latitude, '.SUB_STATES.'.substate_longitude,'.SUB_STATES.'.id_state,'.SUB_STATES.'.id_country,'.SUB_STATES.'.substate_status,'.STATES.'.state_name,'.COUNTRIES.'.country_name',
                        'join' 		=> "INNER JOIN ".STATES." ON ".STATES.".state_id = ".SUB_STATES.".id_state
                                        INNER JOIN ".COUNTRIES." ON ".COUNTRIES.".country_id = ".SUB_STATES.".id_country",
                        'where' 	=> array( 
                                            ''.SUB_STATES.'.is_deleted' 	=> 0 
                                        ), 
                        'order_by' 		=> ''.SUB_STATES.'.substate_id DESC',
                        'return_type' 	=> 'all' 
                    ); 
$Substates 	= $dblms->getRows(SUB_STATES, $conditions);
    echo '
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title mb-0 mt-3" >Sub State List</h3>
                            </div>
                            <div class="col-sm-6 text-end">
                                <a class="btn btn-primary" onclick="showAjaxModalZoom(\'include/modals/substates/add.php\');"><i class="ri-add-box-fill align-bottom me-1"></i>Sub State</a>
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
                                    <th class="bg-transparent border-bottom-0 wp-10">State</th>
                                    <th class="bg-transparent border-bottom-0 wp-10">Country</th>
                                    <th class="bg-transparent border-bottom-0 wp-10 text-center">Latitude</th>
                                    <th class="bg-transparent border-bottom-0 wp-10">Longitude</th>
                                    <th class="bg-transparent border-bottom-0 text-center  wp-7">Status</th>
                                    <th class="bg-transparent border-bottom-0 text-center  wp-7">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">';
                                if($Substates):
                                    $sr = 0;
                                    foreach($Substates as $substate):
                                        $sr++;
                                        echo '
                                        <tr>
                                            <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                                            <td class="text-muted fs-14 fw-semibold">'.$substate['substate_name'].'</td>
                                            <td class="text-muted fs-14 text-center">'.$substate['substate_ordering'].'</td>
                                            <td class="text-muted fs-14">'.$substate['state_name'].'</td>
                                            <td class="text-muted fs-14">'.$substate['country_name'].'</td>
                                            <td class="text-muted fs-14 text-center">'.$substate['substate_latitude'].'</td>
                                            <td class="text-muted fs-14">'.$substate['substate_longitude'].'</td>
                                            <td class="text-muted fs-14 text-center">'.get_status($substate['substate_status']).'</td>
                                            <td class="text-muted fs-14 text-center">
                                                <a class="btn btn-xs btn-primary" onclick="showAjaxModalZoom(\'include/modals/substates/edit.php?substate_id='.$substate['substate_id'].'&substate_name='.$substate['substate_name'].'&id_state='.$substate['id_state'].'&id_country='.$substate['id_country'].'&substate_latitude='.$substate['substate_latitude'].'&substate_longitude='.$substate['substate_longitude'].'&substate_status='.$substate['substate_status'].'&substate_ordering='.$substate['substate_ordering'].'\');"><i class="fe fe-edit"></i></a>

                                                <a class="btn btn-xs  btn-danger" onclick="confirm_modal(\'substates.php?deleteid='.$substate['substate_id'].'\');"><i class="fe fe-trash"></i></a>
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