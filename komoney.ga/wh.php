<?php
function is_ajax_request(){return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest";
}
if (!is_ajax_request()) {exit;}; ?>
<div id="wh" class="mt-3" style="width:100%;height:400px;overflow-y:auto;overflow-x:hidden;">
    <table class="table table-bordered">
        <thead>
        <tr class="d-flex" style="background-color:#78aaff;">
            <th class="col-1 text-center p-0 col-md-1">#</th>
            <th class="col-3 text-center p-0 col-md-4">Date</th>
            <th class="col-2 text-center p-0 col-md-1">Bank</th>
            <th class="col-3 text-center p-0 col-md-3">Type</th>
            <th class="col-3 text-center p-0">Amount</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <div class="whAjaxLoading text-center">
        <img src="loading.gif" alt="">
    </div>
    <button class="load_more1" data-page="1" style="display:none;">Load more</button>
    <script>
        var request_in_progress=false;
        function setPage1(page){
         $(".load_more1").data('page',page);
        }
        function load_more10(){
            if(request_in_progress==true){return;}
            request_in_progress=true;
            $(".whAjaxLoading").show();
            var page=$(".load_more1").data('page');
            page=page+1;
            $.ajax({
                url:'whAjax.php',
                type:'get',
                data:{
                    pageNumber:$(".load_more1").data('page')
                },
                success:function(data){
                    $(".whAjaxLoading").hide();
                    request_in_progress=false;
                    setPage1(page);
                    $("#wh tbody").append(data);
                    var pageId1=document.getElementsByClassName("pageId1");
                    for(var i=0;i<pageId1.length;i++){
                        var a1=i+1;
                        pageId1[i].innerHTML=a1;
                    }
                }
            });
        }
        $(".load_more1").click(function(){
            load_more10();
        });
        function scrollReaction1(){
         var contentHeight=document.getElementById("wh").offsetHeight;
         var current_y=window.pageYOffset+window.innerHeight;
         if(current_y>=contentHeight){
             load_more10();
         }
        }
        $("#wh").scroll(function(){
            scrollReaction1();
        });
        load_more10();
    </script>
</div>
