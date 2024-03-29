<?php 

/*
* Testimonial List Home page
*/
$restst = '';   
$stylecss ='';

$tstRec = Testimonial::get_alltestimonial(8);
if (!empty($tstRec)) {
    $restst .= '';
    foreach ($tstRec as $count => $tstRow) {
        $slink = !empty($tstRow->linksrc) ? $tstRow->linksrc : 'javascript:void(0);';
        $target = !empty($tstRow->linksrc) ? 'target="_blank"' : '';
        $rating = '';
        for ($i = 0; $i < $tstRow->type; $i++){
            $rating.='<a href="#"><i class="fa-solid fa-star"></i></a>';
        }
        $stylecss .= '        
        <style>
        .carousel_testimonials.owl-theme .owl-dots .owl-dot:nth-child('. ($count+1) .') span::before{
            background-image: url('.IMAGE_PATH . 'testimonial/'. $tstRow->image .') !important;
        }
        </style>';

        $restst .= '

            <div class="item">
                <div class="box_overlay">
                    
                    <div class="comment">
                        ' . strip_tags($tstRow->content) . '
                        <br> <a href="#">' . $tstRow->via_type . '</a>
                    </div>
                </div>
                <!-- End box_overlay -->
            </div>';

            $restst .= '';
    }
    $restst .= '';
}

$result_last ='
                <div class="parallax_section_1 jarallax" data-jarallax data-speed="0.2">
                    <img class="jarallax-img kenburns-2" src="'. $jVars['site:default-image'] .'" alt="">
                    <div class="wrapper opacity-mask d-flex align-items-center justify-content-center text-center" data-opacity-mask="rgb(0 0 0 / 34%)">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-10">
                                    <div class="title white">
                                        <small class="mb-1">Testimonials</small>
                                        <h2>What Clients Say</h2>
                                    </div>
                                    <div class="carousel_testimonials owl-carousel owl-theme nav-dots-orizontal">
                                        '. $restst .'
                                    </div>
                                    <!-- End carousel_testimonials -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                ';


$jVars['module:testimonial-style'] = $stylecss;
$jVars['module:testimonialList123'] = $result_last;



/*
* Testimonial Header Title
*/
$tstHtitle='';

if(defined('HOME_PAGE')) {
    $tstHtitle.='<section class="promo_full">
    <div class="promo_full_wp">
        <div>
            <h3>What Guest say</h3>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="carousel_testimonials">';
    $tstRec = Testimonial::get_alltestimonial();
    if(!empty($tstRec)) {        
        foreach($tstRec as $tstRow) {
            $tstHtitle.='<div>
                                <div class="box_overlay">
                                    <div class="pic">
                                        <figure><img src="'.IMAGE_PATH.'testimonial/'.$tstRow->image.'" alt="'.$tstRow->name.'" class="img-circle"></figure>
                                        <h4>'.$tstRow->name.'</h4>
                                    </div>
                                    <div class="comment">
                                       '.strip_tags($tstRow->content).'
                                    </div>
                                </div><!-- End box_overlay -->
                            </div>';
        }
    $tstHtitle.='</div><!-- End carousel_testimonials -->
                    </div><!-- End col-md-8 -->
                </div><!-- End row -->
            </div><!-- End container -->
        </div><!-- End promo_full_wp -->
    </div><!-- End promo_full -->
    </section><!-- End section -->';
 }
}
$jVars['module:testimonial-title'] = $tstHtitle;


/*
* Testimonial Rand
*/
$tstHead='';

$tstRand = Testimonial::get_by_rand();
if(!empty($tstRand)) {
	$tstHead.='<!-- Quote | START -->
	<div class="section quote fade">
		<div class="center">
	    
	        <div class="col-1">
	        	<div class="thumb"><img src="'.IMAGE_PATH.'testimonial/'.$tstRand->image.'" alt="'.$tstRand->name.'"></div>
	            <h5><em>'.strip_tags($tstRand->content).'</em></h5>
	            <p><span><strong>'.$tstRand->name.', '.$tstRand->country.'</strong> (Via : '.$tstRand->via_type.')</span></p>
	        </div>
	        
	    </div>
	</div>
	<!-- Quote | END -->';
}

$jVars['module:testimonial-rand'] = $tstHead;


/*
* Testimonial List
*/
$restst='';
$tstRec = Testimonial::get_alltestimonial(9);
if(!empty($tstRec)) {
	$restst.='<div class="clients_slider owl-carousel" id="testi-slider">';

        foreach($tstRec as $tstRow) {
            $slink = !empty($tstRow->linksrc)?$tstRow->linksrc:'javascript:void(0);';
            $target = !empty($tstRow->linksrc)?'target="_blank"':'';

            
            $restst.='<div class="item">
                        <div class="media">
                        <div class="col-md-3 col-sm-3">
                            <div class="test-img">
                                <a href="'.$slink.'" '.$target.'>
                                    <img src="'.IMAGE_PATH.'testimonial/'.$tstRow->image.'" alt="'.$tstRow->name.'" class="img-responsive">
                                </a>
                            </div>
                            </div>
                            
                            <div class="col-md-9 col-sm-9">
                            <div class="media-body test">
                                <p><i>“</i>'.strip_tags($tstRow->content).'</p>
                                <a href="'.$slink.'" '.$target.'>
                                    <h4>'.$tstRow->name.'</h4>
                                </a>
                            </div>
                            </div>
                        </div>
                    </div>';
        }
    $restst.='</div>';
}

$jVars['module:testimonialList'] = $restst;
?>