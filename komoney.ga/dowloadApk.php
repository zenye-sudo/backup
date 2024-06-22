<?php
function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest";
}
if(!is_ajax_request()){exit;};
?>
<div id="dowloadApk" style="height:1000px;width:100%;overflow:auto;">
    <h4 style='border-bottom:1px solid white;padding-bottom:13px;'>Dowload</h4>
    <p>Current Version: 1.0.0</p>
    <p>Dowload <a href='http://www.mediafire.com/file/fo0nobqz2m7am9m/_KoMoney_2D3D_8228320.apk/file' style='font-size:18px;font-family:bold;color:blue'>Here</a> Or Click Photo</p>
    <a href='http://www.mediafire.com/file/fo0nobqz2m7am9m/_KoMoney_2D3D_8228320.apk/file'><img src='download.png' style='width:80%;'></a>
    <h4 style="border-bottom:1px solid white;padding-bottom:13px;padding-top:20px;">About</h4>
    <strong><h3 style="text-align:center;color:yellow">KoMoney 2D/3D</h3>
<p><li style="text-align:center;">KoMoney 2d 3d is a website, based on Thailand, it offers to the statistics of Thailand Stock Exchange Market data, daily and Thailand government lottery monthly.

This app/website is showing facts all about of Thailand National stats of business and lottery, pure data for data analysic purpose.

Thailand SET stats are very useful for analytical processess of some business.

We show Thailand SET daily and Lottery monthly.</li></p><br>


<li style="text-align:center;color:blue;">Buy / Subscribe 2D/3D data feed , make enquiry at heyman19932@gmail.com</li>

<li style="text-align:center;">This Application or Website is developed for Informational Purpose only. 
We are not concerning with No Gambling (online/local) financially or relationally.
We are only connected with Thailand's Government Stock Exchange Market official API from <span style="color:blue;">SET.OR.TH</span> And <span style="color:blue;">GLO.OR.TH</span>
All data displayed and displaying here (this app) are from official data from Thailand's Government. 
This app/Website is only for informational purpose and are not totally accountable for mis-leading or abusing our natural data.</li><br>
</div>
<!--<div id="dowloadApk">-->

<!--</div>-->