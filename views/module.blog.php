<?php
$bl =  '';

if (defined('BLOG_PAGE')) {
    $record = Blog::get_allblog();
    $linkTarget='';
    $pagelink='';
    if (!empty($record)) {
        
        
            $bl .= '';

            foreach ($record as $homebl) {
            
           if(!empty($homebl->linksrc)){
            // $pagelink = ($homebl->linktype == 1) ? ' target="_blank" ' : '';
            $linkTarget = ($homebl->linktype == 1) ? ' target="_blank" ' : '';
                $linksrc = ($homebl->linktype == 1) ? $homebl->linksrc : BASE_URL.$homebl->linksrc;
           }
           else{
                $linksrc= BASE_URL. 'blog/'. $homebl->slug;
           }
           $bl .='

                <div class="d-flex align-items-center border border-dark">
                    <div class="flex-shrink-0">
                    <img src="' . IMAGE_PATH . 'blog/' . $homebl->image . '" alt="' . $homebl->title . '">
                    </div>
                    <div class="flex-grow-1 mx-3">
                        <h3><a href="'.$linksrc.' '.$linkTarget.'">' . $homebl->title . '</a></h3>
                        ' . $homebl->brief . '
                    </div>
                </div>
                  
           ';
        }
        $bl.='';
    } else {
        redirect_to(BASE_URL);
    }
}
$jVars['module:bloglist'] = $bl;
$linkTarget='';
$homebloglist = '';
$homeblogs ='';
if (defined('HOME_PAGE')) {
    $homeblog = Blog:: get_latestblog_by(3);
    // $homeblogs = Blog:: get_latestblog_by(3);
    if (!empty($homeblog)) {
        
        foreach ($homeblog as $homebl) {
            
           if(!empty($homebl->linksrc)){
            // $pagelink = ($homebl->linktype == 1) ? ' target="_blank" ' : '';
            $linkTarget = ($homebl->linktype == 1) ? ' target="_blank" ' : '';
                $linksrc = ($homebl->linktype == 1) ? $homebl->linksrc : BASE_URL.$homebl->linksrc;
           }
           else{
                $linksrc=  BASE_URL. 'blog/' .$homebl->slug;
           }
           $homebloglist .='
           <div class="mad-grid-item">
                            <!--================ Entity ================-->
                            <article class="mad-entity">
                                <div class="mad-entity-media mad-owl-center-img">
                                    <a href="'.$linksrc.'" '.$linkTarget.'>
                                        <img src="' . IMAGE_PATH . 'blog/' . $homebl->image . '" alt="' . $homebl->title . '" />
                                    </a>
                                </div>
                                <div class="mad-entity-content mad-owl-center-element">
                                    <div class="mad-entity-inner">
                                        <h4 class="mad-entity-title">' . $homebl->title . '</h4>
                                        <p>
                                        ' . $homebl->brief . '   
                                        </p>
                                        <div class="mad-entity-footer">
                                            <a href="'.$linksrc.'" '.$linkTarget.' class="btn btn-big">View More</a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <!--================ End of Entity ================-->
                        </div>
           
                  
           ';
        }
        $homeblogs='<div class="mad-title-wrap align-center">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="mad-pre-title">Make memories happen</div>
                <h2 class="mad-page-title">Hotel Himalaya Experience</h2>
            </div>
        </div>
    </div>
    <div class="mad-section no-pt mad-section-pb-mobile mad-section--stretched-content-no-px mad-colorizer--scheme-color-2">
    <div class="mad-entities mad-owl-center mad-pricing type-3 with-img-border mad-grid owl-carousel mad-owl-moving mad-grid--cols-2 nav-size-2 no-dots">
        <!-- owl item -->
                
                '.$homebloglist.'
                <!-- / owl item -->
                </div>
            </div>
        ';
    }
}

$jVars['module:homebloglist'] = $homeblogs;

$blog_detail = $recent_posts = '';
if (defined("BLOG_PAGE") ) {
    $slug = !empty($_REQUEST['slug']) ? $_REQUEST['slug'] : '';
    //pr($Blogs);
   

    if (!empty($slug)) {

        $Blogs = Blog::find_by_slug($slug);

        $blog_detail .= '
        <section class="gallery my-5 py-5">
            <div class="container-fluid px-5 pt-5">
                <div class="row">
                    <div class="col-lg-2 d-none d-lg-block">
                        
       
        
               ';
        
               $recents = Blog::get_latestblog_by(6);
               
               if (!empty($recents)) {
                   $blog_detail .='
                   <ul class="list-unstyled overflow-auto" style="height:60vh">
                   ';
                   foreach ($recents as $recent) {
                       if ($recent->title != $Blogs->title) {
                           $blog_detail .= '
                           
                        
                                       
                                           <li class="py-3 border-bottom"><a href="' . BASE_URL . 'blog/' . $recent->slug . '">' . $recent->title . '</a></li>

                        ';
                       }
                       
                   }
                   $blog_detail .= '
                                </ul>
                            ';       
               }

        $blog_detail .= '


                    </div>
                <div class="col-12 col-lg-10 px-5 mb-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="section-title text-start">' . $Blogs->title . '</div>
                    <div class="section-subtitle text-start">' . $Blogs->author . '</div>
              
                    <h1>' . $Blogs->brief . '</h1>
                            ' . $Blogs->content . '

                            </div>
                        </div>
                    </div>
                        
                </div>
            </div>
        </div>
    </section>

                ';
                                


    } else {
        $record = Blog::get_allblog();
        $linkTarget='';
        $pagelink='';
        if (!empty($record)) {
            
            
                $blog_detail .= '
                <section class="gallery my-5 py-5">
                    <div class="container px-5 pt-5">
                        <div class="row">
                            <div class="col-12 col-lg-6 mx-auto text-center mb-5">
                                <div class="section-title">Blog</div>
                                <div class="section-subtitle"></div>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                ';
    
                foreach ($record as $homebl) {
                
               if(!empty($homebl->linksrc)){
                // $pagelink = ($homebl->linktype == 1) ? ' target="_blank" ' : '';
                $linkTarget = ($homebl->linktype == 1) ? ' target="_blank" ' : '';
                    $linksrc = ($homebl->linktype == 1) ? $homebl->linksrc : BASE_URL.$homebl->linksrc;
               }
               else{
                    $linksrc= BASE_URL. 'blog/'. $homebl->slug;
               }
               $blog_detail .='
    
                    <div class="d-flex align-items-center border border-dark">
                        <div class="flex-shrink-0">
                        <img src="' . IMAGE_PATH . 'blog/' . $homebl->image . '" alt="' . $homebl->title . '">
                        </div>
                        <div class="flex-grow-1 mx-3">
                            <h3><a href="'.$linksrc.' '.$linkTarget.'">' . $homebl->title . '</a></h3>
                            ' . $homebl->brief . '
                        </div>
                    </div>
                      
               ';
            }
            $blog_detail.='
                    </div>
                    </div>
                </div>
            </section>
            ';
        } else {
            redirect_to(BASE_URL);
        }
    }
}


$jVars['module:blog-detail'] = $blog_detail;
$jVars['module:blog-recent-posts'] = $recent_posts;


?>