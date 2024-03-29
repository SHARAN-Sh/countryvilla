<?php
/*
* Service home list
*/
$rescont = $ressercont = $mainservice ='';
$i = 0;
$j = 0;
$subpkgRec = Services::getservice_list(4);
// var_dump($subpkgRec); die();
if (defined('INNER_PAGE')) {
    if (!empty($subpkgRec)) {

        foreach ($subpkgRec as $k => $v) {
            $imglink = '';
            if ($v->image != "a:0:{}") {
                $imageList = unserialize($v->image);
                $file_path = SITE_ROOT . 'images/services/' . $imageList[0];
                if (file_exists($file_path)) {
                    $imglink = IMAGE_PATH . 'services/' . $imageList[0];
                }
            }
            $actv = ($i == 0) ? 'active' : '';
            $rescont .= '<li class="' . $actv . '">
                                                <a href="#coffe-shop' . $v->id . '" data-toggle="tab">
                                                    <img src="' . $imglink . '">
                                                    <h4>' . $v->title . '</h4>
                                                </a>
                                            </li>';
            $i++;
        }
        foreach ($subpkgRec as $k => $v) {

            if(!empty($v->icon)){
                $content = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($v->content));
                $actv1 = ($j == 0) ? 'active' : '';
                $ressercont .= '
                                    <div class="col-lg-3 col-md-6">
                                        <div class="box_facilities no-border" data-cue="slideInUp">
                                            <i class="' . $v->icon . '"></i>
                                            <h3>' . $v->title . '</h3>
                                            <p>' . strip_tags($v->content) . '</p>
                                        </div>
                                    </div>
                                    
                                    ';
                $j++;
            }else{
                $imglink = '';
                if ($v->image != "a:0:{}") {
                    $imageList = unserialize($v->image);
                    $file_path = SITE_ROOT . 'images/services/' . $imageList[0];
                    if (file_exists($file_path)) {
                        $imglink = IMAGE_PATH . 'services/' . $imageList[0];
                    }
                }
                $actv = ($i == 0) ? 'active' : '';
                $ressercont .= '
                                                <div class="col-lg-3 col-md-6">
                                                    <div class="box_facilities no-border" data-cue="slideInUp">
                                                    <img src="' . $imglink . '">
                                                    <h3>' . $v->title . '</h3>
                                                        <p>' . strip_tags($v->content) . '</p>
                                                    </div>
                                                </div>
                                                ';

            }
        }

        $mainservice = '
            <div class="title text-center mb-5">
                <small data-cue="slideInUp">Hotel Country Villa</small>
                <h2 data-cue="slideInUp" data-delay="100">Main Facilities</h2>
            </div>
            <div class="row mt-4">
                '.$ressercont .'
            </div>
        ';
    }
}

if (defined('PACKAGE_PAGE')) {
    if (!empty($subpkgRec)) {

    
        foreach ($subpkgRec as $k => $v) {

            if(!empty($v->icon)){
                $content = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($v->content));
                $actv1 = ($j == 0) ? 'active' : '';
                $ressercont .= '
                                    
                                    <div class="col-xl-3 col-lg-6 col-md-6 col-6">
                                        <div class="box_facilities white no-border" data-cue="slideInUp">
                                            <i class="' . $v->icon . '"></i>
                                            <h3>' . $v->title . '</h3>
                                        </div>
                                    </div>
                                    ';
                $j++;
            }else{
                $imglink = '';
                if ($v->image != "a:0:{}") {
                    $imageList = unserialize($v->image);
                    $file_path = SITE_ROOT . 'images/services/' . $imageList[0];
                    if (file_exists($file_path)) {
                        $imglink = IMAGE_PATH . 'services/' . $imageList[0];
                    }
                }
                $actv = ($i == 0) ? 'active' : '';
                $ressercont .= '
 
                                                <div class="col-xl-3 col-lg-6 col-md-6 col-6">
                                                    <div class="box_facilities white no-border" data-cue="slideInUp">
                                                        <img src="' . $imglink . '">
                                                        <h3>' . $v->title . '</h3>
                                                    </div>
                                                </div>
                                                ';

            }
        }

        $mainservice = '

            <div class="pinned-image pinned-image--medium">
                <div class="pinned-image__container">
                <img src="'. BASE_URL .'template/web/img/parallax_bg.jpg" alt="">
                    <div class="pinned-image__container-overlay"></div>
                </div>
                <div class="pinned_over_content">
                    <div class="title white center mb-5">
                            <small data-cue="slideInUp">Hotel Country Villa</small>
                            <h2 data-cue="slideInUp" data-delay="100">Main Facilities</h2>
                        </div>
                    <div class="row mt-4">
                        '.$ressercont .'
                    </div>
                    <!-- /Row -->
                </div>
            </div>
            ';
    }
}


$jVars['module:service-list'] = $rescont;
$jVars['module:service-content-list'] = $mainservice;


$restscont = '';

$servpkgRec = Services::find_all();
// var_dump($subpkgRec); die();
if (isset($_REQUEST['slug']) and !empty($_REQUEST['slug'])) {
    $slug = $_REQUEST['slug'];
} else {
    $slug = 'health-club';
}
if (!empty($subpkgRec)) {
    $i = 0;
    $j = 0;
    $restscont .= '<div class="tab-section bg-gray body-room-5">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center">
                            <h2 class="mb-0">Services</h2>
                            <ul class="pages-link">
                                <li><a href="' . BASE_URL . 'home">Home</a></li>
                                <li>/</li>
                                <li>Services</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="dining-tabs">
                        <ul class="nav nav-tabs">';
    foreach ($servpkgRec as $key => $serRec) {
        if ($slug == $serRec->slug) {
            $class = "active";
        } else {
            $class = "";
        }
        $actv = ($i == 0) ? 'active' : '';
        $restscont .= '<li class="' . $class . '">
                                <a href="#Sauna' . $serRec->id . '" id="' . $serRec->slug . '" role="tab" data-toggle="tab">' . $serRec->title . '<small class="d-block">' . $serRec->sub_title . '</small></a>
                            </li>';
        $i++;
    }
    $restscont .= '  </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="block small-padding both-padding page">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="tab-content">';
    foreach ($servpkgRec as $key => $serRec) {
        $imageList = '';
        if ($serRec->image != "a:0:{}") {
            $imageList = unserialize($serRec->image);
        }
        if ($slug == $serRec->slug) {
            $class1 = "active";
        } else {
            $class1 = "";
        }
        $actv = ($j == 0) ? 'active' : '';
        $restscont .= '<div role="tabpanel" class="tab-pane fade in ' . $class1 . '" id="Sauna' . $serRec->id . '">
                                <div class="dining-detail">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="dining-detail-carousel">';
        // var_dump($imageList); die();
        if ($serRec->image != "a:0:{}") {
            foreach ($imageList as $key => $imgServ) {
                $restscont .= ' <div class="item">
											<img src="' . IMAGE_PATH . 'services/' . $imgServ . '" alt="' . $serRec->title . '" />
										</div>';
            }
        }
        $restscont .= ' </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="service-content">
                                               ' . substr(strip_tags($serRec->content), 0, 30000) . '
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>';
        $j++;
    }
    $restscont .= '</div>
                    </div>
                </div>
            </div><!-- container -->
        </div><!-- block -->';


}

$jVars['module:service-detail-list'] = $restscont;

$facility_bread='';
if (defined('FACILITY_PAGE')) {
    $siteRegulars = Config::find_by_id(1);
    $imglink= $siteRegulars->facility_upload ;
    // pr($imglink);
if(!empty($imglink)){
    $img= IMAGE_PATH . 'preference/facility/' . $siteRegulars->facility_upload ;
}
else{
    $img='';
}

    $facility_bread='<div class="mad-breadcrumb with-bg-img with-overlay" data-bg-image-src="'.$img.'">
    <div class="container wide">
        <h1 class="mad-page-title">Hotel Amenities</h1>
        <nav class="mad-breadcrumb-path">
            <span><a href="index.html" class="mad-link">Home</a></span> /
            <span>Facilities</span>
        </nav>
    </div>
</div>';

}
$jVars['module:facilitybread'] = $facility_bread;

$facility = "";
if (defined('FACILITY_PAGE')) {


    $record = Services::getservice_list();
    if (!empty($record)) {
        $count = $countsec = 0;
        foreach ($record as $recRow) {
            if(!empty($recRow->icon)){
                $facility .= ' 
                <div class="mad-col">
                                <!--================ Icon Box ================-->
                                <article class="mad-icon-box">
                                span class="' . $recRow->icon . '"></span>
                                    <div class="mad-icon-box-content">
                                        <h6 class="mad-icon-box-title">
                                        ' . $recRow->title . '
                                        </h6>
                                    </div>
                                </article>
                                <!--================ End of Icon Box ================-->
                            </div>
                
                ';
            }else{

                $img = unserialize($recRow->image);
                $file_path = SITE_ROOT . 'images/services/' . $img[0];
                if (file_exists($file_path) && $img[0] != NULL) {
                    $imglink = IMAGE_PATH . 'services/' . $img[0];
                    $facility .= ' 
                    <div class="mad-col">
                                <!--================ Icon Box ================-->
                                <article class="mad-icon-box">
                                    <img src="' . $imglink . '" alt = '. $recRow->title .'>
                                    <div class="mad-icon-box-content">
                                        <h6 class="mad-icon-box-title">
                                        ' . $recRow->title . '
                                        </h6>
                                    </div>
                                </article>
                                <!--================ End of Icon Box ================-->
                            </div>


                    ';
                }
            }
        }
    }


}

$jVars['module:facility-list'] = $facility;



/*
* Service Page
*/
$rescont = '';


    $rescont .= '';


    $subpkgRec = services::find_8();    

    if (!empty($subpkgRec)) {
        $rescont .= '';
        foreach ($subpkgRec as $k => $v) {
            $img_nm = unserialize($v->image);
            $rescont .= '
            
                        
                        ';
            
            
        }
        $rescont .= '';

    }

// pr($rescont_left);
$rescont_final = '
                    <!-- detail features starts -->
                    <div class="mad-section mad-section.no-pb">
                    <div class="row justify-content-center">
                        <div class="col-xxl-10">
                            <div class="mad-title-wrap align-center">
                                <div class="mad-pre-title">The Advantages</div>
                                <h2 class="mad-section-title">Amenities and Facilities</h2>
                            </div>
                            <!--================ Icon Boxes ================-->
                            <div class="mad-icon-boxes align-center small-size item-col-5">
                                    '. $rescont .'
                                    </div>
                                    <!--================ End of Icon Boxes ================-->
                                </div>
                            </div>
                        </div>';
$jVars['module:service-homepage'] = $rescont_final;
$facilityhome = "";



if (defined('FACILITY_PAGE')) {


    $record = Services::getservice_list(30);
    if (!empty($record)) {
        foreach ($record as $recRow) {
            if(!empty($recRow->icon)){
                $facilityhome .= ' 
                <div class="mad-col">
            <!--================ Icon Box ================-->
            <article class="mad-icon-box">
                <img src="' . $imglink . '" alt="'. $recRow->title .'">
                <div class="mad-icon-box-content">
                    <h6 class="mad-icon-box-title">
                    '. $recRow->title .'
                    </h6>
                </div>
            </article>
            <!--================ End of Icon Box ================-->
        </div> 
                ';
            }else{

                $img = unserialize($recRow->image);
                $file_path = SITE_ROOT . 'images/services/' . $img[0];
                if (file_exists($file_path) && $img[0] != NULL) {
                    $imglink = IMAGE_PATH . 'services/' . $img[0];
                    $facilityhome .= '
                    <div class="mad-col">
            <!--================ Icon Box ================-->
            <article class="mad-icon-box">
                <img src="' . $imglink . '" alt="'. $recRow->title .'">
                <div class="mad-icon-box-content">
                    <h6 class="mad-icon-box-title">
                    '. $recRow->title .'
                    </h6>
                </div>
            </article>
            <!--================ End of Icon Box ================-->
        </div> 
                    ';
                }
            }
        }
    }


}
$jVars['module:facility-list-home'] = $facilityhome;




$rescont = $ressercont = $mainservice ='';

if (defined('HOME_PAGE')) {
    $subpkgRec = Services::getservice_list(8);

    if (!empty($subpkgRec)) {

        foreach ($subpkgRec as $k => $v) {

            if(!empty($v->icon)){
                $content = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($v->content));
                $actv1 = ($j == 0) ? 'active' : '';
                $ressercont .= '
                                    <div class="col-xl-3 col-lg-6 col-md-6 col-6">
                                        <div class="box_facilities white" data-cue="slideInUp">
                                            <i class="' . $v->icon . '"></i>
                                            <h3>' . $v->title . '</h3>
                                        </div>
                                    </div>
                                    
                                    ';
                $j++;
            }else{
                $imglink = '';
                if ($v->image != "a:0:{}") {
                    $imageList = unserialize($v->image);
                    $file_path = SITE_ROOT . 'images/services/' . $imageList[0];
                    if (file_exists($file_path)) {
                        $imglink = IMAGE_PATH . 'services/' . $imageList[0];
                    }
                }
                $actv = ($i == 0) ? 'active' : '';
                $ressercont .= '

                                                <div class="col-xl-3 col-lg-6 col-md-6 col-6">
                                                    <div class="box_facilities white" data-cue="slideInUp">
                                                        <img src="' . $imglink . '">
                                                        <h3>' . $v->title . '</h3>
                                                    </div>
                                                </div>
                                                ';

            }
        }

        $mainservice = '
            <div class="pinned-image pinned-image--medium">
            <div class="pinned-image__container">
               <!-- <img src="img/parallax_bg.jpg" alt=""> -->
               <!-- <img src="img/home.jpg" alt=""> -->
    
               <video autoplay muted loop width="100%"  class="img-fluid rounded overflow-hidden">
                    <source src="'.BASE_URL.'template/web/drn.mp4" type="video/mp4">
                    <button onclick="toggleAudio()">Unmute</button>
                </video>
                
                <script>
                function toggleAudio() {
                    var video = document.querySelector(\'video\');
                    if (video.muted) {
                        video.muted = false;
                        document.querySelector(\'button\').innerHTML = \'Mute\';
                    } else {
                        video.muted = true;
                        document.querySelector(\'button\').innerHTML = \'Unmute\';
                    }
                }
                </script>
               
                <div class="pinned-image__container-overlay"></div>
            </div>
            <div class="pinned_over_content">
                
                <div class="row mt-4">
                    <div class="col-sm-6 mx-auto">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="title white center mb-5 pb-3">
                                    <small data-cue="slideInUp">Hotel Country Villa</small>
                                    <h2 data-cue="slideInUp" data-delay="100">Our Facilities</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            '.$ressercont .'
                        </div>
                    </div>
                </div>
                <!-- /Row -->
            </div>
        </div>
        ';
    }
}

$jVars['module:service-list-home'] = $mainservice;

?>