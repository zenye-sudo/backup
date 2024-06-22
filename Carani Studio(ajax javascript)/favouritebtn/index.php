<?php
session_start();
//$_SESSION['favorities']=[];
if(!isset($_SESSION['favorities'])){$_SESSION['favorities']=[];}
function is_favorite($id){
    return in_array($id,$_SESSION['favorities']);
}
print_r( $_SESSION['favorities']);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        #container1,#container2,#container3{
            width:700px;
            height:310px;
            border:1px solid black;
            margin-bottom:10px;
        }
        .favourite_btn,.unfavourite_btn{
            background-color:red;
            border:0;
            color:white;
            width:90px;
            height:21px;
        }
        span{
            color:red;
            font-family:Cambria;
            font-size:34px;
            float:right;
            padding-right:24px;
            display:none;
        }
        .favorite>span{
            display:block;
        }
        .favourite_btn{
            display:inline;
        }
        .favorite>.favourite_btn{
            display:none;
        }
        .unfavourite_btn{
            display:none;
        }
        .favorite>.unfavourite_btn{
            display:block;
        }
    </style>
</head>
<body>
<?php //echo join(", ",$_SESSION["favorities"]); ?>
<div id="total">
    <div id="container1" class="<?php if(is_favorite(1)){echo 'favorite';} ?>">
        <span>&hearts;</span>
        <h1>TechCoder Myanmar</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus accusantium ducimus error fugiat laudantium molestiae nulla quae quo recusandae unde. Cumque doloremque enim ipsa ipsum minima nemo praesentium rerum, veniam.
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad consectetur dicta dolorem enim eveniet explicabo fuga nam nostrum, officiis placeat quisquam unde voluptatem! Autem dignissimos neque odit quis ratione repellendus!
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, accusamus at blanditiis commodi, dicta fugiat impedit ipsam laborum officiis, pariatur praesentium rem vitae voluptate voluptatibus voluptatum? Error illo quos reiciendis!
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab consequatur doloribus eligendi, exercitationem ipsa quam vitae voluptatibus. Aut distinctio earum eum iste, laudantium modi molestiae mollitia non quaerat reiciendis similique.</p>
        <button class="favourite_btn">Favourite</button>
        <button class="unfavourite_btn">Unfavourite</button>
    </div>
    <div id="container2" class="<?php if(is_favorite(2)){echo 'favorite';} ?>">
        <span>&hearts;</span>
        <h1>TechCoder Myanmar</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus accusantium ducimus error fugiat laudantium molestiae nulla quae quo recusandae unde. Cumque doloremque enim ipsa ipsum minima nemo praesentium rerum, veniam.
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad consectetur dicta dolorem enim eveniet explicabo fuga nam nostrum, officiis placeat quisquam unde voluptatem! Autem dignissimos neque odit quis ratione repellendus!
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, accusamus at blanditiis commodi, dicta fugiat impedit ipsam laborum officiis, pariatur praesentium rem vitae voluptate voluptatibus voluptatum? Error illo quos reiciendis!
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab consequatur doloribus eligendi, exercitationem ipsa quam vitae voluptatibus. Aut distinctio earum eum iste, laudantium modi molestiae mollitia non quaerat reiciendis similique.</p>
        <button class="favourite_btn">Favourite</button>
        <button class="unfavourite_btn">Unfavourite</button>


    </div>
    <div id="container3" class="<?php if(is_favorite(3)){echo 'favorite';} ?>">
        <span>&hearts;</span>
        <h1>TechCoder Myanmar</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus accusantium ducimus error fugiat laudantium molestiae nulla quae quo recusandae unde. Cumque doloremque enim ipsa ipsum minima nemo praesentium rerum, veniam.
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad consectetur dicta dolorem enim eveniet explicabo fuga nam nostrum, officiis placeat quisquam unde voluptatem! Autem dignissimos neque odit quis ratione repellendus!
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, accusamus at blanditiis commodi, dicta fugiat impedit ipsam laborum officiis, pariatur praesentium rem vitae voluptate voluptatibus voluptatum? Error illo quos reiciendis!
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab consequatur doloribus eligendi, exercitationem ipsa quam vitae voluptatibus. Aut distinctio earum eum iste, laudantium modi molestiae mollitia non quaerat reiciendis similique.</p>
        <button class="favourite_btn">Favourite</button>
        <button class="unfavourite_btn">Unfavourite</button>

    </div>

</div>
<script>
    //for favorite btn
    var btns=document.getElementsByClassName("favourite_btn");
    for(i=0;i<btns.length;i++){
        btns.item(i).addEventListener("click",hey);
    }
    function hey(){
        var parent=this.parentElement;
        var request=new XMLHttpRequest();
        request.open("POST","favourite.php",true);
        request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        request.setRequestHeader("X-Requested-With","XMLHttpRequest");

        request.onreadystatechange=function(){
            if(request.readyState==4 && request.status==200){
                var result=request.responseText;
                console.log("Result: "+request.responseText);
                if(result=="True"){
                    parent.classList.add("favorite");
                }
            }
        }
        request.send("id="+parent.id);

    }



    //for unfavorite btn
    var un_btns=document.getElementsByClassName("unfavourite_btn");
    for(i=0;i<btns.length;i++){
        un_btns.item(i).addEventListener("click",hey1);
    }
    function hey1(){
        var parent=this.parentElement;
        var request=new XMLHttpRequest();
        request.open("POST","unfavourite.php",true);
        request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        request.setRequestHeader("X-Requested-With","XMLHttpRequest");

        request.onreadystatechange=function(){
            if(request.readyState==4 && request.status==200){
                var result1=request.responseText;
                console.log("Result: "+request.responseText);
                if(result1=="True"){
                    parent.classList.remove("favorite");
                }
            }
        }
        request.send("id="+parent.id);

    }
</script>
</body>
</html>