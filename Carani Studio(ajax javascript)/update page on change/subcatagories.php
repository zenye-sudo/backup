<?php
$catagories=[
        [
           "id"=>1,"name"=>"fruits","sub_catagory"=>[
                   ["id"=>1,"name"=>"apple"],
                   ["id"=>2,"name"=>"bread"],
                   ["id"=>3,"name"=>"grape"],
                   ["id"=>4,"name"=>"orange"]
            ]
        ],
        [
            "id"=>2,"name"=>"fruits","sub_catagory"=>[
                   ["id"=>1,"name"=>"apple"],
                   ["id"=>2,"name"=>"bread"],
                   ["id"=>3,"name"=>"grape"],
                   ["id"=>4,"name"=>"orange"]
            ]
       ],
       [
            "id"=>3,"name"=>"fruits","sub_catagory"=>[
                  ["id"=>1,"name"=>"apple"],
                  ["id"=>2,"name"=>"bread"],
                  ["id"=>3,"name"=>"grape"],
                  ["id"=>4,"name"=>"orange"],
            ]
       ]
];
$category_id=isset($_GET["category_id"]) ? (int) $_GET["category_id"] : 0;
foreach($catagories as $catagory){
  if($catagory['id']==$category_id){
      $subcategories=$catagory['sub_catagory'];
      foreach($subcategories as $key=>$value){
          echo "<option value=".$value['id'].">";
          echo $value['name'];
          echo "</option>";
      }
  }
}