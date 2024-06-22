<?php
//sleep(1);
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER["HTTP_X_REQUESTED_WITH"]=="XMLHttpRequest";
}


function find_blog_posts($page){
$first_post=101;
$per_page=3;
$offset=(($page-1)*$per_page)+1;
$blog_posts=[];

for($i=0;$i<$per_page;$i++){
$id=$first_post-1+$offset+$i;
$blog_post=[
    "id"=>$id,
    "title"=>"blog post#{$id}",
    "content"=>"loremLorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore fugit laborum maiores, molestias omnis tenetur ut voluptates. Ad culpa deleniti dolores laboriosam! Aspernatur, aut cupiditate distinctio laboriosam nihil quod velit?
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. At consectetur culpa cum dolore ducimus excepturi explicabo, inventore maxime mollitia nesciunt praesentium quaerat quibusdam recusandae saepe sint, veniam voluptatem. Eligendi, quia!
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea, est, eum! A, accusantium consectetur culpa dicta facilis fugiat hic inventore nulla pariatur perspiciatis quod rem, repellendus saepe soluta unde! Molestias!
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet atque eius esse hic quis ratione sequi sin"
];
$blog_posts[]=$blog_post;
}
return $blog_posts;
}



$pid=isset($_GET['page']) ? $_GET['page']:1;
$blog_posts=find_blog_posts($pid);
?>



<?php foreach($blog_posts as $blog_post):?>
<div class="blog_posts">
   <h3><?php  echo $blog_post["title"] ?></h3>
    <p><?php echo $blog_post['content'] ?></p>
</div>
<?php endforeach; ?>
