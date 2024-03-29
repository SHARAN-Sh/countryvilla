<?php
$reslgall = '';

$gallRec = Gallery::getParentgallery(2);
if (!empty($gallRec)) {
foreach ($gallRec as $gallRow) {
$childRec = GalleryImage::getGalleryImages($gallRow->id);
if (!empty($childRec)) {
$reslgall .= '';
foreach ($childRec as $childRow) {
$file_path = SITE_ROOT . 'images/gallery/galleryimages/' . $childRow->image;
if (file_exists($file_path) and !empty($childRow->image)) {
    $reslgall .= '
                <div class="item">
                    <div class="position-re o-hidden"> 
                        <img src="' . IMAGE_PATH . 'gallery/galleryimages/' . $childRow->image . '" alt="">
                    </div>
                </div>
                    ';
}
}
$reslgall .= '';
}
}
}

$res_gallery = '

                <section class="news news-home">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="owl-carousel owl-theme">
                                '. $reslgall .'
                            </div>
                        </div>
                    </div>
                </section>
                ';

$jVars['module:galleryHome'] = $res_gallery;



$dininggallery = '';
$galldining = GalleryImage::getImagelist_by(19, 3);
if (!empty($galldining)) {
    $dininggallery .= '<div class="row about">
                     <div class="demo-gallery">
    		     <div id="lightgallery" class="list-unstyled">';
    foreach ($galldining as $row) {
        $dininggallery .= '<div class="item col-sm-4 col-xs-12" data-responsive="' . IMAGE_PATH . 'gallery/galleryimages/' . $row->image . '" data-src="' . IMAGE_PATH . 'gallery/galleryimages/' . $row->image . '" data-sub-html="<h4>' . $row->title . '</h4>">
                        <a href="">
                            <img src="' . IMAGE_PATH . 'gallery/galleryimages/' . $row->image . '"/>
                        </a>
                    </div>';
    }
    $dininggallery .= '</div>
    </div>
    </div>';
}
$jVars['module:dining-gallery'] = $dininggallery;

$gallerybread='';
$siteRegulars = Config::find_by_id(1);
$imglink= $siteRegulars->gallery_upload ;
if(!empty($imglink)){
    $img= IMAGE_PATH . 'preference/gallery/' . $siteRegulars->gallery_upload ;
}
else{
    $img='';
}

$gallerybread='
<div class="hero medium-height jarallax" data-jarallax data-speed="0.2">
    <img class="jarallax-img" src="'.$img.'" alt="">
    <div class="wrapper opacity-mask d-flex align-items-center justify-content-center text-center animate_hero" data-opacity-mask="rgba(0, 0, 0, 0.5)">
        <div class="container">
            <small class="slide-animated one">Luxury Hotel Experience</small>
            <h1 class="slide-animated two">Gallery</h1>
        </div>
    </div>
</div>
';

$jVars['module:gallery-bread'] = $gallerybread;

/**
 *      Main Gallery
 */
$thegal = $gallerylistbread = $thegalnav= '';
$gallRectit = Gallery::getParentgallery(1);
$galpagination = '';


if ($gallRectit) {
    // $thegal .= '';
    // foreach ($gallRectit as $row) {
    //     $thegalnav .= '
    //     <li class="col-md" data-class="' . $row->id . '">' . $row->title . '</li>';
    // }
    $thegal .= '';

    // $thegal .= '
    //     <div id="gallery" class="gallery full-gallery de-gallery gallery-3-cols">
    // ';
    foreach ($gallRectit as $row) {
        $limit = 6;
        $page = (isset($_REQUEST["pageno"]) and !empty($_REQUEST["pageno"]))? $_REQUEST["pageno"] : 1;
        $total = count(GalleryImage::getGalleryImages($row->id));
        
        $startpoint = ($page * $limit) - $limit; 

        $gallRec = GalleryImage::getGalleryImages($row->id,$limit,$startpoint);
        
        
        foreach ($gallRec as $row1) {
            
            $file_path = SITE_ROOT . 'images/gallery/galleryimages/' . $row1->image;
            if (file_exists($file_path) and !empty($row1->image)):
                $thegal .= ' 
                
                
                <div class="item col-xl-4 col-lg-6 col-mb-6 mb-4">
                    <div class="item-img" data-cue="slideInUp">
                        <img src="' . IMAGE_PATH . 'gallery/galleryimages/' . $row1->image . '" alt="" />
                            <div class="content">
                                <a  data-fslightbox="gallery_1" data-type="image" href="' . IMAGE_PATH . 'gallery/galleryimages/' . $row1->image . '"><i class="bi bi-arrows-angle-expand"></i></a>
                            </div>
                    </div>
                </div>
                            ';
                        endif;
                    }
                }
                $thegal .= '';

            $galpagination = '
            <div class="pagination__wrapper">
                '. get_front_pagination($total, $limit, $page, BASE_URL . 'gallery-list') .'
            </div>
            
            ';
                
}
            
$jVars['module:gallery-list'] = $thegal;
$jVars['module:gallery-pagination'] = $galpagination;





