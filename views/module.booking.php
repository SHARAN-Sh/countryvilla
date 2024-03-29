<?php 
$resbking='';
$resbtnlink='';

$siteRegulars = Config::find_by_id(1);



$booking_type = Config::getField('book_type', true);
$booking_page = Config::getField('hotel_page', true);
$booking_code = Config::getField('hotel_code', true);
$chk_in  = date('Y-m-d');
$chk_out = date('Y-m-d', strtotime("+1 day"));

// Default Reservation
if($booking_type==1) {
    $resbking.='<div class="mad-form-col">
    <a href="'.BASE_URL.'/reservation" class="book_now_btn" target="_blank"><button type="submit" class="btn btn-huge">
            Book Now
        </button></a>
    </div>';

    // Bottom link
    $resbtnlink.='<a class="book_now_btn" href="'.BASE_URL.'reservation" target="_blank">Reserve now</a>';  
}

// Nepalhotel 
if($booking_type==2) {
    $resbking.='<!--================ Layer ================-->
    <div data-start="0" data-x="center"  data-y="center" data-textAlign="[\'center\']"  data-voffset="[\'120\', \'120\', \'120\', \'120\']"  data-width="[\'98%\', \'98%\', \'98%\', \'98%\']" class="tp-caption tp-resizeme home-book-btn">
<div class="rev-mad-form">
<form  action="result.php" target="_blank" action="rooms_2_col_gallery_v1.html" class="mad-form">
        <input type="hidden" name="hotel_code" value="'. $booking_code .'">
    <div class="mad-form-row">
        <div class="mad-form-col">
            <label>Arrival Date</label>
            <div class="mad-datepicker">
                <div class="mad-datepicker-body">
                    <input type="text" class="form-control input " placeholder="Check in" id="checkin" name="hotel_check_in">
                </div>

                
            </div>
        </div>

        <div class="mad-form-col">
            <label>Departure Date</label>
            <div class="mad-datepicker">
                <div class="mad-datepicker-body">
                    <input type="text" class="form-control input " placeholder="Check out" id="checkout" name="hotel_check_out">
                </div>

                
            </div>
        </div>


        <div class="mad-form-col">
        <a href="'.BASE_URL.'result.php?hotel_code='.$booking_code.'" class="book_now_btn" target="_blank"><button type="submit" class="btn btn-huge">
                Book Now
            </button></a>
        </div>
    </div>
</form>
</div>
</div>';

    // Bottom link
    $resbtnlink.='<a href="'.BASE_URL.'result.php?hotel_code='.$booking_code.'" class="book_now_btn" target="_blank">Reserve now</a>';
}

// Fastbooking
if($booking_type==3) {
    $day = date("d");
    $resbking.='
   
<!--================ End of Layer ================--> 
</div>';

    // Bottom link
    $resbtnlink.='<a href="http://www.fastbookings.biz/DIRECTORY/'.$booking_page.'?s=results&Clusternames='.$booking_code.'&Hotelnames='.$booking_code.'" class="btn btn-medium btn-darkbrown" target="_blank">Book now</a>';
}

// Booking.com
if($booking_type==4) { 
    $resbking.='<form action="http://www.booking.com/hotel/np/'.$booking_page.'" method="get" target="booking_popup" id="booking-form">
        <ul>
            <li>&nbsp;</li>
            <li>
                <i class="fa fa-calendar-plus-o"></i>  
                <input name="check_in" type="text" id="checkin" class="input-control border-white" placeholder="Check In" value="'.$chk_in.'"/>
            </li>
            <li>
                <i class="fa fa-calendar-plus-o"></i>  
                <input name="check_out" type="text" id="checkout" class="input-control border-white" placeholder="Check Out" value="'.$chk_out.'"/>
            </li>
            <li>
                <input type="hidden" name="aid" value="330843" />
                <input type="hidden" name="hotel_id" value="'.$booking_code.'" />
                <input type="hidden" name="lang" value="en" />
                <input type="hidden" name="pb" value="" />
                <input type="hidden" name="stage" value="0" />
                <input type="hidden" name="hostname" value="www.booking.com" />
                <input type="hidden" name="checkin_monthday" class="checkin-monthday" value="'.date('d').'" />
                <input type="hidden" name="checkin_year_month" class="checkin-year-month" value="'.date('Y-m').'" />
                <input type="hidden" name="checkout_monthday" class="checkout-monthday" value="'.date('d', strtotime('+1 day')).'" />
                <input type="hidden" name="checkout_year_month" class="checkout-year-month" value="'.date('Y-m').'" />       
                <button id="btn-book" class="btn btn-large btn-darkbrown">Book now</button>
            </li>
            <li>&nbsp;</li>
        </ul>
    </form>';

    // Bottom link
    $resbtnlink.='<a href="http://www.booking.com/hotel/np/'.$booking_page.'?aid='.$booking_code.'" class="btn btn-medium btn-darkbrown" target="_blank">Book now</a>';
}

$jVars['module:booking-form'] = $resbking;
$jVars['module:book-bottom-link'] = $resbtnlink;

$script='';

// Fastbooking
if($booking_type==3) {
    $script.= '<script type="text/javascript" src="'.JS_PATH.'fastbooking/fbparam.js"></script>'."\n";
    $script.= '<script type="text/javascript" src="'.JS_PATH.'fastbooking/fblib.js"></script>'."\n";
    $script.= '<script type="text/javascript" src="'.JS_PATH.'fastbooking/fbfulltrack.js"></script>'."\n";
}

$jVars['footer:script'] = $script;



$booking_undergallery = '      
<!--================ Layer ================-->
            <div data-start="0" data-x="center"  data-y="center" data-textAlign="[\'center\']"  data-voffset="[\'120\', \'120\', \'120\', \'120\']"  data-width="[\'98%\', \'98%\', \'98%\', \'98%\']" class="tp-caption tp-resizeme home-book-btn">
            <div class="rev-mad-form">
            <form  method="get" action="rooms_2_col_gallery_v1.html" class="mad-form">
                <div class="mad-form-row">
                    <div class="mad-form-col">
                        <label>Arrival Date</label>
                        <div class="mad-datepicker">
                            <div class="mad-datepicker-body">
                                <span class="mad-datepicker-date">15</span>
                                <span class="mad-datepicker-others">
                                    <span class="mad-datepicker-month-year">April, 2023
                                    </span>
                                    <span class="mad-datepicker-day">Friday</span>
                                </span>
                            </div>
        
                            <div class="mad-datepicker-select">
                                <div id="calendar-wrap" class="calendar_wrap mad-calendar-rendered">
                                    <table id="wp-calendar">
                                        <caption>July 2023
                                            <a class="calendar-caption-prev" href="#">
                                                <i class="material-icons">keyboard_arrow_left</i>
                                            </a>
                                            <a class="calendar-caption-next" href="#"><i class="material-icons">keyboard_arrow_right</i></a>
                                        </caption>
                                        <thead class="div">
                                            <tr>
                                                <th>Sun</th>
                                                <th>Mon</th>
                                                <th>Tue</th>
                                                <th>Wed</th>
                                                <th>Thu</th>
                                                <th>Fri</th>
                                                <th>Sat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="first">
                                                  <div class="marker">30</div>
                                                </td>
                                                <td>
                                                  <div class="marker">31</div>
                                                </td>
                                                <td>1</td>
                                                <td>2</td>
                                                <td>3</td>
                                                <td>4</td>
                                                <td>5</td>
                                            </tr>
                                            <tr>
                                                <td class="first">6</td>
                                                <td>7</td>
                                                <td>8</td>
                                                <td id="today"><a href="#">9</a></td>
                                                <td>10</td>
                                                <td>11</td>
                                                <td>12</td>
                                            </tr>
                                            <tr>
                                                <td class="first">13</td>
                                                <td>14</td>
                                                <td>15</td>
                                                <td>16</td>
                                                <td>17</td>
                                                <td>18</td>
                                                <td>19</td>
                                            </tr>
                                            <tr>
                                                <td class="first">20</td>
                                                <td>21</td>
                                                <td>22</td>
                                                <td>23</td>
                                                <td>24</td>
                                                <td>25</td>
                                                <td>26</td>
                                            </tr>
                                            <tr>
                                                <td class="first">27</td>
                                                <td>28</td>
                                                <td>29</td>
                                                <td>30</td>
                                                <td>
                                                  <div class="marker">1</div>
                                                </td>
                                                <td>
                                                  <div class="marker">2</div>
                                                </td>
                                                <td>
                                                  <div class="marker">3</div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <div class="mad-form-col">
                        <label>Departure Date</label>
                        <div class="mad-datepicker">
                            <div class="mad-datepicker-body">
                                <span class="mad-datepicker-date">27</span>
                                <span class="mad-datepicker-others">
                                    <span class="mad-datepicker-month-year">April, 2022</span>
                                    <span class="mad-datepicker-day">wednesday</span>
                                </span>
                            </div>
        
                            <div class="mad-datepicker-select">
                                <div id="calendar-wrap" class="calendar_wrap mad-calendar-rendered">
                                    <table id="wp-calendar">
                                        <caption>September 2021
                                            <a class="calendar-caption-prev" href="#">
                                                <i class="material-icons">keyboard_arrow_left</i>
                                            </a>
                                            <a class="calendar-caption-next" href="#">
                                                <i class="material-icons">keyboard_arrow_right</i>
                                            </a>
                                        </caption>
        
                                        <thead class="div">
                                            <tr>
                                                <th>Sun</th>
                                                <th>Mon</th>
                                                <th>Tue</th>
                                                <th>Wed</th>
                                                <th>Thu</th>
                                                <th>Fri</th>
                                                <th>Sat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="first">
                                                  <div class="marker">30</div>
                                                </td>
                                                <td>
                                                  <div class="marker">31</div>
                                                </td>
                                                <td>1</td>
                                                <td>2</td>
                                                <td>3</td>
                                                <td>4</td>
                                                <td>5</td>
                                            </tr>
                                            <tr>
                                                <td class="first">6</td>
                                                <td>7</td>
                                                <td>8</td>
                                                <td id="today"><a href="#">9</a></td>
                                                <td>10</td>
                                                <td>11</td>
                                                <td>12</td>
                                            </tr>
                                            <tr>
                                                <td class="first">13</td>
                                                <td>14</td>
                                                <td>15</td>
                                                <td>16</td>
                                                <td>17</td>
                                                <td>18</td>
                                                <td>19</td>
                                            </tr>
                                            <tr>
                                                <td class="first">20</td>
                                                <td>21</td>
                                                <td>22</td>
                                                <td>23</td>
                                                <td>24</td>
                                                <td>25</td>
                                                <td>26</td>
                                            </tr>
                                            <tr>
                                                <td class="first">27</td>
                                                <td>28</td>
                                                <td>29</td>
                                                <td>30</td>
                                                <td>
                                                  <div class="marker">1</div>
                                                </td>
                                                <td>
                                                  <div class="marker">2</div>
                                                </td>
                                                <td>
                                                  <div class="marker">3</div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <div class="mad-form-col short-col">
                        <label>Adults</label>
                        <div class="quantity">
                            <input type="text" value="1" readonly="" />
                            <button type="button" class="qty-plus">
                                <i class="material-icons">keyboard_arrow_up</i>
                            </button>
                            <button type="button" class="qty-minus">
                                <i class="material-icons">keyboard_arrow_down</i>
                            </button>
                        </div>
                    </div>
        
                    <div class="mad-form-col short-col">
                        <label>children</label>
                        <div class="quantity">
                            <input type="text" value="0" readonly="" />
                            <button type="button" class="qty-plus">
                                <i class="material-icons">keyboard_arrow_up</i>
                            </button>
                            <button type="button" class="qty-minus">
                                <i class="material-icons">keyboard_arrow_down</i>
                            </button>
                        </div>
                    </div>
        
                    <div class="mad-form-col">
                        <button type="submit" class="btn btn-huge">
                            Book Now
                        </button>
                    </div>
                </div>
            </form>
        </div>
        </div>
       

';


$jVars['module:booking_undergallery'] = $booking_undergallery;



$bookingnumber ='';

$bookingnumber .='                                    
            <div class="col-md-12">
                <p class="reservation5">
                    For Table Reservation, Contact us at <a href="tel:'.str_replace(' ', '', $siteRegulars->whatsapp_a).'">'. $siteRegulars->whatsapp_a .' </a></p>
            </div>';



$jVars['module:booking_table'] = $bookingnumber;



$noandmail ='';

if(!empty($siteRegulars->eventno) || !empty($siteRegulars->eventmail)){

    $phonelinked='';
    $phoneno = explode(",", $siteRegulars->eventno);

    $count = 1;

    foreach ($phoneno as $tel) {
        if($count>1){
            $phonelinked .= ' | ';
        }

        $phonelinked .= '<a href="tel:+977 ' . $tel . '">+977 ' . $tel . '</a>';
        $count++;
    }


    $maillink = '';
    $mail = explode(",", $siteRegulars->eventmail);

    $count = 1;

    foreach ($mail as $tel) {
        if($count>1){
            $maillink .= ', ';
        }

        $maillink .= '<a href="mailto:' . $tel . '">' . $tel . '</a>';
        $count++;
    }

    $noandmail .='

                        <h3 class="footer-title">Event Booking</h3>
                            <p><i class="fa fa-phone">&nbsp;</i>'.$phonelinked.' </p>
                            <p><i class="fa fa-envelope">&nbsp;</i>'. $maillink .'</p>

                            <br/>';
}

if(!empty($siteRegulars->roomno) || !empty($siteRegulars->roommail)){

    $phonelinked='';
    $phoneno = explode(",", $siteRegulars->roomno);

    $count = 1;

    foreach ($phoneno as $tel) {
        if($count>1){
            $phonelinked .= ' | ';
        }

        $phonelinked .= '<a href="tel:+977 ' . $tel . '">+977 ' . $tel . '</a>';
        $count++;
    }


    $maillink = '';
    $mail = explode(",", $siteRegulars->roommail);

    $count = 1;

    foreach ($mail as $tel) {
        if($count>1){
            $maillink .= ', ';
        }

        $maillink .= '<a href="mailto:' . $tel . '">' . $tel . '</a>';
        $count++;
    }

    $noandmail .='

                        <h3 class="footer-title">Room Booking</h3>
                            <p><i class="fa fa-phone">&nbsp;</i>'.$phonelinked.'</p>
                            <p><i class="fa fa-envelope">&nbsp;</i>'. $maillink .'</p>

                            <br/>';
}

if(!empty($siteRegulars->dineno) || !empty($siteRegulars->dinemail)){


    $phonelinked='';
    $phoneno = explode(",", $siteRegulars->dineno);

    $count = 1;

    foreach ($phoneno as $tel) {
        if($count>1){
            $phonelinked .= ' | ';
        }

        $phonelinked .= '<a href="tel:+977 ' . $tel . '">+977 ' . $tel . '</a>';
        $count++;
    }


    $maillink = '';
    $mail = explode(",", $siteRegulars->dinemail);

    $count = 1;

    foreach ($mail as $tel) {
        if($count>1){
            $maillink .= ', ';
        }

        $maillink .= '<a href="mailto:' . $tel . '">' . $tel . '</a>';
        $count++;
    }





    $noandmail .='

                        <h3 class="footer-title">Dine Booking</h3>
                            <p><i class="fa fa-phone">&nbsp;</i>'.$phonelinked.'</p>
                            <p><i class="fa fa-envelope">&nbsp;</i>'.$maillink.'</p>

                            <br/>';
}

if(!empty($siteRegulars->recreationno) || !empty($siteRegulars->recreationmail)){
    
        
    $phonelinked='';
    $phoneno = explode(",", $siteRegulars->recreationno);

    $count = 1;

    foreach ($phoneno as $tel) {
        if($count>1){
            $phonelinked .= ' | ';
        }

        $phonelinked .= '<a href="tel:+977 ' . $tel . '">+977 ' . $tel . '</a>';
        $count++;
    }


    $maillink = '';
    $mail = explode(",", $siteRegulars->recreationmail);

    $count = 1;

    foreach ($mail as $tel) {
        if($count>1){
            $maillink .= ', ';
        }

        $maillink .= '<a href="mailto:' . $tel . '">' . $tel . '</a>';
        $count++;
    }



    
    
    
    
    $noandmail .='

                        <h3 class="footer-title">Recreation Booking</h3>
                            <p><i class="fa fa-phone">&nbsp;</i>'.$phonelinked.' </p>
                            <p><i class="fa fa-envelope">&nbsp;</i>'.$maillink.'</p>

                            <br/>';
}

$jVars['module:booking_pkg'] = $noandmail;





$homebooking = '';

if (defined('HOME_PAGE')) {

    $homebooking = '
    <div class="wrapper position-absolute d-flex align-items-center justify-content-center text-center animate_hero is-transitioned" style="bottom:-150px;width:100%;z-index:2" >
        <div class="container">
            
            <form class="check-form" action="result.php" target="_blank">
            <input type="hidden" name="hotel_code" value="'.$booking_code.'">
            <div class="row justify-content-center slide-animated three">
                <div class="col-xl-8">
                    <div class="row g-0 booking_form">
                        <div class="col-lg-4 ">
                            <div class="form-group">
                                <input type="date" id="checkin" name="hotel_check_in" class="form-control" pattern="\d{4}-\d{2}-\d{2}">
                            </div>
                        </div>
                        <div class="col-lg-4 ">
                            <div class="form-group">
                                <input type="date"  id="checkout" name="hotel_check_out" class="form-control" pattern="\d{4}-\d{2}-\d{2}">
                            </div>
                        </div>
                        
                        <div class="col-lg-4">
                            <input type="submit" class="btn_search" value="Search">
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        
        <!-- /mouse_wp -->
    </div>
    ';

}

$jVars['module:booking--homepage'] = $homebooking;


$roombooking ='';


if (defined('SUBPACKAGE_PAGE') ) {

    $roombooking = '
    <div class="clr">
        <div class="container padding_80_80" id="booking_section">
            <div class="row justify-content-between">
                <div class="col-xl-4">
                    <div data-cue="slideInUp" data-show="true" style="animation-name: slideInUp; animation-duration: 600ms; animation-timing-function: ease; animation-delay: 0ms; animation-direction: normal; animation-fill-mode: both;">
                        <div class="title">
                            <small>Hotel Country Villa</small>
                            <h2>Check Availability</h2>
                        </div>
                        <p>You can check the availability of a room prior after entering a date request. This will ensure that the room you are requesting is not already booked.</p>

                        <p class="phone_element no_borders"><a href="tel://+97716680127"><i class="bi bi-telephone"></i><span><em>Info and bookings</em>+977 6680127 / 28</span></a></p>
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
    </div>
        
    ';
}


$jVars['module:booking-subpkg-room'] = $roombooking;


