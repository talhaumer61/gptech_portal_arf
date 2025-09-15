<?php
$condition = array ( 
                     'select' 	    =>  'g.gal_id, g.gal_status, g.gal_ordering, g.gal_title, g.gal_image_video, g.gal_dated, g.id_file_type, c.cat_name, dp.place_address'
                    ,'join'         =>  'INNER JOIN '.CATEGORIES.' c ON c.cat_id = g.id_cat
                                            INNER JOIN '.DISTRIBUTION_PLACES.' dp ON dp.place_id = g.id_place'
                    ,'where' 	    =>  array( 
                                                'g.is_deleted' => 0
                                            )
                    ,'order_by'     =>  'g.gal_ordering ASC'
                    ,'return_type' 	=>  'all' 
                ); 
$GALLERY = $dblms->getRows(GALLERY.' g', $condition);
echo'
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card">
            <div class="card-header border-bottom">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="card-title mb-0 mt-3" >Gallery List</h3>
                        </div>
                        <div class="col-sm-6 text-end">
                            <a href="?view=add" class="btn btn-primary"><i class="ri-add-box-fill align-bottom me-1"></i>Gallery</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="data-table" class="table mb-0 table-bordered">
                        <thead class="table-head">
                            <tr>
                                <th class="bg-transparent border-bottom-0 text-center wp-5">Sr#</th>
                                <th class="bg-transparent border-bottom-0 wp-10 text-center">Date</th>
                                <th class="bg-transparent border-bottom-0">Title</th>
                                <th class="bg-transparent border-bottom-0">Place</th>
                                <th class="bg-transparent border-bottom-0 wp-10 text-center">Ordering</th>
                                <th class="bg-transparent border-bottom-0 text-center wp-7">Status</th>
                                <th class="bg-transparent border-bottom-0 text-center wp-12">Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-body">';
                            if($GALLERY):
                                $sr = 0;
                                foreach($GALLERY as $row):
                                    $sr++;
                                    echo '
                                    <tr>
                                        <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                                        <td class="text-muted fs-14 text-center">'.date('d M, Y', strtotime($row['gal_dated'])).'</td>
                                        <td class="text-muted fs-14 fw-semibold">
                                            <div class="d-flex align-items-center">
                                                <span class="data-image avatar avatar-md" style="background-image: url(\'uploads/images/gallery/thumbnails/'.$row['gal_image_video'].'\')"></span>
                                                <div class="user-details ms-2">
                                                    <h6 class="mb-0">'.$row['gal_title'].'</h6>
                                                    <span class="text-muted fs-12">'.$row['cat_name'].'</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-muted fs-14">'.$row['place_address'].'</td>
                                        <td class="text-muted fs-14 text-center">'.$row['gal_ordering'].'</td>
                                        <td class="text-muted fs-14 text-center">'.get_status($row['gal_status']).'</td>
                                        <td class="text-muted fs-14 text-center">
                                            <a class="btn btn-info btn-xs" href="?view=photos&id_setup='.$row['gal_id'].'&title='.$row['gal_title'].'"><i class="fe fe-image"></i></a>
                                            <a class="btn btn-primary btn-xs" href="?view=edit&id_setup='.$row['gal_id'].'"><i class="fe fe-edit"></i></a>
                                            <a class="btn btn-xs  btn-danger" onclick="confirm_modal(\'gallery.php?deleteid='.$row['gal_id'].'\');"><i class="fe fe-trash"></i></a>
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
</div>';
?>