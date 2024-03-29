<?php
/* First Slideshow */
$reslide= $slideshow ='';

$Records = Slideshow::getSlideshow_by(0);

// pr($Records);
if($Records) {
    $reslide.='';
        foreach($Records as $RecRow) {
           
            $file_path = SITE_ROOT.'images/slideshow/'.$RecRow->image;
            if(file_exists($file_path) and !empty($RecRow->image)) {
                $reslide.='
                <div class="owl-slide background-image cover" data-background="url('.IMAGE_PATH.'slideshow/'.$RecRow->image.')">
                    <div class="opacity-mask d-flex align-items-center justify-content-md-end">
                        <div class="container">
                            <div class="row justify-content-end">
                                <div class="col-lg-6 static">
                                    <div class="slide-text white text-end">
                                        <small class="owl-slide-animated owl-slide-title">'.strip_tags($RecRow->content).'</small>
                                        <h2 class="owl-slide-animated owl-slide-title-2">'.$RecRow->title.'</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ';

            }
        }
    $reslide.='';
    $slideshow = '
    <div id="carousel-home">
        <div class="owl-carousel owl-theme kenburns">
            '. $reslide .'      
        </div>

        <div class="wrapper position-absolute d-flex align-items-center justify-content-center text-center animate_hero is-transitioned" style="bottom:50px;width:100%;z-index:2" >
            '.$jVars['module:booking--homepage'].'
            
            <!-- /mouse_wp -->
        </div>
        <div class="mouse_wp">
            <a href="#first_section" class="btn_scrollto">
                <div class="mouse"></div>
            </a>
        </div>

        <!-- / mouse -->
    </div>
    ';
}
$jVars['module:slideshow']= $slideshow;
?>