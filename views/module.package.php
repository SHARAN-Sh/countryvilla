<?php
$booking_code = Config::getField('hotel_code', true);


/*
* Home accmodation list
*/
$imageList = '';
$indpkg = '';
$wholepkg ='';

if (defined('HOME_PAGE')) {

    $pkgRec = Package::getHomePackage();
    if (!empty($pkgRec)) {
        
        foreach ($pkgRec as $count => $subRow) {
            
            
            $imglink = '';
            $img123 = unserialize($subRow->header_image);
                if (!empty($img123[0])) {

                    $file_path = SITE_ROOT . 'images/package/imgheader/' . $img123[0];
                    if (file_exists($file_path)) {
                        $imglink = IMAGE_PATH . 'package/imgheader/' . $img123[0];
                    } else {
                        $imglink = $jVars['site:default-image'];
                    }
                } else {
                    $imglink = $jVars['site:default-image'];
                }

                $top = ($count % 2 == 0)? ' order-lg-2':'';
                $bottom = ($count % 2 == 0)? ' order-lg-1':'';
                $indpkg .='
                <div class="row justify-content-between d-flex align-items-center add_bottom_90">
                    <div class="col-lg-6 '.$top.'">
                        <div class="pinned-image rounded_container pinned-image--small mb-4">
                            <div class="pinned-image__container">
                                <img src="'. $imglink .'" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 '.$bottom.'">
                        <div class="title">
                            <h3>'. $subRow->title.'</h3>
                                '. $subRow->content.'
                            <p><a href="'.BASE_URL . $subRow->slug .'" class="btn_1 mt-1 outline">Read more</a></p>
                        </div>
                    </div>
                </div>
                ';
                
        }
        $wholepkg = '
            <div class="service-home padding_80_80 bg_white">
                <div class="container">
                    '.$indpkg.'
                    
                    <!-- /row-->
                </div>
                <!-- /container-->
            </div>
            <!-- /bg_white -->
        ';
    }


}




$jVars['module:home-accommodation'] = $wholepkg;





/*
* Home sub package list
*/
$newpkg = '';

if (defined('HOME_PAGE')) {
    //$slug = !empty($_REQUEST['slug'])? addslashes($_REQUEST['slug']) : '';
    //$pkgRec = Package::getPackage();
    //if (!empty($pkgRec)) {

        /* foreach($pkgRec as $pkgRow) {
            $imglink = '';*/
        /* if ($pkgRow->banner_image != "a:0:{}") {
            $imageList = unserialize($pkgRow->banner_image);
            $file_path = SITE_ROOT . 'images/package/banner/' . $imageList[0];
            if (file_exists($file_path)) {
                $imglink = IMAGE_PATH . 'package/banner/' . $imageList[0];
            }
        } */
        // if(($pkgRow->type)==0) {
        $newpkg .= '<div class="col-sm-6">
                    <div class="mosaic_container">
                        <a href="' . BASE_URL . 'page/about-us">
                        <img src="' . BASE_URL . 'template/web/img/mosaic_1.jpg" alt="image" class="img-responsive add_bottom_30"><span class="caption_2">Experience Peninsula</span>
                        </a>
                    </div>
                </div>';
        //}else{
        $newpkg .= '<div class="col-sm-6">
            
            <div class="col-xs-12">
                        <div class="mosaic_container">
                            <a href="' . BASE_URL . 'services">
                            <img src="' . BASE_URL . 'template/web/img/mosaic_2.jpg" alt="image" class="img-responsive add_bottom_30"><span class="caption_2">Services & Faciities</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="mosaic_container">
                            <a href="' . BASE_URL . 'rooms">
                            <img src="' . BASE_URL . 'template/web/img/room.jpg" alt="rooms" class="img-responsive add_bottom_30"><span class="caption_2">
        Accommodation</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <a href="' . BASE_URL . 'dining">
                        <div class="mosaic_container">
                            <img src="' . BASE_URL . 'template/web/img/dining.jpg" alt="dining" class="img-responsive add_bottom_30"><span class="caption_2">Dining & Bar</span>
                        </div>
                        </a>
                    </div>
                    
                    </div>
                    ';

        //}
        //}
    //}
}
$jVars['module:newpkg'] = $newpkg;


/////
$reshplist = $pakagehometype = '';
$cnt = 1;
if (defined('HOME_PAGE')) {
    $pgkRows = Package::find_by_id(1);
    $pkgRec = Subpackage::getPackage_limits(1, 6);

    if (!empty($pkgRec)) {

        foreach ($pkgRec as $pkgRow) {
            //echo "<pre>";print_r($pkgRow);die();

            //if(!empty($pkgRow->image2)) {


            //echo "<pre>";print_r($reshplist);die();
            if (($cnt % 3) == 2) {
                $reshplist .= ' <div class="container margin_60">
                <div class="row">
                    <div class="col-md-5 col-md-offset-1 col-md-push-5">
                        <figure class="room_pic left"><a href="' . BASE_URL . '' . $pkgRow->slug . '"><img src="' . IMAGE_PATH . 'subpackage/image/' . $pkgRow->image2 . '" alt="' . $pkgRow->title . '" class="img-responsive"></a><span class="wow zoomIn"><sup>' . $pkgRow->currency . ' </sup>' . $pkgRow->onep_price . '<small>Per night</small></span></figure>
                    </div>
                    <div class="col-md-4 col-md-offset-1 col-md-pull-6">
                        <div class="room_desc_home">
                            <h3>' . $pkgRow->title . '</h3>
                            <p>
                                ' . $pkgRow->detail . ' 
                            </p>
                            <ul>';
                        $saveRec = unserialize($pkgRow->feature);
                        $count = 1;
                        if ($saveRec != null) {
                            $featureList = $saveRec[47][1];
                            //echo "<pre>";print_r($featureList);die();

                            if (!empty($featureList)) {
                                $icoRec = '';

                                foreach ($featureList as $fetRow) {

                                    $icoRec = Features::get_by_id($fetRow);
                                    if(!empty($icoRec->icon)){
                                        $reshplist .= '<li>
                                        <div class="tooltip_styled tooltip-effect-4">
                                            <span class="tooltip-item"><i class="' . $icoRec->icon . '"></i></span>
                                                <div class="tooltip-content">' . $icoRec->title . '</div>
                                        </div>
                                        </li>';
                                    }

                                    if ($count++ == 5) break;
                                }
                            }
                        }
                        $reshplist .= '</ul>
                            <a href="' . BASE_URL . '' . $pkgRow->slug . '" class="btn_1_outline">Read more</a>
                        </div><!-- End room_desc_home -->
                    </div>
                </div><!-- End row -->
            </div>';

                    } else {
                        $reshplist .= '  <div class="container_styled_1">
                <div class="container margin_60">
                    <div class="row">
                        <div class="col-md-5 col-md-offset-1">
                            <figure class="room_pic"><a href="' . BASE_URL . '' . $pkgRow->slug . '"><img src="' . IMAGE_PATH . 'subpackage/image/' . $pkgRow->image2 . '" alt="' . $pkgRow->title . ' " class="img-responsive"></a><span class="wow zoomIn"><sup>' . $pkgRow->currency . ' </sup>' . $pkgRow->onep_price . '<small>Per night</small></span></figure>
                        </div>
                        <div class="col-md-4 col-md-offset-1">
                            <div class="room_desc_home">
                                <h3>' . $pkgRow->title . '  </h3>
                                <p>
                                    ' . $pkgRow->detail . '
                                </p>
                                <ul>';
                        $saveRec = unserialize($pkgRow->feature);
                        $count = 1;
                        if ($saveRec != null) {
                            $featureList = $saveRec[47][1];
                            //echo "<pre>";print_r($featureList);die();

                            if (!empty($featureList)) {
                                $icoRec = '';

                                foreach ($featureList as $fetRow) {

                                    $icoRec = Features::get_by_id($fetRow);
                                    if(!empty($icoRec->icon)){
                                        $reshplist .= '<li>
                                        <div class="tooltip_styled tooltip-effect-4">
                                            <span class="tooltip-item"><i class="' . $icoRec->icon . '"></i></span>
                                                <div class="tooltip-content">' . $icoRec->title . '</div>
                                        </div>
                                        </li>';
                                    }

                                    if ($count++ == 5) break;
                                }
                            }
                        }
                        $reshplist .= '</ul>
                                <a href="' . BASE_URL . '' . $pkgRow->slug . '" class="btn_1_outline">Read more</a>
                            </div><!-- End room_desc_home -->
                        </div>
                    </div><!-- End row -->
                </div><!-- End container -->
            </div>';
                    }
                    $cnt++;
                //}

        }
    }
    /* $reshplist.= '</div>
                 </div>
             </div>';*/
}

$jVars['module:home-packagelist'] = $reshplist;
$jVars['module:home-package-type-list'] = $pakagehometype;


$roomlist = $roombread = $roomnav = '';
$modalpopup='';
$room_package= $homerooms = '';
if (defined('PACKAGE_PAGE') and isset($_REQUEST['slug'])) {
    $slug = !empty($_REQUEST['slug']) ? addslashes($_REQUEST['slug']) : '';
    
    $pkgRow = Package::find_by_slug($slug);

    if($pkgRow->type==1){
        
        $imglink = $jVars['site:default-image'];
        $pkgRowImg = $pkgRow->banner_image;
        if ($pkgRowImg != "a:0:{}") {
            $pkgRowList = unserialize($pkgRowImg);
            $file_path = SITE_ROOT . 'images/package/banner/' . $pkgRowList[0];
            if (file_exists($file_path) and !empty($pkgRowList[0])) {
                $imglink = IMAGE_PATH . 'package/banner/' . $pkgRowList[0];
            }
        }

        $roombread .= '
        <div class="hero full-height jarallax" data-jarallax data-speed="0.2">
            <img class="jarallax-img" src="'.$imglink.'" alt="">
            <div class="wrapper opacity-mask d-flex align-items-center justify-content-center text-center animate_hero" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                <div class="container">
                    <small class="slide-animated one">' . $pkgRow->sub_title . '</small>
                    <h1 class="slide-animated two">' . $pkgRow->title . '</h1>
                </div>
            </div>
        </div>
        ';

        $sql = "SELECT *  FROM tbl_package_sub WHERE status='1' AND type = '{$pkgRow->id}' ORDER BY sortorder DESC ";

        $page = (isset($_REQUEST["pageno"]) and !empty($_REQUEST["pageno"])) ? $_REQUEST["pageno"] : 1;
        $limit = 200;
        $total = $db->num_rows($db->query($sql));
        $startpoint = ($page * $limit) - $limit;
        $sql .= " LIMIT " . $startpoint . "," . $limit;
        $query = $db->query($sql);
        $pkgRec = Subpackage::find_by_sql($sql);
        
        if (!empty($pkgRec)) {
            

            foreach ($pkgRec as $key => $subpkgRow) {
                $imageList = '';
                $carimg = '';
                $subfeat = '';
                
                $gallRec = SubPackageImage::getImagelist_by($subpkgRow->id);

                foreach ($gallRec as $row) {
                    $file_path = SITE_ROOT.'images/package/galleryimages/'.$row->image;
                    if(file_exists($file_path) and !empty($row->image)):
    
                        $carimg  .= '

                        <div class="item">
                            <a href="'.BASE_URL . $subpkgRow->slug .'"><img src="'.IMAGE_PATH.'package/galleryimages/'.$row->image.'" alt="'.$row->title.'"></a>
                        </div>
                        ';
                    
                    endif;
                
                }

                $saveRec = unserialize($subpkgRow->feature);
                $count = 1;
                


                if ($saveRec != null) {
                    $featureList = $saveRec[47][1];
                    //echo "<pre>";print_r($featureList);die();

                    if (!empty($featureList)) {
                        $icoRec = '';
                        foreach ($featureList as $fetRow) {
                            $icoRec = Features::get_by_id($fetRow);
                            if(!empty($icoRec->icon)){
                                $subfeat .= '

                                <li>
                                    <i class="' . $icoRec->icon .'"></i> ' . $icoRec->title . '
                                </li>
                                ';

                                if ($count++ == 8) break;
                            }
                        }
                    }
                }
                
                // if ($subpkgRow->image != "a:0:{}") {
                //     $imageList = unserialize($subpkgRow->image);
                // }


                // $roomlist .= '
                // <div class="mad-col">
                //             <!--================ Entity ================-->
                //             <article class="mad-entity">
                //                 <div class="mad-entity-media">
                //                     <a href="' . BASE_URL . $subpkgRow->slug . '">
                //                         <img src="' . IMAGE_PATH . 'subpackage/' . $imageList[0] . '" alt="" />
                //                     </a>
                //                 </div>
                //                 <div class="mad-entity-content">
                //                     <h4 class="mad-entity-title">' . $subpkgRow->title . '</h4>
                //                     <div class="mad-pricing-value">
                //                         <span>From</span>
                //                         <span class="mad-pricing-value-num">'. $subpkgRow->currency . $subpkgRow->onep_price .'/</span>
                //                         <span>night</span>
                //                     </div>
                //                     <div class="mad-entity-footer">
                //                         <div class="btn-set justify-content-center">
                //                             <a href="'.BASE_URL.'result.php?hotel_code='. $booking_code .'" class="btn btn-big" target="_blank">Book Now</a>
                //                             <a href="' . BASE_URL . $subpkgRow->slug . '" class="btn btn-big style-2">Details</a>
                //                         </div>
                //                     </div>
                //                 </div>
                //             </article>
                //             <!--================ End of Entity ================-->
                //         </div>';
                
                    $amenities =(!empty($subfeat))?'<h5 class="text-center mb-2"> Room Amenities</h5>' : '';

                    $roomlist .= '

                        <div class="row_list_version_3" data-cue="fadeIn">
                            <div class="owl-carousel owl-theme carousel_item_1 kenburns rounded-img">
                                '. $carimg .'
                            </div>
                            <!-- /carousel -->
                            <div class="box_item_info" data-jarallax-element="-25">
                                <small>From '. $subpkgRow->currency . $subpkgRow->onep_price .'/night</small>
                                <h2>' . $subpkgRow->title . '</h2>
                                <p>' . $subpkgRow->detail . '</p>
                                <div class="facilities clearfix">
                                    <ul>
                                        '. $subfeat .'
                                    </ul>
                            </div>
                            <p><a href="'.BASE_URL . $subpkgRow->slug .'" class="btn_1 outline">See more</a></p>

                            </div>
                            <!-- /box_item_info -->
                        </div>
                        <!-- /row_list_version_3 -->


                    ';
                }
            $room_package = '

                            <div class="container padding_80_80" id="booking_section">
                                <div class="row justify-content-between">
                                    <div class="col-xl-4">
                                        <div data-cue="slideInUp" data-show="true" style="animation-name: slideInUp; animation-duration: 600ms; animation-timing-function: ease; animation-delay: 0ms; animation-direction: normal; animation-fill-mode: both;">
                                            <div class="title">
                                                <small>Hotel Country Villa</small>
                                                <h2>Check Availability</h2>
                                            </div>
                                            <p>You can check the availability of a room prior after entering a date request. This will ensure that the room you are requesting is not already booked.</p>
                        
                                            <p class="phone_element no_borders"><a href="tel://423424234"><i class="bi bi-telephone"></i><span><em>Info and bookings</em>+41 934 121 1334</span></a></p>
                                        </div>
                                    </div>
                                    <div class="col-xl-7">
                                        <div data-cue="slideInUp" data-delay="200" data-show="true" style="animation-name: slideInUp; animation-duration: 600ms; animation-timing-function: ease; animation-delay: 380ms; animation-direction: normal; animation-fill-mode: both;">
                                            <div class="booking_wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label for="birthday">Check - In</label>
                                                        <input type="date" id="date" name="date" class="form-control">
                                                    </div>
                        
                                                    <div class="col-lg-6">
                                                        <label for="birthday">Check - Out</label>
                                                        <input type="date" id="date" name="date" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- / row -->
                                            <p class="text-end mt-4"><a href="#0" class="btn_1 outline">Check Availability</a></p>
                                        </div>
                                    </div>
                                    <!-- /col -->
                                </div>
                                <!-- /row -->
                            </div>
                        
                            <main>


                            <div class="container margin_120_95" id="first_section">
                                <div class="row justify-content-between">
                                    <div class="col-xl-4 fixed_title">
                                        <div class="title">
                                            <small>Hotel Country Villa</small>
                                            <h2>Our Rooms</h2>
                                            <p class="lead">' . strip_tags($pkgRow->content) . '</p>
                                            <p><a href="#booking_section" class="btn_1 outline">Book Now</a></p>
                                        </div>
                                    </div>
                                    <div class="col-xl-7">
                                        '. $roomlist .'
                                    </div>
                                </div>
                            </div>
                    ';

                    $room_package .= $jVars['module:service-content-list'];
                    $room_package .= ' </main>';
                }
    }  
    elseif($pkgRow->id==11){
        
        $imglink = BASE_URL . 'template/web/images/bg/room-banner.jpg';
        $pkgRowImg = $pkgRow->banner_image;
        if ($pkgRowImg != "a:0:{}") {
            $pkgRowList = unserialize($pkgRowImg);
            $file_path = SITE_ROOT . 'images/package/banner/' . $pkgRowList[0];
            if (file_exists($file_path) and !empty($pkgRowList[0])) {
                $imglink = IMAGE_PATH . 'package/banner/' . $pkgRowList[0];
            }
        }

        $roombread .= '
        <main>

        <div class="hero medium-height jarallax" data-jarallax data-speed="0.2">
            <img class="jarallax-img" src="'. $imglink .'" alt="">
            <div class="wrapper opacity-mask d-flex align-items-center justify-content-center text-center animate_hero" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                <div class="container">
                    <small class="slide-animated one">' . $pkgRow->title . '</small>
                    <h1 class="slide-animated two">' . $pkgRow->sub_title . '</h1>
                </div>
            </div>
        </div>
        ';

        $sql = "SELECT *  FROM tbl_package_sub WHERE status='1' AND type = '{$pkgRow->id}' ORDER BY sortorder DESC ";

        $page = (isset($_REQUEST["pageno"]) and !empty($_REQUEST["pageno"])) ? $_REQUEST["pageno"] : 1;
        $limit = 200;
        $total = $db->num_rows($db->query($sql));
        $startpoint = ($page * $limit) - $limit;
        $sql .= " LIMIT " . $startpoint . "," . $limit;
        $query = $db->query($sql);
        $pkgRec = Subpackage::find_by_sql($sql);
        
        if (!empty($pkgRec)) {
            

            foreach ($pkgRec as $key => $subpkgRow) {
                $imageList = '';
                $carimg = '';
                $subfeat = '';
                
                $gallRec = SubPackageImage::getImagelist_by($subpkgRow->id);

                foreach ($gallRec as $row) {
                    $file_path = SITE_ROOT.'images/package/galleryimages/'.$row->image;
                    if(file_exists($file_path) and !empty($row->image)):
    
                        $carimg  .= '
                        <div class="pinned-image rounded_container pinned-image--medium">
                            <div class="pinned-image__container">
                                
                                <img src="'.IMAGE_PATH.'package/galleryimages/'.$row->image.'" alt="">

                                </div>
                        </div>
                        ';
                        
    
                    endif;
    
                
                }

                $saveRec = unserialize($subpkgRow->feature);
                $count = 1;
                if ($saveRec != null) {
                    $featureList = $saveRec[47][1];
                    if ($featureList) {

                        $i= 1;
                        foreach ($featureList as $fetRow) {

                            $icoRec = Features::get_by_id($fetRow);

                                $subfeat .= '
                                                <li>
                                                    <i class="' . $icoRec->icon . '"></i> ' . $icoRec->title . '
                                                </li>
                                ';
            
                            if($i >=8){
                                break;
                            }
                            $i++;
                        }

                    }
                }

                    $occupancy = (!empty($subpkgRow->occupancy))? '<small>Upto '.$subpkgRow->occupancy.' pax</small>' : '';
                    $roomlist .= '

                        <div class="row_list_version_1">
                            <div class="owl-carousel owl-theme carousel_item_x1">
                                '. $carimg .'
                            </div>
                            <!-- /pinned-image -->
                            <div class="row justify-content-start">
                                <div class="col-lg-12">
                                    <div class="box_item_info" data-jarallax-element="-30">
                                        '.$occupancy.'
                                        <h2>' . $subpkgRow->title . '</h2>
                                        <p>' . $subpkgRow->detail . '</p>
                                        <div class="facilities clearfix">
                                            <ul>
                                                '.$subfeat.'
                                            </ul>
                                        </div>
                                        <div class="box_item_footer d-flex align-items-center justify-content-between">
                                            <a href="#0" class="btn_4 learn-more">
                                                <span class="circle">
                                                    <span class="icon arrow"></span>
                                                </span>
                                                <span class="button-text">Book Now</span>
                                            </a>
                                            
                                        </div>
                                        <!-- /box_item_footer -->
                                    </div>
                                    <!-- /box_item_info -->
                                </div>
                                <!-- /col -->
                            </div>
                            <!-- /row -->
                        </div>
                    ';
                }
            $room_package .= '

                            <div class="container margin_120_95 pb-0" id="first_section">
                                '. $roomlist .'
                            </div>
                    ';

            $room_package .=        $jVars['module:mservice-detail'];
            
            $room_package .= '    </main>';

        }
    } 
    else{
        
        $imglink = BASE_URL . 'template/web/images/bg/room-banner.jpg';
        $pkgRowImg = $pkgRow->banner_image;
        if ($pkgRowImg != "a:0:{}") {
            $pkgRowList = unserialize($pkgRowImg);
            $file_path = SITE_ROOT . 'images/package/banner/' . $pkgRowList[0];
            if (file_exists($file_path) and !empty($pkgRowList[0])) {
                $imglink = IMAGE_PATH . 'package/banner/' . $pkgRowList[0];
            }
        }

        $roombread .= '
        <main>

        <div class="hero medium-height jarallax" data-jarallax data-speed="0.2">
            <img class="jarallax-img" src="'. $imglink .'" alt="">
            <div class="wrapper opacity-mask d-flex align-items-center justify-content-center text-center animate_hero" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                <div class="container">
                    <small class="slide-animated one">' . $pkgRow->title . '</small>
                    <h1 class="slide-animated two">' . $pkgRow->sub_title . '</h1>
                </div>
            </div>
        </div>
        ';

        $sql = "SELECT *  FROM tbl_package_sub WHERE status='1' AND type = '{$pkgRow->id}' ORDER BY sortorder DESC ";

        $page = (isset($_REQUEST["pageno"]) and !empty($_REQUEST["pageno"])) ? $_REQUEST["pageno"] : 1;
        $limit = 200;
        $total = $db->num_rows($db->query($sql));
        $startpoint = ($page * $limit) - $limit;
        $sql .= " LIMIT " . $startpoint . "," . $limit;
        $query = $db->query($sql);
        $pkgRec = Subpackage::find_by_sql($sql);
        
        if (!empty($pkgRec)) {
            

            foreach ($pkgRec as $key => $subpkgRow) {
                $imageList = '';
                $carimg = '';
                $subfeat = '';
                
                $gallRec = SubPackageImage::getImagelist_by($subpkgRow->id);

                foreach ($gallRec as $row) {
                    $file_path = SITE_ROOT.'images/package/galleryimages/'.$row->image;
                    if(file_exists($file_path) and !empty($row->image)):
    
                        $carimg  .= '
                        <div class="pinned-image rounded_container pinned-image--medium">
                            <div class="pinned-image__container">
                                
                                <img src="'.IMAGE_PATH.'package/galleryimages/'.$row->image.'" alt="">

                                </div>
                        </div>
                        ';
                        
    
                    endif;
    
                
                }

                $saveRec = unserialize($subpkgRow->feature);
                $count = 1;
                if ($saveRec != null) {
                    $featureList = $saveRec[47][1];
                    if ($featureList) {

                        $i= 1;
                        foreach ($featureList as $fetRow) {

                            $icoRec = Features::get_by_id($fetRow);

                                $subfeat .= '
                                                <li>
                                                    <i class="' . $icoRec->icon . '"></i> ' . $icoRec->title . '
                                                </li>
                                ';
            
                            if($i >=8){
                                break;
                            }
                            $i++;
                        }

                    }
                }

                    $occupancy = (!empty($subpkgRow->occupancy))? '<small>Upto '.$subpkgRow->occupancy.' pax</small>' : '';
                    $roomlist .= '

                        <div class="row_list_version_1">
                            <div class="owl-carousel owl-theme carousel_item_x1">
                                '. $carimg .'
                            </div>
                            <!-- /pinned-image -->
                            <div class="row justify-content-start">
                                <div class="col-lg-12">
                                    <div class="box_item_info" data-jarallax-element="-30">
                                        <h2>' . $subpkgRow->title . '</h2>
                                        <p>' . $subpkgRow->detail . '</p>
                                        <div class="facilities clearfix">
                                            <ul>
                                                '.$subfeat.'
                                            </ul>
                                        </div>
                                        <div class="box_item_footer d-flex align-items-center justify-content-between">
                                            <a href="#0" class="btn_4 learn-more">
                                                <span class="circle">
                                                    <span class="icon arrow"></span>
                                                </span>
                                                <span class="button-text">Book Now</span>
                                            </a>
                                            
                                        </div>
                                        <!-- /box_item_footer -->
                                    </div>
                                    <!-- /box_item_info -->
                                </div>
                                <!-- /col -->
                            </div>
                            <!-- /row -->
                        </div>
                    ';
                }
            $room_package .= '

                            <div class="container margin_120_95 pb-0" id="first_section">
                                '. $roomlist .'
                            </div>
                    ';

            
            $room_package .= '    </main>';

        }
    } 

}

//homepage room section
if (defined('HOME_PAGE')) {



    $sql = "SELECT *  FROM tbl_package_sub WHERE status='1' AND type = '1' ORDER BY sortorder DESC ";

    $page = (isset($_REQUEST["pageno"]) and !empty($_REQUEST["pageno"])) ? $_REQUEST["pageno"] : 1;
    $limit = 200;
    $total = $db->num_rows($db->query($sql));
    $startpoint = ($page * $limit) - $limit;
    $sql .= " LIMIT " . $startpoint . "," . $limit;
    $query = $db->query($sql);
    $pkgRec = Subpackage::find_by_sql($sql);
    

    $pkgRoom = Package::getPackageByType(0);
    
    $otherroom='';
        $rooms = Subpackage::get_relatedsub_by(1,'',3);
            
        if(!empty($rooms)){
                
                    
            foreach($rooms as $room){
                $imglink ='';
                if (!empty($room->image)) {
                    $multiimg = unserialize($room->image);
                    
                    foreach($multiimg as $img123) {  
                        $file_path = SITE_ROOT . 'images/subpackage/' . $img123;
                        if (file_exists($file_path) && !empty($img123)) {
                            $imglink .= '
                            <a href="'.BASE_URL.$room->slug.'" class="box_cat_rooms">
                            <figure>
                            
                            <div class="background-image" data-background="url('. IMAGE_PATH . 'subpackage/' . $img123 .')"></div>
                            <div class="info">
                            <small>From '. $room->currency . $room->onep_price .'/night</small>
                            <h3>'.$room->title.'</h3>
                            <span>Read more</span>
                            </div>
                            </figure>
                            </a>
                            ';
                        }
                    }
                } else {
                    $imglink .= '
                        <a href="'.BASE_URL.$room->slug.'" class="box_cat_rooms">
                            <figure>
                                
                                <div class="background-image" data-background="url('. $jVars['site:default-image'] .')"></div>
                                <div class="info">
                                    <small>From '. $room->currency . $room->onep_price .'/night</small>
                                    <h3>'.$room->title.'</h3>
                                    <span>Read more</span>
                                </div>
                            </figure>
                        </a>
                    ';
                }

            
                $otherroom .='
                                <div class="col-4 item" data-cues="slideInUp" data-delay="300">
                                    <div class="owl-carousel owl-theme carousel_item_x1">
                                        '.$imglink .'
                                    </div> 
                                </div>
                        ';
            }
                    //$otherroom.='';
                $homerooms .='
                                    <div class="room-home ">
                                        <div class="container">
                                            <div class="title mb-4 center">
                                                <small data-cue="slideInUp">Luxury experience</small>
                                                <h2 data-cue="slideInUp" data-delay="200">Rooms & Suites</h2>
                                            </div>
                                            <div data-cues="zoomIn" data-delay="200">
                                                <div class="row rounded-img">  <!-- owl-carousel owl-theme carousel_item_3 -->
                                                    '. $otherroom .'
                                                </div>
                                                <!-- /carousel-->
                                            </div>
                                        </div>
                                    </div>
                    ';  
        }
}



$jVars['module:list-modalpop-up'] = $modalpopup;
$jVars['module:list-package-room'] = $room_package;
$jVars['module:list-package-room-bred'] = $roombread;

$jVars['module:list-package-home-room-bred'] = $homerooms;





/*
* Sub package 
*/
$resubpkgDetail = '';
$subimg = '';
$imageList = '';

if (defined('SUBPACKAGE_PAGE') and isset($_REQUEST['slug'])) {
    $slug = !empty($_REQUEST['slug']) ? addslashes($_REQUEST['slug']) : '';
    $subpkgRec = Subpackage::find_by_slug($slug);
     $gallRec = SubPackageImage::getImagelist_by($subpkgRec->id);
     $booking_code = Config::getField('hotel_code', true);
    if (!empty($subpkgRec)) {
        if ($subpkgRec->type == 1) {
            $relPacs = Subpackage::get_relatedpkg(1, $subpkgRec->id, 12);
            $imglink = '';
            if (!empty($subpkgRec->image2)) {
                $file_path = SITE_ROOT . 'images/subpackage/image/' . $subpkgRec->image2;
                if (file_exists($file_path)) {
                    $imglink = IMAGE_PATH . 'subpackage/image/' . $subpkgRec->image2;
                } else {
                    $imglink = $jVars['site:default-image'];
                }
            } else {
                $imglink = $jVars['site:default-image'];
            }
            
            $pkgRec = Package::find_by_id($subpkgRec->type);
            $subpkg_carousel = '';

            $bigimg ='';
            $bigimglink ='';

            foreach ($gallRec as $c => $row) {
                $file_path = SITE_ROOT.'images/package/galleryimages/'.$row->image;
                if(file_exists($file_path) and !empty($row->image)):

                    $subpkg_carousel .= '
                    <img class="" src="'.IMAGE_PATH.'package/galleryimages/'.$row->image.'" alt="">
                                ';
                    
                    $bigimg .='
                        <div class="item">
                            <img src="'.IMAGE_PATH.'package/galleryimages/'.$row->image.'" alt="">
                        </div>';

                    if($c == 0){
                        $bigimglink .='<a class="btn_1 outline" data-fslightbox="gallery_1" data-type="image" href="'.IMAGE_PATH.'package/galleryimages/'.$row->image.'">FullScreen Gallery</a>';
                    }else{
                        $bigimglink .='<a data-fslightbox="gallery_1" data-type="image" href="'.IMAGE_PATH.'package/galleryimages/'.$row->image.'"></a>';
                    }

                endif;

            
            }

                //breadcrumb
                $resubpkgDetail .= '

                <div class="hero full-height jarallax" data-jarallax data-speed="0.2">
                    <div class="owl-carousel owl-theme carousel_item_x2">
                        '.$subpkg_carousel.'
                    </div>
                    <div class="wrapper opacity-mask d-flex align-items-center  text-center animate_hero" data-opacity-mask="rgba(0, 0, 0, 0.5)" style="background:url('. $imglink .') no-repeat center center /cover;">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <small class="slide-animated one">Luxury Hotel Experience</small>
                                    <h1 class="slide-animated two">'. $subpkgRec->title .'</h1>
                                    <p class="slide-animated three">'. $subpkgRec->short_title .'</p>
                                </div>
                            </div>
                        </div>
                        <div class="mouse_wp slide-animated four">
                            <a href="#first_section" class="btn_explore">
                                <div class="mouse"></div>
                            </a>
                        </div>
                        <!-- / mouse -->
                    </div>

                    
                </div>';

                $resubpkgDetail .= $jVars['module:booking-subpkg-room'];

                $feature_list ='';
                if (!empty($subpkgRec->feature)) {
                    $ftRec = unserialize($subpkgRec->feature);
                    if (!empty($ftRec)) {

                            foreach ($ftRec as $k => $v) {
                                // $resubpkgDetail .= '<h3 class="room_d_title">' . $v[0][0] . '</h3>';
                                if (!empty($v[1])) {
                                    $sfetname='';
                                    $i=1;
                                    foreach ($v[1] as $kk => $vv) {
                                        $sfetname = Features::find_by_id($vv);
                                        if(!empty($sfetname->icon)){
                                            $feature_list .= '<li><i class="' . $sfetname->icon . '"></i> ' . $sfetname->title . '</li>';
                                            $i++;
                                            if($i%12 == 0){
                                                break;
                                            }
                                        }
                                    }
                                }                             
                            }
                     
                    }
                }

                $resubpkgDetail .='
                               
                    <div class="bg_white" id="first_section" style="background-image: url('.BASE_URL.'template/web/img/texture.jpg); background-size: cover;">
                        <div class="container margin_120_95">
                            <div class="row justify-content-between">
                                <div class="col-lg-4">
                                    <div class="title">
                                        <small>'. $subpkgRec->title .'</small>
                                        <h2>'. $subpkgRec->short_title .'</h2>
                                    </div>
                                    '. $subpkgRec->content .'
                                </div>
                                <div class="col-lg-6">
                                    <div class="room_facilities_list">
                                        <ul data-cues="slideInLeft">
                                            '.$feature_list.'
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- /row -->
                        </div>
                        <!-- /container -->
                    </div>
                ';

                $resubpkgDetail .= '
                    <div class="bg_white add_bottom_120">
                        <div class="container-fluid p-lg-0">
                            <div data-cues="zoomIn">
                                <div class="owl-carousel owl-theme carousel_item_centered kenburns rounded-img">
                                    '. $bigimg .'
                                </div>
                            </div>
                            <div class="text-center mt-5">
                                '. $bigimglink .'
                            </div>
                        </div>
                    </div>
                ';



                    $otherroom='';
                    $rooms = Subpackage::get_relatedsub_by($subpkgRec->type,$subpkgRec->id,3);
                        
                            
                    if(!empty($rooms)){
                            
                                
                                foreach($rooms as $room){
                                    if (!empty($room->image)) {
                                        $img123 = unserialize($room->image);
                                        
                                        if (file_exists($file_path) && !empty($img123[0])) {
                                            $imglink = IMAGE_PATH . 'subpackage/' . $img123[0];
                                            $file_path = SITE_ROOT . 'images/subpackage/' . $img123[0];
                                        } else {
                                            $imglink = IMAGE_PATH . 'static/static.jpg';
                                        }
                                    } else {
                                        $imglink = IMAGE_PATH . 'static/static.jpg';
                                    }

                                
                                    $otherroom .='
                                                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                        <a href="'.BASE_URL.$room->slug.'" class="box_cat_rooms">
                                                            <figure>
                                                                <div class="background-image" data-background="url('.$imglink.')"></div>
                                                                <div class="info">
                                                                    <small>From '. $room->currency . $room->onep_price .'/night</small>
                                                                    <h3>'.$room->title.'</h3>
                                                                    <span>Read more</span>
                                                                </div>
                                                            </figure>
                                                        </a>
                                                    </div>
                                            ';
                                    
                                }
                                //$otherroom.='';
                            $resubpkgDetail .='

                                                <div class="bg_white">
                                                    <div class="container margin_120_95">
                                                        <div data-cue="slideInUp">
                                                            <div class="title">
                                                                <small>Hotel Country Villa</small>
                                                                <h2>Similar Rooms</h2>
                                                            </div>
                                                            <div class="row" data-cues="slideInUp" data-delay="800">
                                        
                                                                    '. $otherroom .'
                                                                
                                                            </div>
                                                            <!-- /row-->
                                                        </div>
                                                    </div>
                                                </div>
                                ';  
                    }


                    $resubpkgDetail .='    </main>';


           
        }elseif($subpkgRec->type == 12){
            $relPacs = Subpackage::get_relatedpkg(1, $subpkgRec->id, 12);
            $imglink = '';
            if (!empty($subpkgRec->image2)) {
                $file_path = SITE_ROOT . 'images/subpackage/image/' . $subpkgRec->image2;
                if (file_exists($file_path)) {
                    $imglink = IMAGE_PATH . 'subpackage/image/' . $subpkgRec->image2;
                } else {
                    $imglink = $jVars['site:default-image'];
                }
            } else {
                $imglink = $jVars['site:default-image'];
            }
            
            $pkgRec = Package::find_by_id($subpkgRec->type);
            $subpkg_carousel = '';

            $bigimg ='';
            $bigimglink ='';

            foreach ($gallRec as $c => $row) {
                $file_path = SITE_ROOT.'images/package/galleryimages/'.$row->image;
                if(file_exists($file_path) and !empty($row->image)):
                    $subpkg_carousel .= '
                    <div class="owl-slide background-image cover" data-background="url('.IMAGE_PATH.'package/galleryimages/'.$row->image.')">
                        <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                            <div class="container">
                                <div class="row justify-content-center justify-content-md-start">
                                    <div class="col-lg-6 static">
                                        <div class="slide-text white">
                                            <small class="owl-slide-animated owl-slide-title">Restaurant Experience</small>
                                            <h2 class="owl-slide-animated owl-slide-title-2">'.$row->title.'</h2>
                                            <div class="owl-slide-animated owl-slide-title-3"><a class="btn_1 outline white mt-3" href="#first_section">Read more</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                                ';
                    
                    $bigimg .='
                        <div class="item">
                            <img src="'.IMAGE_PATH.'package/galleryimages/'.$row->image.'" alt="">
                        </div>';

                    if($c == 0){
                        $bigimglink .='<a class="btn_1 outline" data-fslightbox="gallery_1" data-type="image" href="'.IMAGE_PATH.'package/galleryimages/'.$row->image.'">FullScreen Gallery</a>';
                    }else{
                        $bigimglink .='<a data-fslightbox="gallery_1" data-type="image" href="'.IMAGE_PATH.'package/galleryimages/'.$row->image.'"></a>';
                    }

                endif;

            
            }
                //breadcrumb
                $resubpkgDetail .= '
                
                <main>

                    <div id="carousel-home">
                        <div class="owl-carousel owl-theme kenburns">
                            '. $subpkg_carousel .'
                        </div>
                        <div class="mouse_wp">
                            <a href="#first_section" class="btn_scrollto">
                                <div class="mouse"></div>
                            </a>
                        </div>
                        <!-- / mouse -->
                    </div>
                
                ';
                $resubpkgDetail .= '
                    <div class="container margin_120_95">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-lg-5">
                                <div class="intro">
                                    <div class="title">
                                        <small>Dining Experience</small>
                                        <h2>'.$subpkgRec->title.'</h2>
                                    </div>
                                    '.$subpkgRec->content.'
                                </div>
                            </div>
                        <div class="col-lg-5">
                            <div>
                                <ul class="list-unstyled mb-4">
                                    <li class="d-flex justify-content-between mb-2 text-end">
                                        <strong>Breakfast</strong> <span>'.$subpkgRec->occupancy.'</span>
                                    </li>
                                    <li class="d-flex justify-content-between mb-2 text-end">
                                        <strong>Lunch</strong>  <span>'.$subpkgRec->view.'</span>
                                    </li>
                                    <li class="d-flex justify-content-between mb-2 text-end">
                                        <strong>Dinner</strong>  <span>'.$subpkgRec->cocktail.'</span>
                                    </li>
                                </ul>
                                <p class="phone_element"><a href="tel://+97716680127"><i class="bi bi-telephone"></i><span><em>Reservations</em>+977 1 6680127 / 28</span></a></p>
                            </div>
                            </div>
                        </div>
                        <!-- /Row -->
                    </div>
                
                ';
                

                $resubpkgDetail .= $subpkgRec->below_content;
                
                $feature_list ='';
                if (!empty($subpkgRec->feature)) {
                    $ftRec = unserialize($subpkgRec->feature);
                    if (!empty($ftRec)) {

                            foreach ($ftRec as $k => $v) {
                                // $resubpkgDetail .= '<h3 class="room_d_title">' . $v[0][0] . '</h3>';
                                if (!empty($v[1])) {
                                    $sfetname='';
                                    $i=1;
                                    foreach ($v[1] as $kk => $vv) {
                                        $sfetname = Features::find_by_id($vv);
                                        if(!empty($sfetname->icon)){
                                            $feature_list .= '<li><i class="' . $sfetname->icon . '"></i> ' . $sfetname->title . '</li>';
                                            $i++;
                                            if($i%12 == 0){
                                                break;
                                            }
                                        }
                                    }
                                }                             
                            }
                     
                    }
                }


                    $resubpkgDetail .='    </main>';


           
        }




    }
}

$jVars['module:sub-package-detail'] = $resubpkgDetail;



/**********        For What;s nearby from package **************/
$resubpkgDetail = '';
$relPacs = Subpackage::get_relatedpkg(10, 0, 12);

                foreach($relPacs as $relPac){
                   
                        $imglink = '';
                        if (!empty($relPac->image)) {
                            $img123 = unserialize($relPac->image);
                            $file_path = SITE_ROOT . 'images/subpackage/' . $img123[0];
                            if (file_exists($file_path)) {
                                $imglink = IMAGE_PATH . 'subpackage/' . $img123[0];
                            } else {
                                $imglink = IMAGE_PATH . 'static/default-art-pac-sub.jpg';
                            }
                        } else {
                            $imglink = IMAGE_PATH . 'static/default-art-pac-sub.jpg';
                        }
                        $resubpkgDetail .= '

                                            <div class="col-lg-3 col-md-6">
                                                <div class="top-hotels-ii">
                                                    <img src="'. $imglink .'" alt=" '. $relPac->title .'"/>
                                                    '. $relPac->content .'
                                                    <div class="pp-details yellow">
                                                        <span class="pull-left">More Info</span>
                                                        <span class="pp-tour-ar">
                                                                <a href="javascript:void(0)"><i class="fa fa-angle-right pad-0"></i></a>
                                                            </span>
                                                    </div>
                                                </div>
                                            </div>
                                        ';

                        

                }

$whats_nearby = '
            <section class="top-hotel">
                <div class="container-xxl px-5">
                    <div class="top-title">
                        <div class="row display-flex">
                            <div class="col-lg-8 mx-auto text-center">
                                <h2>What\'s <span>Nearby</span></h2>
                                <p class="mar-0">
                                    We are located at the heart of Lalitpur. Major shopping outlets, Patan Durbar Square, Hospitals, Banks, UN office, Government offices, etc are
                                    within walking distance.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!--Gallery Section-->
                    <div class="row activities-slider">
                        '. $resubpkgDetail .'
                    </div>
                </div>
            </section>';

$jVars['module:whats-nearby'] = $whats_nearby;

                    
                        
                        



