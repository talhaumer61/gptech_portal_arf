<?php
    echo '
    <!-- MODAL EFFECTS -->
    <div class="modal fade" id="edit">
        <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
            <div class="modal-content modal-content-demo expanel expanel-info">
                <div class="modal-header expanel-heading">
                    <h6 class="modal-title">Edit Category</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="product_categories.php" autocomplete="off" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <div class="modal-body expanel-body text-start">
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">Name</label>
                                    <input type="hidden" name="cat_id" id="cat_id" class="form-control" placeholder="Enter Name" required />
                                    <input type="text" name="cat_name" id="cat_name" class="form-control" placeholder="Enter Name" required />
                                </div>
                                <div class="col">
                                    <label class="form-label">Code</label>
                                    <input type="text" name="cat_code" id="cat_code" class="form-control" placeholder="AL001" required />
                                </div>
                                <div class="col form-group">
                                    <label class="form-label">Status </label>
                                    <select class="form-control select2-show-search form-select" name="cat_status" id="cat_status" data-placeholder="Choose one" required>
                                        <option label="Choose one"></option>';
                                            foreach ($status as $cat_status):
                                                echo'<option value="'.$cat_status['id'].'">'.$cat_status['name'].'</option>';
                                            endforeach;
                                        echo'
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea name="cat_description" id="cat_description" class="form-control" placeholder="Category Description"></textarea>
                        </div>
                    </div>
                    <div class="expanel-footer modal-footer">
                        <button type="submit" class="btn btn-info" name="submit_edit" >Edit Category</button> 
                        <a class="btn btn-danger" data-bs-dismiss="modal" >Close</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            //---edit item link clicked-------
            $(".editModel").click(function(){
            
                //get variables from "edit link" data attributes
                
                var cat_id            =   $(this).attr("data-cat-id");
                var cat_name          =   $(this).attr("data-cat-name");
                var cat_code          =   $(this).attr("data-cat-code");
                var cat_description   =   $(this).attr("data-cat-description");
                var cat_status        =   $(this).attr("data-cat-status");


                //set modal input values dynamically
                $("#cat_id").val(cat_id);
                $("#cat_name").val(cat_name);
                $("#cat_code").val(cat_code);
                $("#cat_description").val(cat_description);

                //pre-select data in pull down lists
                $("#cat_status").select2().select2("val", cat_status);
            }); 
        });
    </script>
    ';
?>