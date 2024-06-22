<?php
class sayin{
    public $drivers,$cars;
    public function __construct(drivers $drivers,cars $cars)
    {
        $this->drivers=$drivers;
        $this->cars=$cars;
    }
    public function drivers():drivers{
        return $this->drivers;
    }
    public function cars():cars{
        return $this->cars;
    }
}
class drivers{
    public $name,$age,$family,$hourlyrate,$static;
    public function dname(string $name){
        $this->name=$name;
    }
    public function dnameg() : string{
        return $this->name;
    }
    public function dage(int $age){
        $this->age=$age;
    }
    public function dageg() : int{
        return $this->age;
    }
    public function dfamily(array $family){
        $this->family=$family;
    }
    public function dfamilyg() : array{
        return $this->family;
    }
    public function dhourlyrate(float $hourlyrate){
        $this->hourlyrate=$hourlyrate;
    }
    public function dhourlyrateg() : float{
        return $this->hourlyrate;
    }
    public function dstatic(bool $static){
        $this->static=$static;
    }
    public function dstaticg() : string{
        return $this->static;
    }
}
class cars{
    public $name,$price,$spayar,$power,$avaliable;
    public function __construct(string $name,int $price,array $spayar,float $power,bool $avaliable)
    {
        $this->name=$name;
        $this->price=$price;
        $this->spayar=$spayar;
        $this->power=$power;
        $this->avaliable=$avaliable;
    }
    public function gname() : string {
     return $this->name;
    }
    public function gprice() : int {
        return $this->price;
    }
    public function gspayar() : array {
        return $this->spayar;
    }
    public function gpower() : float {
        return $this->power;
    }
    public function gavaliable() : bool {
        return $this->avaliable;
    }
}
$drivers=new drivers();
$drivers->dname("Mg Mg");
$drivers->dage("22");
$drivers->dfamily(["Father"=>"U Ba","Mother"=>"Daw Mya"]);
$drivers->dhourlyrate(34.34);
$drivers->dstatic(FALSE);

$drivers2=new drivers();
$drivers2->dname("Aung Aung");
$drivers2->dage("22");
$drivers2->dfamily(["Father"=>"U Ba","Mother"=>"Daw Mya"]);
$drivers2->dhourlyrate(34.34);
$drivers2->dstatic(FALSE);

$cars=new cars("Toyota",3434,["One"=>"Ticuess","Two"=>"Contone"],34.34,False);
$cars2=new cars("Lancruisa",3434,["One"=>"Ticuess","Two"=>"Contone"],34.34,False);
$sayin1=new sayin($drivers,$cars);
$sayin2=new sayin($drivers2,$cars2);

$list=[$sayin1,$sayin2];
$serializedata=serialize($list);
echo $serializedata;
echo "<hr>";
$unserialilzeddata=unserialize($serializedata);
echo "<pre>".print_r($unserialilzeddata,true)."</pre>";
echo "<hr>";
echo $list[0]->drivers->name;echo "<br>";
echo $list[1]->cars->name;



