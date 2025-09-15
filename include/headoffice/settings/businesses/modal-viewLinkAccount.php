<?php
    echo '
    <!-- MODAL EFFECTS -->
    <div class="modal fade" id="viewLinkAccount">
        <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
            <div class="modal-content modal-content-demo expanel expanel-warning">
                <div class="modal-header expanel-heading">
                    <h6 class="modal-title">List Accounts</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="businesses.php" autocomplete="off" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <div class="modal-body expanel-body text-start">
                        <div class="table-responsive">
                            <table id="data_linkaccount" class="table text-nowrap mb-0 table-bordered">
                            </table>
                        </div>
                    </div>
                    <div class="expanel-footer modal-footer">
                        <a class="btn btn-danger" data-bs-dismiss="modal" >Close</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            //---edit item link clicked-------
            $(".viewLinkAccountModel").click(function(){
            
                //get variables from "edit link" data attributes
                var business_id =   $(this).attr("data-business-id");

                $.ajax({
                    type: "POST",
                    url: "ajax/get_viewlinkaccount.php",
                    data: "id_business=" + business_id,
                    success: function(data) {
                        console.log(data)
                        $("#data_linkaccount").html(data);
                    }
                });
            }); 
        });
    </script>
    ';
?>