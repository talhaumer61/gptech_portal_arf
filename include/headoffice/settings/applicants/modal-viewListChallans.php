<?php
    echo '
    <!-- MODAL EFFECTS -->
    <div class="modal fade" id="viewListChallans">
        <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
            <div class="modal-content modal-content-demo expanel expanel-info">
                <div class="modal-header expanel-heading">
                    <h6 class="modal-title">List Challans</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body expanel-body text-start">
                    <div class="table-responsive">
                        <table id="data_listchallans" class="table text-nowrap mb-0 table-bordered">
                        </table>
                    </div>
                </div>
                <div class="expanel-footer modal-footer">
                    <a class="btn btn-danger" data-bs-dismiss="modal" >Close</a>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            //---edit item link clicked-------
            $(".viewListChallansModel").click(function(){
            
                //get variables from "edit link" data attributes
                var ap_products_id  =   $(this).attr("data-ap-products-id");
                var applicant_id    =   $(this).attr("data-applicant-id");

                $.ajax({
                    type: "POST",
                    url: "ajax/get_viewlistchallans.php",
                    data: {id_ap_products: ap_products_id , id_applicant:applicant_id},
                    success: function(data) {
                        console.log(data)
                        $("#data_listchallans").html(data);
                    }
                });
            }); 
        });
    </script>
    ';
?>