<?php
$siteRegulars = Config::find_by_id(1);
$lastElement='';
$phonelinked='';
$whatsapp='';
$script_extra='';
$tellinked = '';
    $telno = explode("/", $siteRegulars->contact_info);
    $lastElement = array_shift($telno);
    $tellinked .= '<a href="tel:' . $lastElement . '" target="_blank">' . $lastElement . '</a>/';
    foreach ($telno as $tel) {
        
        $tellinked .= '<a href="tel:+977-' . $tel . '" target="_blank">' . $tel . '</a>';
        if(end($telno)!= $tel){
        $tellinked .= '/';
        }   
}

$phoneno = explode(",", $siteRegulars->whatsapp);

$count = 1;
$phonelinked ='';
foreach ($phoneno as $tel) {
    if($count>1){
        $phonelinked .= '/';
        $phonelinked .= '<a href="tel:+9771' . $tel . '">' . substr($tel, -2) . '</a>';

    }else{
        $phonelinked .= '<a href="tel:+9771' . $tel . '">+977 - 1 - ' . $tel . '</a>';

    }

    $count++;
}



$phonenoktm = explode(",", $siteRegulars->contact_info);

$count = 1;
$phonelinkedktm ='';
foreach ($phonenoktm as $tel) {
    if($count>1){
        $phonelinkedktm .= '/';
        $phonelinkedktm .= '<a href="tel:+9771' . $tel . '">' . substr($tel, -2) . '</a>';

    }else{
        $phonelinkedktm .= '<a href="tel:+9771' . $tel . '">+977 - 1 - ' . $tel . '</a>';

    }

    $count++;
}

$maillink = '';
$mail = explode(",", $siteRegulars->email_address);

$count = 1;

foreach ($mail as $tel) {
    if($count>1){
        $maillink .= ' , ';
    }

    $maillink .= '<a href="mailto:' . $tel . '">' . $tel . '</a>';
    $count++;
}

$footer = '
        





        <footer>
            <div class="background-image" data-background="url('. BASE_URL .'template/web/img/footer_bg.png)"></div>
            <div class="footer_bg">
                <!-- <div class="gradient_over"></div> -->
                
            
                <div class="container">
                    <div class="row move_content">
                        <div class="col-lg-4 col-md-12">
                            <h5>'. $siteRegulars->sitetitle .'</h5>
                            <ul>
                                <li>'. $siteRegulars->fiscal_address .'</li><br/>
                                <!-- <li><strong><a href="#0">info@Paradisehotel.com</a></strong></li> -->
                                <li><strong>'. $phonelinked .'</strong></li>
                            </ul>
                            <div class="social">
                                <ul>
                                    ' . $jVars['module:socilaLinkbtm'] . ' 
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 ms-lg-auto">
                            <h5>Explore</h5>
                            <div class="footer_links">
                                <ul>
                                    <li><a href="#">About Us</a></li>
                                    <li><a href="#">Rooms &amp; Suites</a></li>
                                    <li><a href="#">Meeting &amp; Events</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Terms and Conditions</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-12">
                            <h5>Kathmandu City Office</h5>
                            <ul>
                                <li>'. $siteRegulars->mail_address .'</li><br/>
                                <li><strong>'.$maillink.'</li><br/>
                                <li><strong>'. $phonelinkedktm.'</strong></li>
                            </ul>
                        </div>

                        
                    </div>
                    <!--/row-->
                </div>
            </div>
            <!--/container-->
            <div class="copy">
                <div class="container">
                    '. $jVars['site:copyright'] .'
                </div>
            </div>
        </footer>
        
        
        
        ';


$jVars['module:footer'] = $footer;
// $jVars['module:footer-script'] = $script_extra;

if(!empty($siteRegulars->whatsapp_a)){
$whatsapp='
<a href="https://wa.me/+977'.$siteRegulars->whatsapp_a.'" target="_blank" class="whatsapp-button"><img src="http://dhagroup.com.np/template/cms/img/whatsapp.png" class="img-fluid"></a>

';
}
else{
    $whatsapp='';
}

$jVars['module:footer-whatsapp'] = $whatsapp;
