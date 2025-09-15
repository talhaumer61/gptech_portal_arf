<?php 
    require_once("../../dbsetting/lms_vars_config.php");
    require_once("../../dbsetting/classdbconection.php");
    require_once("../../functions/functions.php");
    $dblms = new dblms();
    $ConFaqs = array ( 
                            'select'        =>  'faq_id, faq_status, faq_ordering, faq_question, faq_answer, id_cat',
                            'where' 	=> array( 
                                                    'faq_id' => $_GET['faq_id']
                                                ), 
                            'return_type'   =>  'single'
                       ); 
    $faq  = $dblms->getRows(FAQS, $ConFaqs);
    $conCat = array ( 
                        'select'        =>  'cat_id, cat_name',
                        'where'         =>  array( 
                                                     'is_deleted' => 0
                                                    ,'cat_status' => 1
                                                ), 
                        'order_by' 		=>  'cat_ordering ASC',
                        'return_type'   =>  'all'
                    ); 
    $categories = $dblms->getRows(CATEGORIES, $conCat);
    echo '
    <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
        <div class="modal-content modal-content-demo expanel expanel-primary">
            <div class="modal-header expanel-heading">
                <h6 class="modal-title">Edit Faqs</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="faqs.php" autocomplete="off" class="form-validate"  enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="modal-body expanel-body text-start">

                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label">Category <span class="text-danger">*</span></label>
                            <input class="form-control" name="faq_id" value="'.$faq['faq_id'].'"  type="hidden" required>
                            <select class="form-control select2-show-search form-select" required name="id_cat" data-placeholder="Select">
                                <option label="Select"></option>';
                                foreach($categories as $cat):
                                    echo '
                                    <option value="'.$cat['cat_id'].'" '.($faq['id_cat'] == $cat['cat_id'] ? 'selected' : '').'>'.$cat['cat_name'].'</option>';
                                endforeach;
                                echo '
                            </select>
                        </div>
                        <div class="col form-group">
                            <label class="form-label" for="card-name">Ordering <span class="text-danger">*</span></label>
                            <input class="form-control" name="faq_ordering" value="'.$faq['faq_ordering'].'" readonly type="number" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="form-label" for="card-name">Question <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="faq_question" required>'.$faq['faq_question'].'</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="card-name">Answer <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="faq_answer" required>'.$faq['faq_answer'].'</textarea>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label">Staus <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search form-select" required name="faq_status" data-placeholder="Choose one">
                                <option label="Choose one"></option>';
                                $statuses = get_status();
                                foreach($statuses as $key => $status):
                                    echo '
                                    <option value="'.$key.'" '.($faq['faq_status'] == $key ? 'selected' : '').'>'.$status.'</option>';
                                endforeach;
                                echo '
                            </select>
                        </div>
                    </div>
                </div>
                <div class="expanel-footer modal-footer">
                    <button type="submit" class="btn btn-primary" name="submit_edit" >Edit Faq</button> 
                    <a class="btn btn-danger" data-bs-dismiss="modal" >Close</a>
                </div>
            </form>
        </div>
    </div>
    ';
?>