<?php
$condition = array ( 
                    'select'        =>  ''.DISTRIBUTION_PLACES.'.place_id, '.DISTRIBUTION_PLACES.'.place_status, '.DISTRIBUTION_PLACES.'.place_ordering, '.DISTRIBUTION_PLACES.'.place_latitude, '.DISTRIBUTION_PLACES.'.place_longitude, '.DISTRIBUTION_PLACES.'.place_address, '.DISTRIBUTION_PLACES.'.place_people_fed, '.DISTRIBUTION_PLACES.'.place_image, '.DISTRIBUTION_PLACES.'.place_youtube_code, '.DISTRIBUTION_PLACES.'.place_geo_location, '.DISTRIBUTION_PLACES.'.place_phone, '.CITIES.'.city_name',
                    'join' 		    =>  'INNER JOIN '.CITIES.' ON '.CITIES.'.city_id = '.DISTRIBUTION_PLACES.'.id_city',
                    'where'         =>  array( 
                                                ''.DISTRIBUTION_PLACES.'.is_deleted' => 0
                                            ), 
                    'order_by' 		=>  ''.DISTRIBUTION_PLACES.'.place_ordering ASC',
                    'return_type'   =>  'all'
                   ); 
$distributionPlaces 	= $dblms->getRows(DISTRIBUTION_PLACES, $condition);

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
                                <a class="btn btn-primary" href="distribution_places.php?add"><i class="ri-add-box-fill align-bottom me-1"></i>Distribution Place</a>
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
                                    <th class="bg-transparent border-bottom-0">Place</th>
                                    <th class="bg-transparent border-bottom-0 wp-8">Ordering</th>
                                    <th class="bg-transparent border-bottom-0 wp-8">People Fed</th>
                                    <th class="bg-transparent border-bottom-0 wp-8">Phone</th>
                                    <th class="bg-transparent border-bottom-0 wp-10">Latitude</th>
                                    <th class="bg-transparent border-bottom-0 wp-10">Longitude</th>
                                    <th class="bg-transparent border-bottom-0 wp-10">City</th>
                                    <th class="bg-transparent border-bottom-0 text-center wp-7">Status</th>
                                    <th class="bg-transparent border-bottom-0 text-center wp-7">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">';
                                if($distributionPlaces):
                                    $sr = 0;
                                    foreach($distributionPlaces as $row):
                                        $sr++;
                                        echo '
                                        <tr>
                                            <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                                            <td class="text-muted fs-14 fw-semibold">
                                                <div class="d-flex align-items-center">
                                                    <span class="data-image avatar avatar-md rounded-circle" style="background-image: url(uploads/images/distribution_places/'.$row['place_image'].')"></span>
                                                    <div class="user-details ms-2">
                                                        <h6 class="mb-0">'.$row['place_address'].'</h6>
                                                        <span class="text-muted fs-12">'.$row['place_geo_location'].'</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-muted fs-14 text-center">'.$row['place_ordering'].'</td>
                                            <td class="text-muted fs-14 text-center">'.$row['place_people_fed'].'</td>
                                            <td class="text-muted fs-14">'.$row['place_phone'].'</td>
                                            <td class="text-muted fs-14">'.$row['place_latitude'].'</td>
                                            <td class="text-muted fs-14">'.$row['place_longitude'].'</td>
                                            <td class="text-muted fs-14">'.$row['city_name'].'</td>
                                            <td class="text-muted fs-14 text-center">'.get_status($row['place_status']).'</td>
                                            <td class="text-muted fs-14 text-center">
                                                <a class="btn btn-xs btn-primary" href="distribution_places.php?id='.$row['place_id'].'"><i class="fe fe-edit"></i></a>

                                                <a class="btn btn-xs btn-danger" onclick="confirm_modal(\'distribution_places.php?deleteid='.$row['place_id'].'\');"><i class="fe fe-trash"></i></a>
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