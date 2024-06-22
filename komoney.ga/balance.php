        
<div id="balance" style="width:100%;height:1000px;">
	<!-----------------------Withdraw Div----------------------------->
	<?php 
                 require_once('connection.php');
                 $userData = $db->prepare("select * from users where id=:id and username=:username");
                 $userData->execute(array(
                                   "id" => $_COOKIE["useridKoMoney"],
                                   "username" => $_COOKIE["usernameKoMoney"]
                            ));
                 $userDataFetch = $userData->fetch();
   ?>
<div id="withdraw" style="margin-left:3px;margin-right:3px;text-align: center;margin-top:20px;border:2px solid yellow;padding-top:20px;padding-bottom:20px;border-radius:15px;background-color:rgb(11,0,24);">
	<!-- For alert Bar start -->
	    <div class="background" style="display:none;top:0px;width:100%;height:100%;position: absolute;background-color:rgba(0,0,0,0.6);left:0;"></div>
	    <div class="alertForVocherBalance mt-5 pb-2 pt-2 text-dark position-absolute col-10 text-center" style="display:none;border-radius:19px;margin-left:5%;background-color:white;z-index:2;">
	    	<div class="specialDiv">
	    		
	    	</div>
        <button class="btn btn-success background mt-3 float-right">OK</button>
    </div>
	<!-- For alert Bar end  -->
	<h4 style="color:yellow">ေငြထုတ္ရန္</h4><br>
	<small style="display:block;color:red;display:none;" id="withdrawAmountError">ေငြပမာဏထည့္ပါ</small>
	<p style="display: inline">ထုတ္ယူမည့္ေငြ</p>
	<input id="withdrawAmount" type="number" name="withdrawAmount" placeholder="ဥပမာ-10000" style="text-align:center;border-color:yellow;border:1px solid yellow;border-radius:5px;"><br><br>
		<p style="display: inline">ေငြေပးေခ်ရန္နည္းလမ္း</p>
	<select id="withdrawSelect" style="border-radius:8px;text-align: center;border:1px solid yellow;">
		<option value="wm">Wave Money</option>
		<option value="ok">Ok$(ok dollar)</option>
	</select><br><br> 
	<small style="color:red;display:block;display:none;" id="pnumError">ေငြလႊဲရမည့္ဖုန္းနံပါတ္ထည့္ပါ</small>
	<input type="number" name="pnum" id="pnum" placeholder="ေငြလႊဲရမည့္ဖုန္းနံပါတ္" style="text-align:center;border-color:yellow;border:1px solid yellow;border-radius:5px;">
	<button class="btn btn-warning text-white" id="withdrawBtn">ေငြထုတ္မည္</button>
</div>
<script type="text/javascript">
        $(".background").click(function(){$(".background").hide();$(".alertForVocherBalance").hide();});
	$("#withdrawBtn").click(function(){
		$("#loadingForBet").show();
		if($("#withdrawAmount").val()== "" && $("#pnum").val()==""){
          $("#withdrawAmountError").css("display","block");
          $("#withdrawAmount").css("border-color","red");
          $("#pnumError").show();
          $("#pnum").css("border-color","red");
		}else if($("#withdrawAmount").val()==""){
          $("#withdrawAmountError").css("border-color","block");
          $("#pnumError").hide();
          $("#pnum").css("border-color","green");
		}else if($("#pnum").val()==""){
          $("#pnumError").show();
          $("#withdrawAmountError").hide();
          $("#withdrawAmount").css("border-color","green");
		}else{
          $("#pnumError").hide();
          $("#withdrawAmountError").hide();
          $("#pnum").css("border-color","green");
          $("#withdrawAmount").css("border-color","green");
          	             var punm=$("#pnum").val();
          	             var bank=$("#withdrawSelect").val();
                        $.ajax({
                        	url:"balanceAjax.php",
                        	type:"post",
                        	data:{
                             "pnum":pnum.value,
                             "bank":bank,
                             "amount":parseInt($("#withdrawAmount").val())
                        	},
                        	success:function(data){
                        		if(data=="notEnough"){
          	                       $(".background").show();
          	                       $(".specialDiv").html('<i class="fa fa-times-circle fa-3x text-danger mb-3"></i><br><strong>ထုတ္ယူလိုေသာ ေငြပမာဏသည္ မူလရွိေနေသာ ေငြပမာဏထက္မ်ားေနသည္။(ထုတ္ယူရန္ေငြမလံုေလာက္ပါ။)</strong><br>');
          	                           $(".alertForVocherBalance").show();
                        		}else{
                        			   var uiBalance=parseInt($(".racbalance").text());
                        			   var uiBalanceRomaining=uiBalance-parseInt($("#withdrawAmount").val());
                        			   $(".racbalance").text(uiBalanceRomaining);
                        			   $(".background").show();
          	                           $(".specialDiv").html('<i class="fa fa-check-circle fa-3x text-success mb-3"></i><br><strong> ေငြထုတ္ယူမႈ ေအာင္ျမင္ပါတယ္။၁၂နာ၇ီအတြင္းလူျကီးမင္းAccountထဲသို့ေငြလႊဲေပးမွာျဖစ္ျပီးေငြထုတ္ယူမႈအေျခအေနကို Withdraw History မွာ သြားေရာက္ျကည့္ရူႏိုင္ပါတယ္။</strong><br>');
          	                            $(".alertForVocherBalance").show();
                        		}
		                        $("#loadingForBet").hide();

                        	}
                        });
		}
		$("#loadingForBet").hide();
	});


</script>
	<!-----------------------Withdraw Div end----------------------------->
	<!-----------------------Deposit Div start----------------------------->
	<div id="deposit" style="margin-left:3px;margin-right:3px;text-align: center;margin-top:20px;border:2px solid yellow;padding-top:20px;padding-bottom:20px;border-radius:15px;background-color:rgb(11,0,24);">
	  <h4 style="color:yellow;">ေငြသြင္းရန္</h4><br>
    <h5 style="text-align:center;">နည္းလမ္း(၁)</h5>
          <p><span style="color:red;font-size:20px;">*</span><span style="color:yellow">Wave Money Account Number(09772680835)</span> သို့မဟုတ္ <span style="color:yellow">OK$ Account Number(09772680835)</span> တို့အနက္တစ္ခုခုကိုေငြလႊဲျပီး <span style="color:green;">09772680835</span> ကို ဖုန္းဆက္ျပီးမိမိအေကာင့္ထဲသို႕ေငြသြင္းႏိုင္ပါသည္။</p><br>
    <h5 style="text-align:center;">နည္းလမ္း(၂)</h5>
      <p><span>Wave Money Account Number(09772680835)</span> သို့မဟုတ္ <span style="color:yellow">OK$ Account Number(09772680835)</span> တို့အနက္တစ္ခုခုကိုAccount to Accountေငြလႊဲျပီး  ေငြလႊဲထားေသာဓာတ္ပံုကို ေပးပို့ျပီးမိမိအေကာင့္ထဲသို႕ေငြသြင္းႏိုင္ပါသည္။</p>
      <div class="custom-file">
          <input type="file" name="file" class="custom-file-input" id="imgSendForDeposit" lang="es">
          <label class="custom-file-label" for="customFileLang">ေငြလႊဲထားေသာဓာတ္ပံုထည့္ရန္ႏိွပ္ပါ။</label>
      </div>
      <small><span style="color:red;font-size:20px;">*</span>Wave Money Account Number=<span style="color:yellow">09772680835</span></small><br>
      <small><span style="color:red;font-size:20px;">*</span>Ok$(Ok dollar) Account Number=<span style="color:yellow">09772680835</span></small><br>
      <small>ေငြလႊဲျပီးပါကဆက္သြယ္ရန္Hotline Number=<span style="color:yellow">09772680835</span></small><br>
	  <button class="btn btn-warning text-white" id="depositBtn">ေငြသြင္းမည္</button>
	  <script type="text/javascript">
    var img;
    var storeImg;
        $("#imgSendForDeposit").on("change",function(){
        img=document.getElementById("imgSendForDeposit").files[0];
        var img_name=img.name;
        var img_size=img.size;
        var extension=img_name.split(".").pop().toLowerCase();
        if($.inArray(extension,["jpeg","jpg","gif","png"])== -1){
            	$(".background").show();
                $(".specialDiv").html('<i class="fa fa-times-circle fa-3x text-danger mb-3"></i><br><strong>ဓါတ္ပံုေရြးခ်ယ္တာမွားေနပါတယ္။ျပန္လည္ေရြးခ်ယ္ပါ။</strong><br>');
          	    $(".alertForVocherBalance").show();
        }else{
        	storeImg=img_name;

        }
    });
        $("#depositBtn").click(function(){
        	if(storeImg==""){
      	 $(".background").show();
         $(".specialDiv").html('<i class="fa fa-times-circle fa-3x text-danger mb-3"></i><br><strong>ေရြးခ်ယ္ထားေသာPhotoမရွိပါ။Photoကိုတစ္ဖန္ျပန္လည္ေရြးခ်ယ္ပါ။</strong><br>');
         $(".alertForVocherBalance").show();
        	}else{
        		        	            var form_data=new FormData();
            form_data.append("file",img);
            $.ajax({
                url:"balanceAjax.php",
                method : "POST",
                data:form_data,
                contentType:false,
                cache:false,
                processData:false,
                success:function(data){
                  if(data="Success File Upload!"){
                           $(".background").show();
                           $(".specialDiv").html('<i class="fa fa-check-circle fa-3x text-success mb-3"></i><br><strong>ေအာင္ျမင္ပါတယ္။ေငြလႊဲထားေသာဓာတ္ပံုကို ပို့ျပီးပါျပီ။ဓါတ္ပံုကို စစ္ေဆးျပီးလူျကီးမင္းဧ။္2D3D Account ထဲသို့ ၁နာရီအတြင္းေငြထည့္သြင္းေပးသြားမည္ျဖစ္သည္။</strong><br>');
                          $(".alertForVocherBalance").show(); 
                  }
                }
            });
        	}

        });
	  </script>
     </div>
	<!-----------------------Deposit Div end----------------------------->
</div>