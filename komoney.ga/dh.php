<?php
function is_ajax_request(){return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest";
}
if (!is_ajax_request()) {exit;}; ?>
<?php
require_once "connection.php";
$dh=$db->prepare("select * from dw where type='deposit' and user_id={$_COOKIE['useridKoMoney']} limit 20");
$dh->execute();
?>
<div id="dh" class="mt-3" style="width:100%;height:400px;overflow-y:auto;overflow-x:hidden;">
    <table class="table table-bordered">
        <thead>
        <tr class="d-flex" style="background-color:#949dff;">
            <th class="col-1 text-center p-0">#</th>
            <th class="col-4 text-center p-0">Date</th>
            <th class="col-3 text-center p-0">Type</th>
            <th class="col-4 text-center p-0">Amount</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <div class="dhAjaxLoading text-center">
        <img src="loading.gif" alt="">
    </div>
    <button style="display:none;" class="btn btn-primary load_more" data-page="1">Load more</button>
    <script>
        var request_in_progress=false;
        function setPage(page){
            $(".load_more").data('page',page);
        }
        $('.load_more').click(function(){
         load_more();
        });
        function load_more(){
            if(request_in_progress){return;}
            request_in_progress=true;
            $(".dhAjaxLoading").show();
            var data_page=$(".load_more").data('page');
            data_page=data_page+1;
            $.ajax({
                url:'dhAjax.php',
                type:"GET",
                data:{
                    pageNumber:$(".load_more").data('page')
                },
                success:function(data){
                    request_in_progress=false;
                    $(".dhAjaxLoading").hide();
                    setPage(data_page);
                    $("#dh tbody").append(data);
                    var pageId=document.getElementsByClassName("pageId");
                    for(var i=0;i<pageId.length;i++){
                        var a=i+1;
                        pageId[i].innerHTML=a;
                    }
                }
            });
        }
        function scrollReaction(){
            var contentHeight=document.getElementById("dh").offsetHeight;
            var current_y=window.pageYOffset+window.innerHeight;
            if(current_y>=contentHeight){
                load_more();
            }
        }
        $("#dh").scroll(function(){
            scrollReaction();
        });
        load_more();

    </script>
</div>
