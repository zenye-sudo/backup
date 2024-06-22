<?PHP
//Array Type
//class One{
//    public $arraydata;
//   public function setter(array $data){
//    $this->arraydata=$data; }
//    public function getter() : array{
//       return $this->arraydata; }
//}
//$obj=new One();
//$obj->setter(["One"=>1,"Two"=>2,"Three"=>3,"Four"=>4]);
//$array=$obj->getter();
//echo "<pre>".print_r($array,true)."</pre>";

//Object Type
class One{
    public function setter(Two $data){
        var_dump($data);
    }
}
class Two{

}
$two=new Two();
$obj=new One();
$obj->setter($two);

