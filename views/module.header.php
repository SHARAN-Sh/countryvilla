<?php
$siteRegulars = Config::find_by_id(1);
$booking_code = Config::getField('hotel_code', true);
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

        // $bgcolor = (defined('GALLERY_PAGE') || defined('NEARBY'))? '  style="background:#d9d9d9;" ' :'';        
        // $header = '
        // <header class="cappa-header  " '.$bgcolor.'>
        //     <div class="container-xxl">
        //         <div class="row">
        //             <!-- Menu Burger -->
        //             <div class="col-4 col-md-4 text-left ">
        //             <div class="menu-top" style="z-index: 9999;position: relative;"> 
        //                     <input type="checkbox" id="navi-toggle" class="checkbox" />
        //                     <label for="navi-toggle" class="button d-flex">
        //                         <span class="icon">&nbsp;</span> 
        //                         <div style="padding-left: 40px;padding-top: 10px;">MENU</div>
        //                     </label>
        //                     <div class="background">&nbsp;</div>
        //                     <!-- nav -->
        //                     <nav class="nav pop">
        //                         <div class="list">
        //                             <div class="">
        //                                 <div class="footer-top">
        //                                     <div class="container">
        //                                         <div class="row">
        //                                             <div class="col-md-3">
        //                                                 <div class="footer-column footer-explore-one clearfix">
        //                                                     <ul class="footer-explore-list list-unstyled">
        //                                                         '. $jVars['module:res-menu'] .'
        //                                                     </ul>
        //                                                 </div>
        //                                             </div>
                                
        //                                             <div class="col-md-3">
        //                                                 <div class="footer-column footer-explore clearfix">
        //                                                 '. $jVars['module:res-menu1'] .'


        //                                                 </div>
        //                                             </div>
                                
        //                                             <div class="col-md-3">
        //                                                 <div class="footer-column footer-contact">
        //                                                     '. $jVars['module:booking_pkg'] .'
        //                                                 </div>
        //                                             </div>
                                
        //                                             <div class="col-md-3">
        //                                                 <div class="footer-column footer-contact footer-logo">
        //                                                     <a href="' . BASE_URL . '"><img src="'. IMAGE_PATH . 'preference/offer/' . $siteRegulars->offer_upload .'"></a>
        //                                                 </div>
        //                                                 <p class="footer-contact-text footer_contact_hover"><br/>
        //                                                 '. $siteRegulars->mail_address .'<br/>
        //                                                 '. $phonelinked .'<br/>
        //                                                 '. $maillink .'
        //                                                 </p>
        //                                                 <div class="footer-about-social-list text-center">
        //                                                 ' . $jVars['module:socilaLinkbtm'] . ' 
        //                                                 </div>
        //                                             </div>
        //                                         </div>
        //                                     </div>
        //                                 </div>
                                        
        //                                 <div class="footer-bottom">
        //                                     <div class="container">
        //                                         <div class="row">
        //                                             <div class="col-md-6">
        //                                                 <div class="footer-bottom-inner">
        //                                                     <p class="footer-bottom-copy-right"><a href="'. $siteRegulars->location_map .'"  target="_blank" style="color:#000000;">View Google Map</a></p>
        //                                                 </div>
        //                                             </div>
        //                                         </div>
        //                                     </div>
        //                                 </div>
        //                             </div>
        //                         </div>
        //                     </nav>
        //                 </div>
        //             </div>

        //             <!-- Logo -->
        //             <div class="col-4 col-md-4 cappa-logo-wrap text-center">
        //                 <a href="'.BASE_URL.'"  class="cappa-logo"><img src="'. IMAGE_PATH . 'preference/' . $siteRegulars->logo_upload .'" alt=""></a>
        //             </div>

        //             <!-- Book Now -->
        //             <div class="col-4 col-md-4 text-right cappa-wrap-book">
        //                 <p><a href="'. BASE_URL .'result.php?hotel_code='. $booking_code.'" class="book-home" target="_blank">Book Now</a></p>
        //             </div>
        //         </div>
        //     </div>
        // </header>';












        $header = '

        <header class="reveal_header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-6">
                        <a href="'.BASE_URL.'" class="logo_normal"><img src="'. IMAGE_PATH . 'preference/' . $siteRegulars->logo_upload .'" width="300" alt=""></a>
                        <a href="'.BASE_URL.'" class="logo_sticky"><img src="'. IMAGE_PATH . 'preference/offer/' . $siteRegulars->offer_upload .'" width="250" alt=""></a>
                    </div>
                    <div class="col-6">
                        <nav>
                            <ul>
                                <li><a href="#booking_section" class="btn_1 btn_scrollto">Book Now</a></li>
                                <li>
                                <div class="hamburger_2 open_close_nav_panel">
                                        <div class="hamburger__box">
                                            <div class="hamburger__inner"></div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div><!-- /container -->
        </header><!-- /Header -->


        <div class="nav_panel">
            <a href="#" class="closebt open_close_nav_panel"><i class="bi bi-x"></i></a>
            <div class="sidebar-navigation">
                <nav>

                        '. $jVars['module:res-menu'] .'
                        
                    <div class="panel_footer">
                        <div class="phone_element">
                                <i class="bi bi-telephone"></i><span><em>Info and bookings</em>'.$phonelinked.'</span>
                        </div>
                    </div>
                    <!-- /panel_footer -->
                </nav>
            </div>
            <!-- /sidebar-navigation -->
        </div>
        ';
$jVars['module:header'] = $header;