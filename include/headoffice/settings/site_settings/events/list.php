<?php
    $condition = array ( 
                        'select' 	=> "".EVENTS.".event_id, ".EVENTS.".event_status, ".EVENTS.".event_short_title, ".EVENTS.".event_start_date, ".EVENTS.".event_end_date,".EVENTS.".event_start_time,".EVENTS.".event_end_time,".EVENTS.".event_thumbnail,".EVENTS.".event_image,".ORGANIZATIONS.".org_name,".ORGANIZATIONS.".org_phone",
                        'join' 		    => 'LEFT JOIN '.ORGANIZATIONS.' ON '.EVENTS.'.id_org = '.ORGANIZATIONS.'.org_id',
                        'where' 	=> array( 
                                                ''.EVENTS.'.is_deleted'         => 0 ,
                                            ), 
                        'order_by' 		=> 'event_ordering  ASC',
                        'return_type' 	=> 'all' 
                    ); 
    $events 	= $dblms->getRows(EVENTS, $condition);
    echo '
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title mb-0 mt-3" >Events List</h3>
                            </div>
                            <div class="col-sm-6 text-end">
                                <a class="btn btn-primary" href="events.php?add"><i class="ri-add-box-fill align-bottom me-1"></i>Event</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="data-table" class="table text-nowrap mb-0 table-bordered">
                            <thead class="table-head">
                                <tr>
                                    <th class="bg-transparent border-bottom-0 text-center wp-5">Sr.</th>
                                    <th class="bg-transparent border-bottom-0">Title</th>
                                    <th class="bg-transparent border-bottom-0">Phone</th>
                                    <th class="bg-transparent border-bottom-0 wp-8">Date</th>
                                    <th class="bg-transparent border-bottom-0 text-center wp-7">Status</th>
                                    <th class="bg-transparent border-bottom-0 text-center wp-7">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">';
                                if($events):
                                    $sr = 0;
                                    foreach($events as $row):
                                        $sr++;
                                        echo '
                                        <tr>
                                            <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                                            <td class="text-muted fs-14 fw-semibold">
                                                <div class="d-flex align-items-center">
                                                    <span class="data-image avatar avatar-md rounded-circle" style="background-image: url(uploads/images/events/thumbnails/'.$row['event_thumbnail'].')"></span>
                                                    <div class="user-details ms-2">
                                                        <h6 class="mb-0">'.$row['event_short_title'].'</h6>
                                                        <span class="text-muted fs-12">'.$row['org_name'].'</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-muted fs-14">'.$row['org_phone'].'</td>
                                            <td class="text-muted fs-14">'.date('d M, Y', strtotime($row['event_start_date'])).' - '.date('d M, Y', strtotime($row['event_end_date'])).'</td>
                                            <td class="text-muted fs-14 text-center">'.get_status($row['event_status']).'</td>
                                            <td class="text-muted fs-14 text-center">
                                                <a class="btn btn-info btn-xs" href="events.php?view=photos&id='.$row['event_id'].'&title='.$row['event_short_title'].'"><i class="fe fe-image"></i></a>
                                                <a class="btn btn-primary btn-xs" href="events.php?view=edit&id='.$row['event_id'].'"><i class="fe fe-edit"></i></a>
                                                <a class="btn btn-xs  btn-danger" onclick="confirm_modal(\'events.php?deleteid='.$row['event_id'].'\');"><i class="fe fe-trash"></i></a>
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