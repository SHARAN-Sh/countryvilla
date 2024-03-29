<?php

$faq_details = '';


    $faqs = Faq::find_all();

    if (!empty($faqs)) {
        $faq_details .= '';

        foreach ($faqs as $i => $faq) {
            $collapsed = ($i == 0) ? '' : '';
            $show = ($i == 0) ? '' : '';
            $faq_details .= '
            <div class="card">
                <div class="card-header" role="tab">
                    <h5 class="mb-0">
                        <a class="collapsed" data-bs-toggle="collapse" href="#collapse'.$i.'_product" aria-expanded="false">
                            <i class="indicator bi-plus-lg"></i>'. $faq->title .'
                        </a>
                    </h5>
                </div>
                <div id="collapse'.$i.'_product" class="collapse" role="tabpanel" data-bs-parent="#faq">
                    <div class="card-body">
                        '. $faq->content .'
                    </div>
                </div>
            </div>
            ';
        }

        $faq_details .= '';
    } else {
        $faq_details .= '<h3 class="text-center p-4">No FAQ Found</h3>';
    }

    $faqarti = '
    <div class="row justify-content-between margin_60_0">
        <div class="col-lg-4">
            <div class="title">
                <small>Our FAQs</small>
                <h3>Frequently Questions</h3>
            </div>
            <p>Can’t find your question in the list?
                Let us know your questions.</p>
            <p><a href="'.BASE_URL.'contact-us" class="animated_link"><strong>Contact Us <i class="bi bi-arrow-right"></i></strong></a></p>
        </div>
        <div class="col-lg-7">
            <div role="tablist" class="mb-5 accordion" id="faq">
                
                '.$faq_details.'
                <!-- /card -->
            </div>
            <!-- /accordion -->
        </div>
    </div>
    ';

$jVars['module:faq:details'] = $faqarti;


$faq_details = '';

if (defined('HOME_PAGE')) {

    $faqs = Faq::find_few(3);

    if (!empty($faqs)) {
        $faq_details .= '';
        
        foreach ($faqs as $i => $faq) {
            $collapsed = ($i == 0) ? 'mad-panels-active' : '';
            $show = ($i == 0) ? 'show' : '';
            $faq_details .= '
            <dt class="mad-panels-title '. $collapsed .'">
                <button id="' . $faq->id . '-button" type="button" aria-expanded="false" aria-controls="' . $faq->id . '" aria-disabled="false">
                '. $faq->title .'
                </button>
            </dt>
            <dd id="' . $faq->id . '" class="mad-panels-definition">
                <p> '. $faq->content .'</p>
            </dd>

                
                ';
        }

        $faq_details .= '';
    } else {
        $faq_details .= '<h3 class="text-center p-4">No FAQ Found</h3>';
    }
}

$jVars['module:faq:details-homepage'] = $faq_details;

$jVars['module:faqlink'] = BASE_URL . 'faq';