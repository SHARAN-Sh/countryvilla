<?php
/*
* Contact form
*/
$rescont = $innerbred = '';
$img='';
if (defined('CONTACT_PAGE')) {


    $siteRegulars = Config::find_by_id(1);

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
$imglink= $siteRegulars->contact_upload ;
if(!empty($imglink)){
    $img= IMAGE_PATH . 'preference/contact/' . $siteRegulars->contact_upload ;
}
else{
    $img='';
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

        // pr($siteRegulars);
    $rescont .= '

        <div class="hero medium-height jarallax" data-jarallax data-speed="0.2">
            <img class="jarallax-img" src="'.$img.'" alt="">
            <div class="wrapper opacity-mask d-flex align-items-center justify-content-center text-center animate_hero" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                <div class="container">
                    <small class="slide-animated one">Mesmerize every soul</small>
                    <h1 class="slide-animated two">Contact Us</h1>
                </div>
            </div>
        </div>


        <div class="contact_map">
            <div class="container " >
                <div class="row justify-content-between">
                    <div class="d-none d-xl-block col-xl-4 col-lg-5 order-lg-2">
                        <div class="contact_info">
                            <ul class="clearfix">
                                <li>
                                    <i class="bi bi-geo-alt"></i>
                                    <h4>Address</h4>
                                    <div>'. $siteRegulars->fiscal_address .'</div>
                                </li>
                                <li>
                                    <i class="bi bi-envelope-paper"></i>
                                    <h4>Email address</h4>
                                    <p>'.$maillink.'</p>
                                </li>
                                <li>
                                    <i class="bi bi-telephone"></i>
                                    <h4>Telephone</h4>
                                    <div>'.$phonelinked.'<br><small>24/7, 365 at your service</small></div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- <div class="col-xl-7 col-lg-7 order-lg-1">
                        dd
                    </div> -->

                    
                </div>
                <!-- /row -->
            </div>
            <!--/container -->

        </div>



        <div class="container margin_120_95">
            <div class="row justify-content-between">
                <div class="d-xl-none d-block col-lg-12 ">
                    <div class="contact_info bg_white shadow-sm">
                        <ul class="clearfix">
                            <li>
                                <i class="bi bi-geo-alt"></i>
                                <h4>Address</h4>
                                <div>'. $siteRegulars->fiscal_address .'</div>
                            </li>
                            <li>
                                <i class="bi bi-envelope-paper"></i>
                                <h4>Email address</h4>
                                <p>'.$maillink.'</p>
                            </li>
                            <li>
                                <i class="bi bi-telephone"></i>
                                <h4>Telephone</h4>
                                <div>'.$phonelinked.'<br><small>24/7, 365 at your service</small></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-xl-7 col-lg-7 mx-auto">
                    <h3 class="mb-3">Get in Touch</h3>
                    <div id="message-contact"></div>
                    <form method="post" action="https://www.ansonika.com/paradise/phpmailer/contact_template_email.php" id="contactform" autocomplete="off">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-floating mb-4">
                                    <input class="form-control" type="text" id="name" name="name" placeholder="Name">
                                    <label for="name">Name</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating mb-4">
                                    <input class="form-control" type="text" id="lastname" name="lastname" placeholder="Last Name">
                                    <label for="lastname">Last name</label>
                                </div>
                            </div>
                        </div>
                        <!-- /row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-floating mb-4">
                                    <input class="form-control" type="email" id="email" name="email" placeholder="Email">
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating mb-4">
                                    <input class="form-control" type="text" id="phone" name="phone" placeholder="Telephone">
                                    <label for="phone">Telephone</label>
                                </div>
                            </div>
                        </div>
                        <!-- /row -->
                        <div class="form-floating mb-4">
                            <textarea class="form-control" placeholder="Message" id="message" name="message"></textarea>
                            <label for="message">Message</label>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-4">
                                    <input class="form-control" type="text" id="verify" name="verify" placeholder="Are you human? 3 + 1 =">
                                    <label for="verify">Are you human? 3 + 1 =</label>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3"><input type="submit" value="Submit" id="submit" class="btn_1 outline" id="submit-contact"></p>
                        <div id="result_msg"></div>
                    </form>
                </div>

                
            </div>
        </div>
    ';
}

$jVars['module:contact-us'] = $rescont;
