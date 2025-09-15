<?php
$condition = array ( 
                    'select' 	=> "region_id, region_name, region_ordering, region_codedigit, region_codealpha, id_parentregion, region_status",
                    'where' 	=> array( 
                                        'is_deleted' => 0 ,
                                    ), 
                    'order_by' 		=> 'region_ordering ASC',
                    'return_type' 	=> 'all' 
                   ); 
$Regions 	= $dblms->getRows(REGIONS, $condition);
    echo '
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title mb-0 mt-3" >Region List</h3>
                            </div>
                            <div class="col-sm-6 text-end">
                                <a class="btn btn-primary" onclick="showAjaxModalZoom(\'include/modals/regions/add.php\');"><i class="ri-add-box-fill align-bottom me-1"></i>Region</a>
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
                                    <th class="bg-transparent border-bottom-0 wp-10">Parent Region</th>
                                    <th class="bg-transparent border-bottom-0 text-center  wp-7">Status</th>
                                    <th class="bg-transparent border-bottom-0 text-center  wp-7">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">';
                                if($Regions):
                                    $sr = 0;
                                    foreach($Regions as $region):
                                        $sr++;
                                        echo '
                                        <tr>
                                            <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                                            <td class="text-muted fs-14 fw-semibold">'.$region['region_name'].'</td>
                                            <td class="text-muted fs-14">'.$region['region_ordering'].'</td>
                                            <td class="text-muted fs-14">'.$region['region_codedigit'].'</td>
                                            <td class="text-muted fs-14">'.$region['region_codealpha'].'</td>
                                            <td class="text-muted fs-14 text-center">'.get_parentregiontypes($region['id_parentregion']).'</td>
                                            <td class="text-muted fs-14 text-center">'.get_status($region['region_status']).'</td>
                                            <td class="text-muted fs-14 text-center">
                                                <a class="btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/regions/edit.php?region_id='.$region['region_id'].'&region_name='.$region['region_name'].'&region_codedigit='.$region['region_codedigit'].'&region_codealpha='.$region['region_codealpha'].'&id_parentregion='.$region['id_parentregion'].'&region_status='.$region['region_status'].'&region_ordering='.$region['region_ordering'].'\');"><i class="fe fe-edit"></i></a>
                                                </a>
                                                <a class="btn btn-xs  btn-danger" onclick="confirm_modal(\'regions.php?deleteid='.$region['region_id'].'\');"><i class="fe fe-trash"></i></a>
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
        </div>
    </div> ';
?>