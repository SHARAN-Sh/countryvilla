<?php
$resinndetail = $imageList = $innerbred = $t = '';
$homearticle = Article::find_by_id(22);
if (!empty($homearticle)) {
    if ($homearticle->image != "a:0:{}") {
        $imageList = unserialize($homearticle->image);
        $imgno = array_rand($imageList);
        $file_path = SITE_ROOT . 'images/articles/' . $imageList[$imgno];
        if (file_exists($file_path)) {
            $imglink = IMAGE_PATH . 'articles/' . $imageList[$imgno];
        } else {
            $imglink = BASE_URL . 'template/web/img/mosaic_2.jpg';
        }
    } else {
        $imglink = BASE_URL . 'template/cms/img/mosaic_2.jpg';
    }
    $t .= ' <div class="col-xs-12">
                     <a href="' . BASE_URL . 'page/' . $homearticle->slug . '">
                    <div class="mosaic_container">
                        <img src="' . $imglink . '" alt="' . $homearticle->title . '" class="img-responsive add_bottom_30"><span class="caption_2"> ' . $homearticle->title . '</span>
                    </div>
                    </a>
                </div>';


}

$jVars['module:aboutarticle'] = $t;

/**
 *      Home page
 */
$resinnh = '';

if (defined('HOME_PAGE')) {
    $recInn = Article::homepageArticle();
    if (!empty($recInn)) {
        foreach ($recInn as $innRow) {
            $content = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($innRow->content));
            $readmore = '';
            if (!empty($innRow->linksrc)) {
                $linkTarget = ($innRow->linktype == 1) ? ' target="_blank" ' : '';
                $linksrc = ($innRow->linktype == 1) ? $innRow->linksrc : BASE_URL . $innRow->linksrc;
                $readmore = '<a href="' . $linksrc . '" title="">see more</a>';
            } else {
                $readmore = (count($content) > 1) ? '<a href="' . BASE_URL . 'page/' . $innRow->slug . '" title="">Read more...</a>' : '';
            }
            $resinnh .=  $content[0];
        }
    }

}

$jVars['module:home-article'] = $resinnh;

/**
 *      Inner page detail
 */

$aboutdetail = $imageList = $aboutbred = '';

if (defined('INNER_PAGE') and isset($_REQUEST['slug'])) {
    $slug = addslashes($_REQUEST['slug']);
    $recRow = Article::find_by_slug($slug);

    if (!empty($recRow)) {
        $backimg = '';

        $imglink = $jVars['site:default-image'];
        if ($recRow->image != "a:0:{}") {
            $imageList = unserialize($recRow->image);
            $imgno = 0;
            foreach($imageList as $i){
                $file_path = SITE_ROOT . 'images/articles/' . $imageList[$imgno];
                if (file_exists($file_path)) {
                    $imglink = IMAGE_PATH . 'articles/' . $imageList[$imgno];
                }
                else{
                    $imglink = $jVars['site:default-image'];
                }
                $imgno++;
                $backimg.= '<div class="text-center item bg-img" data-overlay-dark="2" data-background="'. $imglink .'"></div>';
            }
        }
        
        $innerbred .= '
            <div class="hero full-height jarallax" data-jarallax data-speed="0.2">
                <img class="jarallax-img" src="'. $imglink .'" alt="">
                <div class="wrapper opacity-mask d-flex align-items-center justify-content-center text-center animate_hero" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                    <div class="container">
                        <small class="slide-animated one">' . $recRow->sub_title . '</small>
                        <h1 class="slide-animated two">' . $recRow->title . '</h1>
                    </div>
                </div>
            </div>
            ';

            
        $rescontent = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($recRow->content));
        $content = !empty($rescontent[1]) ? $rescontent[1] : $rescontent[0];


            $aboutdetail .= '   
            
            <div class="container margin_120_95" style="background-image: url('.BASE_URL.'template/web/img/texture.jpg); background-repeat: no-repeat;background-size: cover;">
                <div class="row justify-content-between align-items-center">
                    '. $content .'
                </div>
                <!-- /Row -->
            </div>
            ';

        
    } else {
        redirect_to(BASE_URL);
    }
}

$jVars['module:inner-about-detail'] = $aboutdetail;
$jVars['module:inner-about-bread'] = $innerbred;


$restyp = '';

$typRow = Article::get_by_type();
if (!empty($typRow)) {
    $content = explode('<hr id="system_readmore" style="border-style: dashed; border-color: orange;" />', trim($typRow->content));
    $readmore = '';
    if (!empty($typRow->linksrc)) {
        $linkTarget = ($typRow->linktype == 1) ? ' target="_blank" ' : '';
        $linksrc = ($typRow->linktype == 1) ? $typRow->linksrc : BASE_URL . $typRow->linksrc;
        $readmore = '<a class="text-link link-direct" href="' . $linksrc . '">see more</a>';
    } else {
        $readmore = (count($content) > 1) ? '<a href="' . BASE_URL . $typRow->slug . '">Read more...</a>' : '';
    }
    $restyp .= '<h3 class="h3 header-sidebar">' . $typRow->title . '</h3>
	<div class="home-content">
		' . $content[0] . ' ' . $readmore . '
	</div>';

}

$jVars['module:article_by_type'] = $restyp;



/*
    Why Choose Us
*/
$resinnh1 = '';

if (defined('HOME_PAGE')) {

    $resinnh1 .= '';

// pr($resinnh1);
    $recInn1 = Article::find_by_id(2);
    if (!empty($recInn1)) {
            $resinnh1 .= $recInn1->content;

        
    }

}

$jVars['module:home_article'] = $resinnh1;


/*
    HomePage Facilities
*/
$resinnh1 = '';

if (defined('HOME_PAGE')) {

    $resinnh1 .= '';


    $recInn1 = Article::find_by_id(3);

    if (!empty($recInn1)) {

            $resinnh1 .= $recInn1->content;

        
    }

}

$jVars['module:home_facilities'] = $resinnh1;

?>