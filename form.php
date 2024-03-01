<?php

global $allPackages;
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

$errors = $_SESSION['form_errors'] ?? [];

include_once __DIR__ . '/includes/Package.php';
include_once __DIR__ . '/includes/env.php';

$type = $_GET['type'] ?? null;
$pack = $_GET['fun'] ?? null;

$packages = [];
if ($type && $pack) {
    $packages = findPackage($type, $pack, $allPackages);
}

if (empty($packages)) {
    header('Location: ' . $pageUrl . '/index.php');
    exit();
}

$package = count($packages) ? $packages[array_key_first($packages)] : null;

?>
    <!doctype html>
    <html lang="en" style="background-color: #000; padding-bottom: 0px;">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="generator" content="">
        <title>Book <?=$type?> - <?=$pack?></title>
        <!-- Bootstrap core CSS -->
        <link href="../form/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="style.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
              crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
              rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
              rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
              integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
              crossorigin="anonymous" referrerpolicy="no-referrer"/>
        <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    </head>
    <body style="background-color: #000; padding-bottom: 0px;overflow-x: hidden;">
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12"><img style="width: 200px;" class="img-fluid mb-3" src="logo1-w.png">
                    <div class="mobile">
                        <div class="hamburger-menu">
                            <div class="bar"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                </div>
                <div class="mobile-nav hide">
                    <ul>
                        <li><a href="https://wordpressmu-603031-4219011.cloudwaysapps.com/"><i class="fa fa-home"
                                                                                               aria-hidden="true"></i>
                                HOME</a></li>
                        <li><a href="https://wordpressmu-603031-4219011.cloudwaysapps.com/about-us/"><i
                                        class="fa fa-file-text" aria-hidden="true"></i> About us</a></li>
                        <li data-bs-toggle="collapse" data-bs-target="#demo"><a class="dropdown-toggle"
                                                                                data-bs-toggle="dropdown"
                                                                                href="https://wordpressmu-603031-4219011.cloudwaysapps.com/packages/"><i
                                        class="fa fa-list" aria-hidden="true"></i> Packages<span
                                        class="et_mobile_menu_arrow"></span></a>
                        </li>
                        <ul id="demo" class="collapse">
                            <li><a href="#bowling">Bowling</a></li>
                            <li><a href="#pool">Pool</a></li>
                            <li><a href="#cosmic">Cosmic</a></li>
                            <li><a href="https://wordpressmu-603031-4219011.cloudwaysapps.com/birthday-fun/">Birthday
                                    Fun</a></li>
                            <li><a href="https://wordpressmu-603031-4219011.cloudwaysapps.com/food-menu/">Food Menu</a>
                            </li>
                        </ul>

                        <li><a href="https://wordpressmu-603031-4219011.cloudwaysapps.com/blog/"><i
                                        class="fa fa-file-text" aria-hidden="true"></i> Blog</a></li>
                        <li><a href="https://wordpressmu-603031-4219011.cloudwaysapps.com/contact-us/"><i
                                        class="fa fa-file-text" aria-hidden="true"></i> Contact Us</a></li>

                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-section">
        <div class="container">
            <div class="row">
                <?php if(count($packages)) : ?>
                <div class="col-lg-12 col-md-12">
                    <h1><?=$package->formattedType()?></h1>
                    <p> ($<?=$package->price?> each)</p>
                </div>
                <?php else: ?>
                <div class="col-lg-12 col-md-12">
                    <h1>Reservation</h1>
                </div>
                <?php endif; ?>

    </section>
    <form action="form-handler.php" aria-label="Contact form" class="wpcf7-form init" data-status="init" method="post">
        <div style="display: none;">
            <input name="_wpcf7" type="hidden" value="609">
            <input name="_wpcf7_version" type="hidden" value="5.8.6">
            <input name="_wpcf7_locale" type="hidden" value="en_US">
            <input name="_wpcf7_unit_tag" type="hidden" value="wpcf7-f609-p605-o1">
            <input name="_wpcf7_container_post" type="hidden" value="605">
            <input name="_wpcf7_posted_data_hash" type="hidden" value="">
        </div>
        <div class="form-w" id="msform">
            <ul id="progressbar">
                <li class="active"></li>
<!--                <li></li>-->
                <li></li>
            </ul>
            <fieldset class="text-left">
                <?php if (isset($_SESSION['form_success'])) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= $_SESSION['form_success'] ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($errors) && count($errors)) : ?>
                    <div class="text-danger mb-2" role="alert">
                        Please fix the following errors:
                    </div>
                <?php endif; ?>
                <?php foreach ($errors as $key => $value) : ?>
                    <div class="alert alert-danger p-2" role="alert">
                        <?= $value ?>
                    </div>
                <?php endforeach; ?>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <h6 class="pb-2">What Date?</h6>
                        <div class="calendar">
                            <div id="calendar"></div>
                        </div>
                        <input type="hidden" name="date"/>
                        <input type="hidden" name="type" value="<?=$type?>"/>
                        <input type="hidden" name="pack" value="<?=$pack?>"/>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="col-12 mb-3">
                            <h6 class="pb-2">We Can Offer You the Following Start Times</h6>

                            <div class="available-time-slots">
                                <label class="p-div-time active">
                                    <input type="radio" value="15:00" name="time" checked/>
                                    3:00 PM
                                </label>
                                <label class="p-div-time">
                                    <input type="radio" value="16:00" name="time"/>
                                    4:00 PM
                                </label>
                                <label class="p-div-time">
                                    <input type="radio" value="17:00" name="time"/>
                                    5:00 PM
                                </label>
                                <label class="p-div-time">
                                    <input type="radio" value="18:00" name="time"/>
                                    6:00 PM
                                </label>
                                <label class="p-div-time">
                                    <input type="radio" value="19:00" name="time"/>
                                    7:00 PM
                                </label>
                                <label class="p-div-time">
                                    <input type="radio" value="20:00" name="time"/>
                                    8:00 PM
                                </label>
                                <label class="p-div-time">
                                    <input type="radio" value="21:00" name="time"/>
                                    9:00 PM
                                </label>
                                <label class="p-div-time">
                                    <input type="radio" value="22:00" name="time"/>
                                    10:00 PM
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <h6 class="pb-2">Number of Guests?</h6>
                            <p>
                            <span class="wpcf7-form-control-wrap" data-name="menu-81">
                                <select
                                        aria-invalid="false" class="wpcf7-form-control wpcf7-select form-control"
                                        name="number_of_guests"><option value="1">1</option><option value="2">2</option><option
                                            value="3">3</option><option value="4">4</option><option value="5">5</option><option
                                            value="6">6</option><option value="7">7</option><option value="8">8</option><option
                                            value="9">9</option><option value="10">10</option><option
                                            value="11">11</option><option
                                            value="12">12</option><option value="13">13</option><option
                                            value="14">14</option><option
                                            value="15">15</option><option value="16">16</option><option
                                            value="17">17</option><option
                                            value="18">18</option><option value="19">19</option><option
                                            value="20">20</option><option
                                            value="21">21</option><option value="22">22</option><option
                                            value="23">23</option><option
                                            value="24">24</option><option value="25">25</option><option
                                            value="26">26</option><option
                                            value="27">27</option><option value="28">28</option><option
                                            value="29">29</option><option
                                            value="30">30</option></select></span>
                            </p>
                        </div>
                        <div class="d-lg-flex">
                            <div class="col-lg-6 col-md-6">
                                <h6 class="pb-2">How Long? </h6>
                                <p>
<!--                                    // Make it select with 1-12 hours-->
                                    <select class="form-select p-div-time1 active" aria-label="Select" name="duration">
                                        <option selected value="1">1:00 Hours</option>
                                        <option value="2">2:00 Hours</option>
                                        <option value="3">3:00 Hours</option>
                                        <option value="4">4:00 Hours</option>
                                        <option value="5">5:00 Hours</option>
                                        <option value="6">6:00 Hours</option>
                                        <option value="7">7:00 Hours</option>
                                        <option value="8">8:00 Hours</option>
                                        <option value="9">9:00 Hours</option>
                                        <option value="10">10:00 Hours</option>
                                        <option value="11">11:00 Hours</option>
                                        <option value="12">12:00 Hours</option>
                                    </select>
<!--                                    <label class="p-div-time1 active">-->
<!--                                        <input type="hidden" value="2" name="duration"/>-->
<!--                                        2:00 Hours-->
<!--                                    </label>-->
                                </p>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <h6 class="pb-4">
<!--                                    If packageis Birthday make it Number of Person -->
                                    <?php if($type === 'birthday') : ?>
                                        Select Number of Person
                                    <?php elseif($type === 'pool') : ?>
                                        Select Number of Table
                                    <?php else: ?>
                                        Select Number of Lanes
                                    <?php endif; ?>
                                </h6>
                                <p><span class="wpcf7-form-control-wrap" data-name="menu-51"><select
                                                aria-invalid="false"
                                                class="wpcf7-form-control wpcf7-select form-control"
                                                name="lane_count"><option value="1">1</option><option
                                                    value="2">2</option><option
                                                    value="3">3</option><option value="4">4</option></select></span>
                                </p>
                            </div>
                        </div>
                    </div>


                </div>
                <p class="text-center">
                    <button class="next action-button" type="button">Next</button>
                </p>
            </fieldset>

<!--            <fieldset style="display:none;">-->
<!--                <div class="bd-div">-->
<!--                    <div class="bd-div1">-->
<!--                        <p>-->
<!--                            <img src="https://wordpressmu-603031-4219011.cloudwaysapps.com/wp-content/uploads/2024/01/shoes_icon_white.png"-->
<!--                                 style="width:100%;">-->
<!--                        </p>-->
<!--                    </div>-->
<!--                    <div class="bd-div2">-->
<!--                        <h2>Bowling Shoes ($5.25 each)</h2>-->
<!--                        <p>All bowlers are required to wear bowling shoes.-->
<!--                        </p>-->
<!--                    </div>-->
<!--                    <div class="bd-div3">-->
<!--                        <h5>Qty-->
<!--                        </h5>-->
<!--                        <p><span class="wpcf7-form-control-wrap" data-name="menu-52"><select-->
<!--                                        aria-invalid="false" class="wpcf7-form-control wpcf7-select form-control"-->
<!--                                        name="quantity"><option-->
<!--                                            value="1">1</option><option value="2">2</option><option value="3">3</option><option-->
<!--                                            value="4">4</option><option value="5">5</option><option value="6">6</option><option-->
<!--                                            value="7">7</option><option value="8">8</option><option value="9">9</option><option-->
<!--                                            value="10">10</option></select></span>-->
<!--                        </p>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <p><input class="previous action-button" name="previous" type="button" value="Previous">-->
<!--                    <button class="next action-button" type="button">Next</button>-->
<!--                </p>-->
<!--            </fieldset>-->
            <fieldset id="laststep" style="display:none;">
                <h2 class="pb-3">Your Information </h2>

                <div class="row">
                    <div class="col-lg-4 col-md-4 pb-3">
                        <input aria-invalid="false" class="wpcf7-form-control wpcf7-text form-control" name="name"
                               autocomplete="full-name" placeholder="Name" size="40" type="text" value="" required>
                    </div>
                    <div class="col-lg-4 col-md-4 pb-3">
                        <input aria-invalid="false"
                               class="wpcf7-form-control wpcf7-email wpcf7-text wpcf7-validates-as-email form-control"
                               name="email" autocomplete="email" placeholder="Email" size="40" type="email" value=""
                               required></div>
                    <div class="col-lg-4 col-md-4 pb-3">
                        <input aria-invalid="false"
                               class="wpcf7-form-control wpcf7-tel wpcf7-text wpcf7-validates-as-tel form-control"
                               name="phone" placeholder="Phone" size="40" type="tel" value="" required>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 px-0 pb-3">
                    <textarea aria-invalid="false" class="wpcf7-form-control wpcf7-textarea form-control" cols="40"
                              name="message" placeholder="Message" rows="5" required></textarea>
                </div>
                <span class="wpcf7-form-control-wrap" data-name="checkbox-566">
                <span class="wpcf7-form-control wpcf7-checkbox">
                    <span class="wpcf7-list-item first last">
                        <label>
                            <input name="subscribe" type="checkbox" value="1">
                            <span class="wpcf7-list-item-label">YES! I want to receive exclusive deals and promotions via email. I understand that I can opt-out at any time.</span>
                        </label>
                    </span>
                </span>
            </span>
                <br>
                <span class="wpcf7-form-control-wrap" data-name="checkbox-567">
                <span class="wpcf7-form-control wpcf7-checkbox">
                    <span class="wpcf7-list-item first last">
                        <label>
                            <input name="remember_me" type="checkbox" value="1">
                            <span class="wpcf7-list-item-label">Remember me to make my next booking faster.</span>
                        </label>
                    </span>
                </span>
            </span>
                <p>
                    <input class="previous action-button" name="previous" type="button" value="Previous">
                    <input class="wpcf7-form-control wpcf7-submit has-spinner action-button" type="submit"
                           value="Submit">
                    <span class="wpcf7-spinner"></span>
                </p>
            </fieldset>
        </div>
        <div aria-hidden="true" class="wpcf7-response-output"></div>
    </form>

    <!--- <section>

        <div class="form-w" id="msform">
            <ul id="progressbar">
                <li class="active"></li>
                <li></li>
                    <li></li>
             <li></li>
            </ul>
            <fieldset>

            <h2>1. What Date?</h2>

            <input type="Name" class="form-control" placeholder="Name">

            <h2>2. Number of Guests?</h2>
            In order to ensure we have the appropriate number of lanes reserved for your group, please tell us how many people are expected. The maximum number of players per lane is 6. If your reservation is for more than the listed guests below, please call (305) 221-1221 and we will be more than happy to help book your party.

            <input type="Name" class="form-control" placeholder="Name">
            <h2>3. How Long?</h2>
            All reservations are booked in two-hour blocks. We do not offer one-hour reservations.

            <input type="Name" class="form-control" placeholder="Name">
            <button class="next action-button" type="button">Next</button>
        </fieldset>
            <fieldset>
            <h2>4. We Can Offer You the Following Start Times:</h2>
            <input type="Name" class="form-control" placeholder="Name">
             <h2>5. Select Number of Lanes</h2>
            <p>If you want to change the number of lanes please choose below. </p>
            <input type="Name" class="form-control" placeholder="Name">
            <input class="previous action-button" name="previous" type="button" value="Previous" /><button  class="next action-button" type="button">Next</button>
            </fieldset>
            <fieldset>
            <div class="bd-div">
            <div class="bd-div1">
            <img src="https://wordpressmu-603031-4219011.cloudwaysapps.com/wp-content/uploads/2024/01/shoes_icon_white.png"></div>
            <div class="bd-div2">
            <h2>Bowling Shoes ($5.25 each)</h2>
            All bowlers are required to wear bowling shoes.
            </div>
            <div class="bd-div3">
            <h5>Qty</h5>
            <input type="Name" class="form-control" placeholder="Name">
        </div>
            </div>
            <input class="previous action-button" name="previous" type="button" value="Previous" /><button  class="next action-button" type="button">Next</button>
          </fieldset>
            <fieldset id="laststep" >
            <h2>Your Information</h2>

            rtgrdtyh
            <input class="previous action-button" name="previous" type="button" value="Previous" /> <button class="btn-form" type="submit">Submit</button>
        </fieldset>

    </section>  -->


    <!---- <section>
            <div class="form">
                <form>
                    <div class="text-center">   <h1> Bowling Reservation</h1>
                        <div class="line-y"></div>
                    </div>

                   <div class="mb-4 mt-4">

                        <div class="row mb-3">
                            <div class="col-lg-4"> Name </div>
                            <div class="col-lg-8">
                                <input type="Name" class="form-control" placeholder="Name">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-4"> Mobile Number </div>
                            <div class="col-lg-8">
                                <input type="tel" class="form-control" placeholder="Mobile Number">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-4"> Email </div>
                            <div class="col-lg-8">
                                <input type="email" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-4"> Date </div>
                            <div class="col-lg-8">
                                <div class="input-group date" id="datepicker">
                                    <input type="text" class="form-control" id="date" placeholder="MM/DD/YYYY"/>
                                    <span class="input-group-append">
                                      <span class="input-group-text bg-light d-block">
                                        <i class="fa fa-calendar"></i>
                                      </span>
                                    </span>
                                  </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-4"> Select Person </div>
                            <div class="col-lg-8">
                                <select class="form-select" aria-label="Select">
                                    <option selected>0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="3">4</option>
                                    <option value="3">5</option>
                                    <option value="3">6</option>
                                    <option value="3">7</option>
                                    <option value="3">8</option>
                                    <option value="3">9</option>
                                    <option value="3">10</option>
                                  </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-4">Select Number of Lanes </div>
                            <div class="col-lg-8">
                                <select class="form-select" aria-label="Select">
                                    <option selected>0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="3">4</option>
                                    <option value="3">5</option>
                                    <option value="3">6</option>
                                    <option value="3">7</option>
                                    <option value="3">8</option>
                                    <option value="3">9</option>
                                    <option value="3">10</option>
                                  </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-4">We Can Offer You the Following Start Times</div>
                            <div class="col-lg-8">
                                <select class="form-select" aria-label="select ">
                                    <option selected>3:00</option>
                                    <option value="1">4:00</option>
                                    <option value="2">5:00</option>
                                    <option value="3">6:00</option>
                                    <option value="3">7:00</option>
                                    <option value="3">8:00</option>
                                    <option value="3">9:00</option>
                                    <option value="3">10:00</option>
                                  </select>
                            </div>
                        </div>

                        <div class="text-center"><button class="btn-form" type="submit">Submit</button></div>

                    </div>
                </form>
            </div>
            </section> -->


    <footer id="main-footer">

        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 "><p><img class="img-fluid"
                                                        src="https://wordpressmu-603031-4219011.cloudwaysapps.com/wp-content/uploads/2024/01/logo1-w.png">
                    </p>
                    <p>We constantly have new projects on the go, so come on by and see what’s new!</p>
                </div>
                <div class="col-lg-3 col-md-3 px-lg-5"><h4 class="title">Quick Link</h4>

                    <ul id="menu-footer" class="menu">
                        <li id="menu-item-291"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-291"><a
                                    href="https://wordpressmu-603031-4219011.cloudwaysapps.com/home/">Home</a></li>
                        <li id="menu-item-290"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-290"><a
                                    href="https://wordpressmu-603031-4219011.cloudwaysapps.com/about-us/">About us</a>
                        </li>
                        <li id="menu-item-289"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-289"><a
                                    href="https://wordpressmu-603031-4219011.cloudwaysapps.com/packages/">Packages</a>
                        </li>
                        <li id="menu-item-288"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-288"><a
                                    href="https://wordpressmu-603031-4219011.cloudwaysapps.com/blog/">Blog</a></li>
                        <li id="menu-item-287"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-287"><a
                                    href="https://wordpressmu-603031-4219011.cloudwaysapps.com/contact-us/">Contact
                                Us</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-3"><h4 class="title">Hours</h4>
                    <p><b>Mon- Fir:</b> 12:00 PM – 12:00 AM</p>
                    <p><b>Saturday:</b> 12:00 PM – 1:00 AM</p>
                    <p><b>Sunday:</b> 12:00 PM – 7:00 PM</p>
                </div>
                <div class="col-lg-3 col-md-3 "><h4 class="title">Follow Us</h4>
                    <div><a href="">
                            <div class="fb">
                                <i class="fa-brands fa-facebook-f"></i>
                            </div>
                        </a></div>
                    <div><a href="">
                            <div class="insta">
                                <i class="fa-brands fa-instagram"></i>
                            </div>
                        </a></div>
                    <div><a href="">
                            <div class="location">
                                <i class="fa-brands fa-linkedin-in"></i>
                            </div>
                        </a></div>
                </div>
            </div>
        </div>


        <div id="footer-bottom">
            <div class="container clearfix">
                <ul class="et-social-icons">

                    <li class="et-social-icon et-social-facebook">
                        <a href="#" class="icon">
                            <span>Facebook</span>
                        </a>
                    </li>
                    <li class="et-social-icon et-social-twitter">
                        <a href="#" class="icon">
                            <span>X</span>
                        </a>
                    </li>
                    <li class="et-social-icon et-social-instagram">
                        <a href="#" class="icon">
                            <span>Instagram</span>
                        </a>
                    </li>

                </ul>
                <div id="footer-info">Copyright © 2024 Black Diamond Bowl &amp; Billiards - All Rights Reserved.</div>
            </div>
        </div>
    </footer>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    <script>
        $(function () {
            $('#datepicker').datepicker();
        });
    </script>
    <script>
        (function () {
            $('.hamburger-menu').on('click', function () {
                $('.bar').toggleClass('animate');
                var mobileNav = $('.mobile-nav');
                mobileNav.toggleClass('hide show');
            })
        })();
    </script>
    <script>
        'use strict';

        document.addEventListener('DOMContentLoaded', function (event) {

            //jQuery time
            var currentFs, nextFs, previousFs; //fieldsets
            var left, opacity, scale; //fieldset properties which we will animate
            var animating; //flag to prevent quick multi-click glitches
            // var slideout = new Slideout({
            //     'panel': document.getElementById('page'),
            //     'menu': document.getElementById('site-navigation'),
            //     'padding': 256,
            //     'tolerance': 70
            // });

            var isInViewport = function isInViewport(elem) {
                var bounding = elem.getBoundingClientRect();
                return bounding.top >= 0 && bounding.left >= 0 && bounding.bottom <= (window.innerHeight || document.documentElement.clientHeight) && bounding.right <= (window.innerWidth || document.documentElement.clientWidth);
            };
            var yesterday = new Date();
            // yesterday.setDate( yesterday.getDate() - 1 );
            //jQuery('#datepickerdiv').datepicker({
            //   altField: '#datepicker',
            //   minDate: new Date(yesterday),
            //   onSelect: function onSelect() {
            //      jQuery('#firststep_3').click();
            //  }
            //});

            // document.getElementById('menuopen').addEventListener('click', function () {
            //     slideout.toggle();
            // });

            // function close(eve) {
            //     eve.preventDefault();
            //     slideout.close();
            // }

            // slideout.on('beforeopen', function () {
            //     this.panel.classList.add('panel-open');
            // }).on('open', function () {
            //     this.panel.addEventListener('click', close);
            // }).on('beforeclose', function () {
            //     this.panel.classList.remove('panel-open');
            //     this.panel.removeEventListener('click', close);
            // });

            window.addEventListener('scroll', function () {
                var form = document.getElementById('msform');
                if (!isInViewport(form)) {
                    jQuery('#headerQuote').show();
                } else {
                    jQuery('#headerQuote').hide();
                }
            });

            jQuery('.next').click(function (e) {
                if (animating) {
                    return false;
                }
                animating = true;

                currentFs = jQuery(this).parent().parent();
                nextFs = jQuery(this).parent().parent().next();

                if (jQuery(this).hasClass('radio-next-js')) {
                    currentFs = jQuery(this).closest('fieldset');
                    nextFs = currentFs.next();
                }

                //activate next step on progressbar using the index of nextFs
                jQuery('#progressbar li').eq(jQuery('fieldset').index(nextFs)).addClass('active');

                //show the next fieldset
                nextFs.show();

                //hide the current fieldset with style
                currentFs.animate({opacity: 0}, {
                    step: function step(now, mx) {

                        //as the opacity of currentFs reduces to 0 - stored in "now"
                        //1. scale currentFs down to 80%
                        scale = 1 - (1 - now) * 0.2;

                        //2. bring nextFs from the right(50%)
                        left = now * 50 + '%';

                        //3. increase opacity of nextFs to 1 as it moves in
                        opacity = 1 - now;
                        currentFs.css({
                            'transform': 'scale(' + scale + ')',
                            'position': 'absolute'
                        });
                        nextFs.css({'left': left, 'opacity': opacity});
                    },
                    duration: 800,
                    complete: function complete() {
                        currentFs.hide();
                        animating = false;
                    }

                    //this comes from the custom easing plugin
                    // easing: 'easeInOutBack'
                });
            });

            jQuery('.previous').click(function () {
                if (animating) {
                    return false;
                }
                animating = true;

                currentFs = jQuery(this).parent().parent();
                previousFs = jQuery(this).parent().parent().prev();

                //de-activate current step on progressbar
                jQuery('#progressbar li').eq(jQuery('fieldset').index(currentFs)).removeClass('active');

                //show the previous fieldset
                previousFs.show();

                //hide the current fieldset with style
                currentFs.animate({opacity: 0}, {
                    step: function step(now, mx) {

                        //as the opacity of currentFs reduces to 0 - stored in "now"
                        //1. scale previousFs from 80% to 100%
                        scale = 0.8 + (1 - now) * 0.2;

                        //2. take currentFs to the right(50%) - from 0%
                        left = (1 - now) * 50 + '%';

                        //3. increase opacity of previousFs to 1 as it moves in
                        opacity = 1 - now;
                        currentFs.css({'left': left});
                        previousFs.css({'transform': 'scale(' + scale + ')', 'opacity': opacity});
                    },
                    duration: 800,
                    complete: function complete() {
                        currentFs.hide();
                        previousFs.css({'position': 'relative'});
                        animating = false;
                    }

                    //this comes from the custom easing plugin
                    // easing: 'easeInOutBack'
                });
            });

            /* Select 2  */
            /*if (jQuery('#zipto').length) {
                jQuery('#zipto').select2({
                    placeholder: 'ie Atlanta, LA',
                    minimumInputLength: 3,
                    ajax: {
                        url: plumb_ajax.ajax_url,
                        dataType: 'json',
                        type: 'POST',
                        delay: 250,
                        data: function data(params) {
                            return {
                                city: params.term,
                                action: 'myajax_search'
                            };
                        },
                        processResults: function processResults(data, params) {
                            return {
                                results: data.items
                            };
                        },
                        cache: true
                    }
                });
                jQuery('#zipto').on('select2:select', function (e) {
                    if (jQuery('#zipfrom').val() != '' && jQuery('#zipfrom').val != '') {
                        jQuery('#firststep_1').click();
                    }
                });
            }*/

            jQuery('#zipfrom').keyup(function () {
                var zipfrom_val = jQuery(this).val();
                // var zipfrom_val = jQuery( '#zipfrom' ).val();
                if (zipfrom_val.length >= 5 && jQuery('#zipto').val() != '') {
                    jQuery('#firststep_1').click();
                }
            });

            /*jQuery('#msform').on('submit', function (e) {
                e.preventDefault();

                var $form = jQuery(this);
                  jQuery("#formSend").attr( 'disabled', true );
                // var data = $form.serialize();
                var form = document.getElementById('msform');
                var formData = serializeArray(form);

                jQuery.post(et_pb_custom.ajaxurl, formData, function (data) {
                    var response = JSON.parse(data);
                    if (response.success == true) {
                        redirect();

                    }
                }, 'json').done(function () {}).fail(function (xhr, textStatus, errorThrown) {
                    alert('somthing goes wrong');
                }).always(function () {});
            });*/

            function redirect() {
                var url = jQuery('input[name=REDIRECT]').val();
                setTimeout(function () {
                    window.location.replace(url);
                }, 1500);
            }

            /*jQuery('#msform input:not([type=hidden])').keyup(function () {
                var empty = false;
                jQuery('#msform input').each(function () {
                    if (jQuery(this).val() == '') {
                        empty = true;
                    }
                });
                if (empty) {
                    jQuery('#formSend').attr('disabled', 'disabled');
                } else {
                    jQuery('#formSend').removeAttr('disabled');
                }
            });*/

            var serializeArray = function serializeArray(form) {
                var serialized = [];
                for (var i = 0; i < form.elements.length; i++) {
                    var field = form.elements[i];
                    if (!field.name || field.disabled || field.type === 'file' || field.type === 'reset' || field.type === 'submit' || field.type === 'button') continue;
                    if ('select-multiple' === field.type) {
                        for (var n = 0; n < field.options.length; n++) {
                            if (!field.options[n].selected) {
                                continue;
                            }
                            serialized.push({
                                name: field.name,
                                value: field.options[n].value
                            });
                        }
                    } else if ('checkbox' !== field.type && 'radio' !== field.type || field.checked) {
                        serialized.push({
                            name: field.name,
                            value: field.value
                        });
                    }
                }
                return serialized;
            };


            /* jQuery("#msform").submit(function() {
              jQuery("#formSend").attr( 'disabled', true );
            }); */
        });
    </script>
    <script>
        /* =========================================================
     * bootstrap-datepicker.js
     * Repo: https://github.com/eternicode/bootstrap-datepicker/
     * Demo: https://eternicode.github.io/bootstrap-datepicker/
     * Docs: http://bootstrap-datepicker.readthedocs.org/
     * Forked from http://www.eyecon.ro/bootstrap-datepicker
     * =========================================================
     * Started by Stefan Petre; improvements by Andrew Rowls + contributors
     *
     * Licensed under the Apache License, Version 2.0 (the "License");
     * you may not use this file except in compliance with the License.
     * You may obtain a copy of the License at
     *
     * http://www.apache.org/licenses/LICENSE-2.0
     *
     * Unless required by applicable law or agreed to in writing, software
     * distributed under the License is distributed on an "AS IS" BASIS,
     * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
     * See the License for the specific language governing permissions and
     * limitations under the License.
     * ========================================================= */

        (function ($, undefined) {

            var $window = $(window);

            function UTCDate() {
                return new Date(Date.UTC.apply(Date, arguments));
            }

            function UTCToday() {
                var today = new Date();
                return UTCDate(today.getFullYear(), today.getMonth(), today.getDate());
            }

            function alias(method) {
                return function () {
                    return this[method].apply(this, arguments);
                };
            }

            var DateArray = (function () {
                var extras = {
                    get: function (i) {
                        return this.slice(i)[0];
                    },
                    contains: function (d) {
                        // Array.indexOf is not cross-browser;
                        // $.inArray doesn't work with Dates
                        var val = d && d.valueOf();
                        for (var i = 0, l = this.length; i < l; i++)
                            if (this[i].valueOf() === val)
                                return i;
                        return -1;
                    },
                    remove: function (i) {
                        this.splice(i, 1);
                    },
                    replace: function (new_array) {
                        if (!new_array)
                            return;
                        if (!$.isArray(new_array))
                            new_array = [new_array];
                        this.clear();
                        this.push.apply(this, new_array);
                    },
                    clear: function () {
                        this.length = 0;
                    },
                    copy: function () {
                        var a = new DateArray();
                        a.replace(this);
                        return a;
                    }
                };

                return function () {
                    var a = [];
                    a.push.apply(a, arguments);
                    $.extend(a, extras);
                    return a;
                };
            })();


// Picker object

            var Datepicker = function (element, options) {
                this.dates = new DateArray();
                this.viewDate = UTCToday();
                this.focusDate = null;

                this._process_options(options);

                this.element = $(element);
                this.isInline = false;
                this.isInput = this.element.is('input');
                this.component = this.element.is('.date') ? this.element.find('.add-on, .input-group-addon, .btn') : false;
                this.hasInput = this.component && this.element.find('input').length;
                if (this.component && this.component.length === 0)
                    this.component = false;

                this.picker = $(DPGlobal.template);
                this._buildEvents();
                this._attachEvents();

                if (this.isInline) {
                    this.picker.addClass('datepicker-inline').appendTo(this.element);
                } else {
                    this.picker.addClass('datepicker-dropdown dropdown-menu');
                }

                if (this.o.rtl) {
                    this.picker.addClass('datepicker-rtl');
                }

                this.viewMode = this.o.startView;

                if (this.o.calendarWeeks)
                    this.picker.find('tfoot th.today')
                        .attr('colspan', function (i, val) {
                            return parseInt(val) + 1;
                        });

                this._allow_update = false;

                this.setStartDate(this._o.startDate);
                this.setEndDate(this._o.endDate);
                this.setDaysOfWeekDisabled(this.o.daysOfWeekDisabled);

                this.fillDow();
                this.fillMonths();

                this._allow_update = true;

                this.update();
                this.showMode();

                if (this.isInline) {
                    this.show();
                }
            };

            Datepicker.prototype = {
                constructor: Datepicker,

                _process_options: function (opts) {
                    // Store raw options for reference
                    this._o = $.extend({}, this._o, opts);
                    // Processed options
                    var o = this.o = $.extend({}, this._o);

                    // Check if "de-DE" style date is available, if not language should
                    // fallback to 2 letter code eg "de"
                    var lang = o.language;
                    if (!dates[lang]) {
                        lang = lang.split('-')[0];
                        if (!dates[lang])
                            lang = defaults.language;
                    }
                    o.language = lang;

                    switch (o.startView) {
                        case 2:
                        case 'decade':
                            o.startView = 2;
                            break;
                        case 1:
                        case 'year':
                            o.startView = 1;
                            break;
                        default:
                            o.startView = 0;
                    }

                    switch (o.minViewMode) {
                        case 1:
                        case 'months':
                            o.minViewMode = 1;
                            break;
                        case 2:
                        case 'years':
                            o.minViewMode = 2;
                            break;
                        default:
                            o.minViewMode = 0;
                    }

                    o.startView = Math.max(o.startView, o.minViewMode);

                    // true, false, or Number > 0
                    if (o.multidate !== true) {
                        o.multidate = Number(o.multidate) || false;
                        if (o.multidate !== false)
                            o.multidate = Math.max(0, o.multidate);
                        else
                            o.multidate = 1;
                    }
                    o.multidateSeparator = String(o.multidateSeparator);

                    o.weekStart %= 7;
                    o.weekEnd = ((o.weekStart + 6) % 7);

                    var format = DPGlobal.parseFormat(o.format);
                    if (o.startDate !== -Infinity) {
                        if (!!o.startDate) {
                            if (o.startDate instanceof Date)
                                o.startDate = this._local_to_utc(this._zero_time(o.startDate));
                            else
                                o.startDate = DPGlobal.parseDate(o.startDate, format, o.language);
                        } else {
                            o.startDate = -Infinity;
                        }
                    }
                    if (o.endDate !== Infinity) {
                        if (!!o.endDate) {
                            if (o.endDate instanceof Date)
                                o.endDate = this._local_to_utc(this._zero_time(o.endDate));
                            else
                                o.endDate = DPGlobal.parseDate(o.endDate, format, o.language);
                        } else {
                            o.endDate = Infinity;
                        }
                    }

                    o.daysOfWeekDisabled = o.daysOfWeekDisabled || [];
                    if (!$.isArray(o.daysOfWeekDisabled))
                        o.daysOfWeekDisabled = o.daysOfWeekDisabled.split(/[,\s]*/);
                    o.daysOfWeekDisabled = $.map(o.daysOfWeekDisabled, function (d) {
                        return parseInt(d, 10);
                    });

                    var plc = String(o.orientation).toLowerCase().split(/\s+/g),
                        _plc = o.orientation.toLowerCase();
                    plc = $.grep(plc, function (word) {
                        return (/^auto|left|right|top|bottom$/).test(word);
                    });
                    o.orientation = {x: 'auto', y: 'auto'};
                    if (!_plc || _plc === 'auto')
                        ; // no action
                    else if (plc.length === 1) {
                        switch (plc[0]) {
                            case 'top':
                            case 'bottom':
                                o.orientation.y = plc[0];
                                break;
                            case 'left':
                            case 'right':
                                o.orientation.x = plc[0];
                                break;
                        }
                    } else {
                        _plc = $.grep(plc, function (word) {
                            return (/^left|right$/).test(word);
                        });
                        o.orientation.x = _plc[0] || 'auto';

                        _plc = $.grep(plc, function (word) {
                            return (/^top|bottom$/).test(word);
                        });
                        o.orientation.y = _plc[0] || 'auto';
                    }
                },
                _events: [],
                _secondaryEvents: [],
                _applyEvents: function (evs) {
                    for (var i = 0, el, ch, ev; i < evs.length; i++) {
                        el = evs[i][0];
                        if (evs[i].length === 2) {
                            ch = undefined;
                            ev = evs[i][1];
                        } else if (evs[i].length === 3) {
                            ch = evs[i][1];
                            ev = evs[i][2];
                        }
                        el.on(ev, ch);
                    }
                },
                _unapplyEvents: function (evs) {
                    for (var i = 0, el, ev, ch; i < evs.length; i++) {
                        el = evs[i][0];
                        if (evs[i].length === 2) {
                            ch = undefined;
                            ev = evs[i][1];
                        } else if (evs[i].length === 3) {
                            ch = evs[i][1];
                            ev = evs[i][2];
                        }
                        el.off(ev, ch);
                    }
                },
                _buildEvents: function () {
                    if (this.isInput) { // single input
                        this._events = [
                            [this.element, {
                                focus: $.proxy(this.show, this),
                                keyup: $.proxy(function (e) {
                                    if ($.inArray(e.keyCode, [27, 37, 39, 38, 40, 32, 13, 9]) === -1)
                                        this.update();
                                }, this),
                                keydown: $.proxy(this.keydown, this)
                            }]
                        ];
                    } else if (this.component && this.hasInput) { // component: input + button
                        this._events = [
                            // For components that are not readonly, allow keyboard nav
                            [this.element.find('input'), {
                                focus: $.proxy(this.show, this),
                                keyup: $.proxy(function (e) {
                                    if ($.inArray(e.keyCode, [27, 37, 39, 38, 40, 32, 13, 9]) === -1)
                                        this.update();
                                }, this),
                                keydown: $.proxy(this.keydown, this)
                            }],
                            [this.component, {
                                click: $.proxy(this.show, this)
                            }]
                        ];
                    } else if (this.element.is('div')) {  // inline datepicker
                        this.isInline = true;
                    } else {
                        this._events = [
                            [this.element, {
                                click: $.proxy(this.show, this)
                            }]
                        ];
                    }
                    this._events.push(
                        // Component: listen for blur on element descendants
                        [this.element, '*', {
                            blur: $.proxy(function (e) {
                                this._focused_from = e.target;
                            }, this)
                        }],
                        // Input: listen for blur on element
                        [this.element, {
                            blur: $.proxy(function (e) {
                                this._focused_from = e.target;
                            }, this)
                        }]
                    );

                    this._secondaryEvents = [
                        [this.picker, {
                            click: $.proxy(this.click, this)
                        }],
                        [$(window), {
                            resize: $.proxy(this.place, this)
                        }],
                        [$(document), {
                            'mousedown touchstart': $.proxy(function (e) {
                                // Clicked outside the datepicker, hide it
                                if (!(
                                    this.element.is(e.target) ||
                                    this.element.find(e.target).length ||
                                    this.picker.is(e.target) ||
                                    this.picker.find(e.target).length
                                )) {
                                    this.hide();
                                }
                            }, this)
                        }]
                    ];
                },
                _attachEvents: function () {
                    this._detachEvents();
                    this._applyEvents(this._events);
                },
                _detachEvents: function () {
                    this._unapplyEvents(this._events);
                },
                _attachSecondaryEvents: function () {
                    this._detachSecondaryEvents();
                    this._applyEvents(this._secondaryEvents);
                },
                _detachSecondaryEvents: function () {
                    this._unapplyEvents(this._secondaryEvents);
                },
                _trigger: function (event, altdate) {
                    var date = altdate || this.dates.get(-1),
                        local_date = this._utc_to_local(date);

                    this.element.trigger({
                        type: event,
                        date: local_date,
                        dates: $.map(this.dates, this._utc_to_local),
                        format: $.proxy(function (ix, format) {
                            if (arguments.length === 0) {
                                ix = this.dates.length - 1;
                                format = this.o.format;
                            } else if (typeof ix === 'string') {
                                format = ix;
                                ix = this.dates.length - 1;
                            }
                            format = format || this.o.format;
                            var date = this.dates.get(ix);
                            return DPGlobal.formatDate(date, format, this.o.language);
                        }, this)
                    });
                },

                show: function () {
                    if (!this.isInline)
                        this.picker.appendTo('body');
                    this.picker.show();
                    this.place();
                    this._attachSecondaryEvents();
                    this._trigger('show');
                },

                hide: function () {
                    if (this.isInline)
                        return;
                    if (!this.picker.is(':visible'))
                        return;
                    this.focusDate = null;
                    this.picker.hide().detach();
                    this._detachSecondaryEvents();
                    this.viewMode = this.o.startView;
                    this.showMode();

                    if (
                        this.o.forceParse &&
                        (
                            this.isInput && this.element.val() ||
                            this.hasInput && this.element.find('input').val()
                        )
                    )
                        this.setValue();
                    this._trigger('hide');
                },

                remove: function () {
                    this.hide();
                    this._detachEvents();
                    this._detachSecondaryEvents();
                    this.picker.remove();
                    delete this.element.data().datepicker;
                    if (!this.isInput) {
                        delete this.element.data().date;
                    }
                },

                _utc_to_local: function (utc) {
                    return utc && new Date(utc.getTime() + (utc.getTimezoneOffset() * 60000));
                },
                _local_to_utc: function (local) {
                    return local && new Date(local.getTime() - (local.getTimezoneOffset() * 60000));
                },
                _zero_time: function (local) {
                    return local && new Date(local.getFullYear(), local.getMonth(), local.getDate());
                },
                _zero_utc_time: function (utc) {
                    return utc && new Date(Date.UTC(utc.getUTCFullYear(), utc.getUTCMonth(), utc.getUTCDate()));
                },

                getDates: function () {
                    return $.map(this.dates, this._utc_to_local);
                },

                getUTCDates: function () {
                    return $.map(this.dates, function (d) {
                        return new Date(d);
                    });
                },

                getDate: function () {
                    return this._utc_to_local(this.getUTCDate());
                },

                getUTCDate: function () {
                    return new Date(this.dates.get(-1));
                },

                setDates: function () {
                    var args = $.isArray(arguments[0]) ? arguments[0] : arguments;
                    this.update.apply(this, args);
                    this._trigger('changeDate');
                    this.setValue();
                },

                setUTCDates: function () {
                    var args = $.isArray(arguments[0]) ? arguments[0] : arguments;
                    this.update.apply(this, $.map(args, this._utc_to_local));
                    this._trigger('changeDate');
                    this.setValue();
                },

                setDate: alias('setDates'),
                setUTCDate: alias('setUTCDates'),

                setValue: function () {
                    var formatted = this.getFormattedDate();
                    if (!this.isInput) {
                        if (this.component) {
                            this.element.find('input').val(formatted).change();
                        }
                    } else {
                        this.element.val(formatted).change();
                    }
                },

                getFormattedDate: function (format) {
                    if (format === undefined)
                        format = this.o.format;

                    var lang = this.o.language;
                    return $.map(this.dates, function (d) {
                        return DPGlobal.formatDate(d, format, lang);
                    }).join(this.o.multidateSeparator);
                },

                setStartDate: function (startDate) {
                    this._process_options({startDate: startDate});
                    this.update();
                    this.updateNavArrows();
                },

                setEndDate: function (endDate) {
                    this._process_options({endDate: endDate});
                    this.update();
                    this.updateNavArrows();
                },

                setDaysOfWeekDisabled: function (daysOfWeekDisabled) {
                    this._process_options({daysOfWeekDisabled: daysOfWeekDisabled});
                    this.update();
                    this.updateNavArrows();
                },

                place: function () {
                    if (this.isInline)
                        return;
                    var calendarWidth = this.picker.outerWidth(),
                        calendarHeight = this.picker.outerHeight(),
                        visualPadding = 10,
                        windowWidth = $window.width(),
                        windowHeight = $window.height(),
                        scrollTop = $window.scrollTop();

                    var zIndex = parseInt(this.element.parents().filter(function () {
                        return $(this).css('z-index') !== 'auto';
                    }).first().css('z-index')) + 10;
                    var offset = this.component ? this.component.parent().offset() : this.element.offset();
                    var height = this.component ? this.component.outerHeight(true) : this.element.outerHeight(false);
                    var width = this.component ? this.component.outerWidth(true) : this.element.outerWidth(false);
                    var left = offset.left,
                        top = offset.top;

                    this.picker.removeClass(
                        'datepicker-orient-top datepicker-orient-bottom ' +
                        'datepicker-orient-right datepicker-orient-left'
                    );

                    if (this.o.orientation.x !== 'auto') {
                        this.picker.addClass('datepicker-orient-' + this.o.orientation.x);
                        if (this.o.orientation.x === 'right')
                            left -= calendarWidth - width;
                    }
                        // auto x orientation is best-placement: if it crosses a window
                    // edge, fudge it sideways
                    else {
                        // Default to left
                        this.picker.addClass('datepicker-orient-left');
                        if (offset.left < 0)
                            left -= offset.left - visualPadding;
                        else if (offset.left + calendarWidth > windowWidth)
                            left = windowWidth - calendarWidth - visualPadding;
                    }

                    // auto y orientation is best-situation: top or bottom, no fudging,
                    // decision based on which shows more of the calendar
                    var yorient = this.o.orientation.y,
                        top_overflow, bottom_overflow;
                    if (yorient === 'auto') {
                        top_overflow = -scrollTop + offset.top - calendarHeight;
                        bottom_overflow = scrollTop + windowHeight - (offset.top + height + calendarHeight);
                        if (Math.max(top_overflow, bottom_overflow) === bottom_overflow)
                            yorient = 'top';
                        else
                            yorient = 'bottom';
                    }
                    this.picker.addClass('datepicker-orient-' + yorient);
                    if (yorient === 'top')
                        top += height;
                    else
                        top -= calendarHeight + parseInt(this.picker.css('padding-top'));

                    this.picker.css({
                        top: top,
                        left: left,
                        zIndex: zIndex
                    });
                },

                _allow_update: true,
                update: function () {
                    if (!this._allow_update)
                        return;

                    var oldDates = this.dates.copy(),
                        dates = [],
                        fromArgs = false;
                    if (arguments.length) {
                        $.each(arguments, $.proxy(function (i, date) {
                            if (date instanceof Date)
                                date = this._local_to_utc(date);
                            dates.push(date);
                        }, this));
                        fromArgs = true;
                    } else {
                        dates = this.isInput
                            ? this.element.val()
                            : this.element.data('date') || this.element.find('input').val();
                        if (dates && this.o.multidate)
                            dates = dates.split(this.o.multidateSeparator);
                        else
                            dates = [dates];
                        delete this.element.data().date;
                    }

                    dates = $.map(dates, $.proxy(function (date) {
                        return DPGlobal.parseDate(date, this.o.format, this.o.language);
                    }, this));
                    dates = $.grep(dates, $.proxy(function (date) {
                        return (
                            date < this.o.startDate ||
                            date > this.o.endDate ||
                            !date
                        );
                    }, this), true);
                    this.dates.replace(dates);

                    if (this.dates.length)
                        this.viewDate = new Date(this.dates.get(-1));
                    else if (this.viewDate < this.o.startDate)
                        this.viewDate = new Date(this.o.startDate);
                    else if (this.viewDate > this.o.endDate)
                        this.viewDate = new Date(this.o.endDate);

                    if (fromArgs) {
                        // setting date by clicking
                        this.setValue();
                    } else if (dates.length) {
                        // setting date by typing
                        if (String(oldDates) !== String(this.dates))
                            this._trigger('changeDate');
                    }
                    if (!this.dates.length && oldDates.length)
                        this._trigger('clearDate');

                    this.fill();
                },

                fillDow: function () {
                    var dowCnt = this.o.weekStart,
                        html = '<tr>';
                    if (this.o.calendarWeeks) {
                        var cell = '<th class="cw">&nbsp;</th>';
                        html += cell;
                        this.picker.find('.datepicker-days thead tr:first-child').prepend(cell);
                    }
                    while (dowCnt < this.o.weekStart + 7) {
                        html += '<th class="dow">' + dates[this.o.language].daysMin[(dowCnt++) % 7] + '</th>';
                    }
                    html += '</tr>';
                    this.picker.find('.datepicker-days thead').append(html);
                },

                fillMonths: function () {
                    var html = '',
                        i = 0;
                    while (i < 12) {
                        html += '<span class="month">' + dates[this.o.language].monthsShort[i++] + '</span>';
                    }
                    this.picker.find('.datepicker-months td').html(html);
                },

                setRange: function (range) {
                    if (!range || !range.length)
                        delete this.range;
                    else
                        this.range = $.map(range, function (d) {
                            return d.valueOf();
                        });
                    this.fill();
                },

                getClassNames: function (date) {
                    var cls = [],
                        year = this.viewDate.getUTCFullYear(),
                        month = this.viewDate.getUTCMonth(),
                        today = new Date();
                    if (date.getUTCFullYear() < year || (date.getUTCFullYear() === year && date.getUTCMonth() < month)) {
                        cls.push('old');
                    } else if (date.getUTCFullYear() > year || (date.getUTCFullYear() === year && date.getUTCMonth() > month)) {
                        cls.push('new');
                    }
                    if (this.focusDate && date.valueOf() === this.focusDate.valueOf())
                        cls.push('focused');
                    // Compare internal UTC date with local today, not UTC today
                    if (this.o.todayHighlight &&
                        date.getUTCFullYear() === today.getFullYear() &&
                        date.getUTCMonth() === today.getMonth() &&
                        date.getUTCDate() === today.getDate()) {
                        cls.push('today');
                    }
                    if (this.dates.contains(date) !== -1)
                        cls.push('active');
                    if (date.valueOf() < this.o.startDate || date.valueOf() > this.o.endDate ||
                        $.inArray(date.getUTCDay(), this.o.daysOfWeekDisabled) !== -1) {
                        cls.push('disabled');
                    }
                    if (this.range) {
                        if (date > this.range[0] && date < this.range[this.range.length - 1]) {
                            cls.push('range');
                        }
                        if ($.inArray(date.valueOf(), this.range) !== -1) {
                            cls.push('selected');
                        }
                    }
                    return cls;
                },

                fill: function () {
                    var d = new Date(this.viewDate),
                        year = d.getUTCFullYear(),
                        month = d.getUTCMonth(),
                        startYear = this.o.startDate !== -Infinity ? this.o.startDate.getUTCFullYear() : -Infinity,
                        startMonth = this.o.startDate !== -Infinity ? this.o.startDate.getUTCMonth() : -Infinity,
                        endYear = this.o.endDate !== Infinity ? this.o.endDate.getUTCFullYear() : Infinity,
                        endMonth = this.o.endDate !== Infinity ? this.o.endDate.getUTCMonth() : Infinity,
                        todaytxt = dates[this.o.language].today || dates['en'].today || '',
                        cleartxt = dates[this.o.language].clear || dates['en'].clear || '',
                        tooltip;
                    this.picker.find('.datepicker-days thead th.datepicker-switch')
                        .text(dates[this.o.language].months[month] + ' ' + year);
                    this.picker.find('tfoot th.today')
                        .text(todaytxt)
                        .toggle(this.o.todayBtn !== false);
                    this.picker.find('tfoot th.clear')
                        .text(cleartxt)
                        .toggle(this.o.clearBtn !== false);
                    this.updateNavArrows();
                    this.fillMonths();
                    var prevMonth = UTCDate(year, month - 1, 28),
                        day = DPGlobal.getDaysInMonth(prevMonth.getUTCFullYear(), prevMonth.getUTCMonth());
                    prevMonth.setUTCDate(day);
                    prevMonth.setUTCDate(day - (prevMonth.getUTCDay() - this.o.weekStart + 7) % 7);
                    var nextMonth = new Date(prevMonth);
                    nextMonth.setUTCDate(nextMonth.getUTCDate() + 42);
                    nextMonth = nextMonth.valueOf();
                    var html = [];
                    var clsName;
                    while (prevMonth.valueOf() < nextMonth) {
                        if (prevMonth.getUTCDay() === this.o.weekStart) {
                            html.push('<tr>');
                            if (this.o.calendarWeeks) {
                                // ISO 8601: First week contains first thursday.
                                // ISO also states week starts on Monday, but we can be more abstract here.
                                var
                                    // Start of current week: based on weekstart/current date
                                    ws = new Date(+prevMonth + (this.o.weekStart - prevMonth.getUTCDay() - 7) % 7 * 864e5),
                                    // Thursday of this week
                                    th = new Date(Number(ws) + (7 + 4 - ws.getUTCDay()) % 7 * 864e5),
                                    // First Thursday of year, year from thursday
                                    yth = new Date(Number(yth = UTCDate(th.getUTCFullYear(), 0, 1)) + (7 + 4 - yth.getUTCDay()) % 7 * 864e5),
                                    // Calendar week: ms between thursdays, div ms per day, div 7 days
                                    calWeek = (th - yth) / 864e5 / 7 + 1;
                                html.push('<td class="cw">' + calWeek + '</td>');

                            }
                        }
                        clsName = this.getClassNames(prevMonth);
                        clsName.push('day');

                        if (this.o.beforeShowDay !== $.noop) {
                            var before = this.o.beforeShowDay(this._utc_to_local(prevMonth));
                            if (before === undefined)
                                before = {};
                            else if (typeof (before) === 'boolean')
                                before = {enabled: before};
                            else if (typeof (before) === 'string')
                                before = {classes: before};
                            if (before.enabled === false)
                                clsName.push('disabled');
                            if (before.classes)
                                clsName = clsName.concat(before.classes.split(/\s+/));
                            if (before.tooltip)
                                tooltip = before.tooltip;
                        }

                        clsName = $.unique(clsName);
                        html.push('<td class="' + clsName.join(' ') + '"' + (tooltip ? ' title="' + tooltip + '"' : '') + '>' + prevMonth.getUTCDate() + '</td>');
                        if (prevMonth.getUTCDay() === this.o.weekEnd) {
                            html.push('</tr>');
                        }
                        prevMonth.setUTCDate(prevMonth.getUTCDate() + 1);
                    }
                    this.picker.find('.datepicker-days tbody').empty().append(html.join(''));

                    var months = this.picker.find('.datepicker-months')
                        .find('th:eq(1)')
                        .text(year)
                        .end()
                        .find('span').removeClass('active');

                    $.each(this.dates, function (i, d) {
                        if (d.getUTCFullYear() === year)
                            months.eq(d.getUTCMonth()).addClass('active');
                    });

                    if (year < startYear || year > endYear) {
                        months.addClass('disabled');
                    }
                    if (year === startYear) {
                        months.slice(0, startMonth).addClass('disabled');
                    }
                    if (year === endYear) {
                        months.slice(endMonth + 1).addClass('disabled');
                    }

                    html = '';
                    year = parseInt(year / 10, 10) * 10;
                    var yearCont = this.picker.find('.datepicker-years')
                        .find('th:eq(1)')
                        .text(year + '-' + (year + 9))
                        .end()
                        .find('td');
                    year -= 1;
                    var years = $.map(this.dates, function (d) {
                            return d.getUTCFullYear();
                        }),
                        classes;
                    for (var i = -1; i < 11; i++) {
                        classes = ['year'];
                        if (i === -1)
                            classes.push('old');
                        else if (i === 10)
                            classes.push('new');
                        if ($.inArray(year, years) !== -1)
                            classes.push('active');
                        if (year < startYear || year > endYear)
                            classes.push('disabled');
                        html += '<span class="' + classes.join(' ') + '">' + year + '</span>';
                        year += 1;
                    }
                    yearCont.html(html);
                },

                updateNavArrows: function () {
                    if (!this._allow_update)
                        return;

                    var d = new Date(this.viewDate),
                        year = d.getUTCFullYear(),
                        month = d.getUTCMonth();
                    switch (this.viewMode) {
                        case 0:
                            if (this.o.startDate !== -Infinity && year <= this.o.startDate.getUTCFullYear() && month <= this.o.startDate.getUTCMonth()) {
                                this.picker.find('.prev').css({visibility: 'hidden'});
                            } else {
                                this.picker.find('.prev').css({visibility: 'visible'});
                            }
                            if (this.o.endDate !== Infinity && year >= this.o.endDate.getUTCFullYear() && month >= this.o.endDate.getUTCMonth()) {
                                this.picker.find('.next').css({visibility: 'hidden'});
                            } else {
                                this.picker.find('.next').css({visibility: 'visible'});
                            }
                            break;
                        case 1:
                        case 2:
                            if (this.o.startDate !== -Infinity && year <= this.o.startDate.getUTCFullYear()) {
                                this.picker.find('.prev').css({visibility: 'hidden'});
                            } else {
                                this.picker.find('.prev').css({visibility: 'visible'});
                            }
                            if (this.o.endDate !== Infinity && year >= this.o.endDate.getUTCFullYear()) {
                                this.picker.find('.next').css({visibility: 'hidden'});
                            } else {
                                this.picker.find('.next').css({visibility: 'visible'});
                            }
                            break;
                    }
                },

                click: function (e) {
                    e.preventDefault();
                    var target = $(e.target).closest('span, td, th'),
                        year, month, day;
                    if (target.length === 1) {
                        switch (target[0].nodeName.toLowerCase()) {
                            case 'th':
                                switch (target[0].className) {
                                    case 'datepicker-switch':
                                        this.showMode(1);
                                        break;
                                    case 'prev':
                                    case 'next':
                                        var dir = DPGlobal.modes[this.viewMode].navStep * (target[0].className === 'prev' ? -1 : 1);
                                        switch (this.viewMode) {
                                            case 0:
                                                this.viewDate = this.moveMonth(this.viewDate, dir);
                                                this._trigger('changeMonth', this.viewDate);
                                                break;
                                            case 1:
                                            case 2:
                                                this.viewDate = this.moveYear(this.viewDate, dir);
                                                if (this.viewMode === 1)
                                                    this._trigger('changeYear', this.viewDate);
                                                break;
                                        }
                                        this.fill();
                                        break;
                                    case 'today':
                                        var date = new Date();
                                        date = UTCDate(date.getFullYear(), date.getMonth(), date.getDate(), 0, 0, 0);

                                        this.showMode(-2);
                                        var which = this.o.todayBtn === 'linked' ? null : 'view';
                                        this._setDate(date, which);
                                        break;
                                    case 'clear':
                                        var element;
                                        if (this.isInput)
                                            element = this.element;
                                        else if (this.component)
                                            element = this.element.find('input');
                                        if (element)
                                            element.val("").change();
                                        this.update();
                                        this._trigger('changeDate');
                                        if (this.o.autoclose)
                                            this.hide();
                                        break;
                                }
                                break;
                            case 'span':
                                if (!target.is('.disabled')) {
                                    this.viewDate.setUTCDate(1);
                                    if (target.is('.month')) {
                                        day = 1;
                                        month = target.parent().find('span').index(target);
                                        year = this.viewDate.getUTCFullYear();
                                        this.viewDate.setUTCMonth(month);
                                        this._trigger('changeMonth', this.viewDate);
                                        if (this.o.minViewMode === 1) {
                                            this._setDate(UTCDate(year, month, day));
                                        }
                                    } else {
                                        day = 1;
                                        month = 0;
                                        year = parseInt(target.text(), 10) || 0;
                                        this.viewDate.setUTCFullYear(year);
                                        this._trigger('changeYear', this.viewDate);
                                        if (this.o.minViewMode === 2) {
                                            this._setDate(UTCDate(year, month, day));
                                        }
                                    }
                                    this.showMode(-1);
                                    this.fill();
                                }
                                break;
                            case 'td':
                                if (target.is('.day') && !target.is('.disabled')) {
                                    day = parseInt(target.text(), 10) || 1;
                                    year = this.viewDate.getUTCFullYear();
                                    month = this.viewDate.getUTCMonth();
                                    if (target.is('.old')) {
                                        if (month === 0) {
                                            month = 11;
                                            year -= 1;
                                        } else {
                                            month -= 1;
                                        }
                                    } else if (target.is('.new')) {
                                        if (month === 11) {
                                            month = 0;
                                            year += 1;
                                        } else {
                                            month += 1;
                                        }
                                    }
                                    this._setDate(UTCDate(year, month, day));
                                }
                                break;
                        }
                    }
                    if (this.picker.is(':visible') && this._focused_from) {
                        $(this._focused_from).focus();
                    }
                    delete this._focused_from;
                },

                _toggle_multidate: function (date) {
                    var ix = this.dates.contains(date);
                    if (!date) {
                        this.dates.clear();
                    } else if (ix !== -1) {
                        this.dates.remove(ix);
                    } else {
                        this.dates.push(date);
                    }
                    if (typeof this.o.multidate === 'number')
                        while (this.dates.length > this.o.multidate)
                            this.dates.remove(0);
                },

                _setDate: function (date, which) {
                    if (!which || which === 'date')
                        this._toggle_multidate(date && new Date(date));
                    if (!which || which === 'view')
                        this.viewDate = date && new Date(date);

                    this.fill();
                    this.setValue();
                    this._trigger('changeDate');
                    var element;
                    if (this.isInput) {
                        element = this.element;
                    } else if (this.component) {
                        element = this.element.find('input');
                    }
                    if (element) {
                        element.change();
                    }
                    if (this.o.autoclose && (!which || which === 'date')) {
                        this.hide();
                    }
                },

                moveMonth: function (date, dir) {
                    if (!date)
                        return undefined;
                    if (!dir)
                        return date;
                    var new_date = new Date(date.valueOf()),
                        day = new_date.getUTCDate(),
                        month = new_date.getUTCMonth(),
                        mag = Math.abs(dir),
                        new_month, test;
                    dir = dir > 0 ? 1 : -1;
                    if (mag === 1) {
                        test = dir === -1
                            // If going back one month, make sure month is not current month
                            // (eg, Mar 31 -> Feb 31 == Feb 28, not Mar 02)
                            ? function () {
                                return new_date.getUTCMonth() === month;
                            }
                            // If going forward one month, make sure month is as expected
                            // (eg, Jan 31 -> Feb 31 == Feb 28, not Mar 02)
                            : function () {
                                return new_date.getUTCMonth() !== new_month;
                            };
                        new_month = month + dir;
                        new_date.setUTCMonth(new_month);
                        // Dec -> Jan (12) or Jan -> Dec (-1) -- limit expected date to 0-11
                        if (new_month < 0 || new_month > 11)
                            new_month = (new_month + 12) % 12;
                    } else {
                        // For magnitudes >1, move one month at a time...
                        for (var i = 0; i < mag; i++)
                            // ...which might decrease the day (eg, Jan 31 to Feb 28, etc)...
                            new_date = this.moveMonth(new_date, dir);
                        // ...then reset the day, keeping it in the new month
                        new_month = new_date.getUTCMonth();
                        new_date.setUTCDate(day);
                        test = function () {
                            return new_month !== new_date.getUTCMonth();
                        };
                    }
                    // Common date-resetting loop -- if date is beyond end of month, make it
                    // end of month
                    while (test()) {
                        new_date.setUTCDate(--day);
                        new_date.setUTCMonth(new_month);
                    }
                    return new_date;
                },

                moveYear: function (date, dir) {
                    return this.moveMonth(date, dir * 12);
                },

                dateWithinRange: function (date) {
                    return date >= this.o.startDate && date <= this.o.endDate;
                },

                keydown: function (e) {
                    if (this.picker.is(':not(:visible)')) {
                        if (e.keyCode === 27) // allow escape to hide and re-show picker
                            this.show();
                        return;
                    }
                    var dateChanged = false,
                        dir, newDate, newViewDate,
                        focusDate = this.focusDate || this.viewDate;
                    switch (e.keyCode) {
                        case 27: // escape
                            if (this.focusDate) {
                                this.focusDate = null;
                                this.viewDate = this.dates.get(-1) || this.viewDate;
                                this.fill();
                            } else
                                this.hide();
                            e.preventDefault();
                            break;
                        case 37: // left
                        case 39: // right
                            if (!this.o.keyboardNavigation)
                                break;
                            dir = e.keyCode === 37 ? -1 : 1;
                            if (e.ctrlKey) {
                                newDate = this.moveYear(this.dates.get(-1) || UTCToday(), dir);
                                newViewDate = this.moveYear(focusDate, dir);
                                this._trigger('changeYear', this.viewDate);
                            } else if (e.shiftKey) {
                                newDate = this.moveMonth(this.dates.get(-1) || UTCToday(), dir);
                                newViewDate = this.moveMonth(focusDate, dir);
                                this._trigger('changeMonth', this.viewDate);
                            } else {
                                newDate = new Date(this.dates.get(-1) || UTCToday());
                                newDate.setUTCDate(newDate.getUTCDate() + dir);
                                newViewDate = new Date(focusDate);
                                newViewDate.setUTCDate(focusDate.getUTCDate() + dir);
                            }
                            if (this.dateWithinRange(newDate)) {
                                this.focusDate = this.viewDate = newViewDate;
                                this.setValue();
                                this.fill();
                                e.preventDefault();
                            }
                            break;
                        case 38: // up
                        case 40: // down
                            if (!this.o.keyboardNavigation)
                                break;
                            dir = e.keyCode === 38 ? -1 : 1;
                            if (e.ctrlKey) {
                                newDate = this.moveYear(this.dates.get(-1) || UTCToday(), dir);
                                newViewDate = this.moveYear(focusDate, dir);
                                this._trigger('changeYear', this.viewDate);
                            } else if (e.shiftKey) {
                                newDate = this.moveMonth(this.dates.get(-1) || UTCToday(), dir);
                                newViewDate = this.moveMonth(focusDate, dir);
                                this._trigger('changeMonth', this.viewDate);
                            } else {
                                newDate = new Date(this.dates.get(-1) || UTCToday());
                                newDate.setUTCDate(newDate.getUTCDate() + dir * 7);
                                newViewDate = new Date(focusDate);
                                newViewDate.setUTCDate(focusDate.getUTCDate() + dir * 7);
                            }
                            if (this.dateWithinRange(newDate)) {
                                this.focusDate = this.viewDate = newViewDate;
                                this.setValue();
                                this.fill();
                                e.preventDefault();
                            }
                            break;
                        case 32: // spacebar
                            // Spacebar is used in manually typing dates in some formats.
                            // As such, its behavior should not be hijacked.
                            break;
                        case 13: // enter
                            focusDate = this.focusDate || this.dates.get(-1) || this.viewDate;
                            this._toggle_multidate(focusDate);
                            dateChanged = true;
                            this.focusDate = null;
                            this.viewDate = this.dates.get(-1) || this.viewDate;
                            this.setValue();
                            this.fill();
                            if (this.picker.is(':visible')) {
                                e.preventDefault();
                                if (this.o.autoclose)
                                    this.hide();
                            }
                            break;
                        case 9: // tab
                            this.focusDate = null;
                            this.viewDate = this.dates.get(-1) || this.viewDate;
                            this.fill();
                            this.hide();
                            break;
                    }
                    if (dateChanged) {
                        if (this.dates.length)
                            this._trigger('changeDate');
                        else
                            this._trigger('clearDate');
                        var element;
                        if (this.isInput) {
                            element = this.element;
                        } else if (this.component) {
                            element = this.element.find('input');
                        }
                        if (element) {
                            element.change();
                        }
                    }
                },

                showMode: function (dir) {
                    if (dir) {
                        this.viewMode = Math.max(this.o.minViewMode, Math.min(2, this.viewMode + dir));
                    }
                    this.picker
                        .find('>div')
                        .hide()
                        .filter('.datepicker-' + DPGlobal.modes[this.viewMode].clsName)
                        .css('display', 'block');
                    this.updateNavArrows();
                }
            };

            var DateRangePicker = function (element, options) {
                this.element = $(element);
                this.inputs = $.map(options.inputs, function (i) {
                    return i.jquery ? i[0] : i;
                });
                delete options.inputs;

                $(this.inputs)
                    .datepicker(options)
                    .bind('changeDate', $.proxy(this.dateUpdated, this));

                this.pickers = $.map(this.inputs, function (i) {
                    return $(i).data('datepicker');
                });
                this.updateDates();
            };
            DateRangePicker.prototype = {
                updateDates: function () {
                    this.dates = $.map(this.pickers, function (i) {
                        return i.getUTCDate();
                    });
                    this.updateRanges();
                },
                updateRanges: function () {
                    var range = $.map(this.dates, function (d) {
                        return d.valueOf();
                    });
                    $.each(this.pickers, function (i, p) {
                        p.setRange(range);
                    });
                },
                dateUpdated: function (e) {
                    // `this.updating` is a workaround for preventing infinite recursion
                    // between `changeDate` triggering and `setUTCDate` calling.  Until
                    // there is a better mechanism.
                    if (this.updating)
                        return;
                    this.updating = true;

                    var dp = $(e.target).data('datepicker'),
                        new_date = dp.getUTCDate(),
                        i = $.inArray(e.target, this.inputs),
                        l = this.inputs.length;
                    if (i === -1)
                        return;

                    $.each(this.pickers, function (i, p) {
                        if (!p.getUTCDate())
                            p.setUTCDate(new_date);
                    });

                    if (new_date < this.dates[i]) {
                        // Date being moved earlier/left
                        while (i >= 0 && new_date < this.dates[i]) {
                            this.pickers[i--].setUTCDate(new_date);
                        }
                    } else if (new_date > this.dates[i]) {
                        // Date being moved later/right
                        while (i < l && new_date > this.dates[i]) {
                            this.pickers[i++].setUTCDate(new_date);
                        }
                    }
                    this.updateDates();

                    delete this.updating;
                },
                remove: function () {
                    $.map(this.pickers, function (p) {
                        p.remove();
                    });
                    delete this.element.data().datepicker;
                }
            };

            function opts_from_el(el, prefix) {
                // Derive options from element data-attrs
                var data = $(el).data(),
                    out = {}, inkey,
                    replace = new RegExp('^' + prefix.toLowerCase() + '([A-Z])');
                prefix = new RegExp('^' + prefix.toLowerCase());

                function re_lower(_, a) {
                    return a.toLowerCase();
                }

                for (var key in data)
                    if (prefix.test(key)) {
                        inkey = key.replace(replace, re_lower);
                        out[inkey] = data[key];
                    }
                return out;
            }

            function opts_from_locale(lang) {
                // Derive options from locale plugins
                var out = {};
                // Check if "de-DE" style date is available, if not language should
                // fallback to 2 letter code eg "de"
                if (!dates[lang]) {
                    lang = lang.split('-')[0];
                    if (!dates[lang])
                        return;
                }
                var d = dates[lang];
                $.each(locale_opts, function (i, k) {
                    if (k in d)
                        out[k] = d[k];
                });
                return out;
            }

            var old = $.fn.datepicker;
            $.fn.datepicker = function (option) {
                var args = Array.apply(null, arguments);
                args.shift();
                var internal_return;
                this.each(function () {
                    var $this = $(this),
                        data = $this.data('datepicker'),
                        options = typeof option === 'object' && option;
                    if (!data) {
                        var elopts = opts_from_el(this, 'date'),
                            // Preliminary otions
                            xopts = $.extend({}, defaults, elopts, options),
                            locopts = opts_from_locale(xopts.language),
                            // Options priority: js args, data-attrs, locales, defaults
                            opts = $.extend({}, defaults, locopts, elopts, options);
                        if ($this.is('.input-daterange') || opts.inputs) {
                            var ropts = {
                                inputs: opts.inputs || $this.find('input').toArray()
                            };
                            $this.data('datepicker', (data = new DateRangePicker(this, $.extend(opts, ropts))));
                        } else {
                            $this.data('datepicker', (data = new Datepicker(this, opts)));
                        }
                    }
                    if (typeof option === 'string' && typeof data[option] === 'function') {
                        internal_return = data[option].apply(data, args);
                        if (internal_return !== undefined)
                            return false;
                    }
                });
                if (internal_return !== undefined)
                    return internal_return;
                else
                    return this;
            };

            var defaults = $.fn.datepicker.defaults = {
                autoclose: false,
                beforeShowDay: $.noop,
                calendarWeeks: false,
                clearBtn: false,
                daysOfWeekDisabled: [],
                endDate: Infinity,
                forceParse: true,
                format: 'mm/dd/yyyy',
                keyboardNavigation: true,
                language: 'en',
                minViewMode: 0,
                multidate: false,
                multidateSeparator: ',',
                orientation: "auto",
                rtl: false,
                startDate: -Infinity,
                startView: 0,
                todayBtn: false,
                todayHighlight: false,
                weekStart: 0
            };
            var locale_opts = $.fn.datepicker.locale_opts = [
                'format',
                'rtl',
                'weekStart'
            ];
            $.fn.datepicker.Constructor = Datepicker;
            var dates = $.fn.datepicker.dates = {
                en: {
                    days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
                    daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
                    daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"],
                    months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                    monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    today: "Today",
                    clear: "Clear"
                }
            };

            var DPGlobal = {
                modes: [
                    {
                        clsName: 'days',
                        navFnc: 'Month',
                        navStep: 1
                    },
                    {
                        clsName: 'months',
                        navFnc: 'FullYear',
                        navStep: 1
                    },
                    {
                        clsName: 'years',
                        navFnc: 'FullYear',
                        navStep: 10
                    }],
                isLeapYear: function (year) {
                    return (((year % 4 === 0) && (year % 100 !== 0)) || (year % 400 === 0));
                },
                getDaysInMonth: function (year, month) {
                    return [31, (DPGlobal.isLeapYear(year) ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month];
                },
                validParts: /dd?|DD?|mm?|MM?|yy(?:yy)?/g,
                nonpunctuation: /[^ -\/:-@\[\u3400-\u9fff-`{-~\t\n\r]+/g,
                parseFormat: function (format) {
                    // IE treats \0 as a string end in inputs (truncating the value),
                    // so it's a bad format delimiter, anyway
                    var separators = format.replace(this.validParts, '\0').split('\0'),
                        parts = format.match(this.validParts);
                    if (!separators || !separators.length || !parts || parts.length === 0) {
                        throw new Error("Invalid date format.");
                    }
                    return {separators: separators, parts: parts};
                },
                parseDate: function (date, format, language) {
                    if (!date)
                        return undefined;
                    if (date instanceof Date)
                        return date;
                    if (typeof format === 'string')
                        format = DPGlobal.parseFormat(format);
                    var part_re = /([\-+]\d+)([dmwy])/,
                        parts = date.match(/([\-+]\d+)([dmwy])/g),
                        part, dir, i;
                    if (/^[\-+]\d+[dmwy]([\s,]+[\-+]\d+[dmwy])*$/.test(date)) {
                        date = new Date();
                        for (i = 0; i < parts.length; i++) {
                            part = part_re.exec(parts[i]);
                            dir = parseInt(part[1]);
                            switch (part[2]) {
                                case 'd':
                                    date.setUTCDate(date.getUTCDate() + dir);
                                    break;
                                case 'm':
                                    date = Datepicker.prototype.moveMonth.call(Datepicker.prototype, date, dir);
                                    break;
                                case 'w':
                                    date.setUTCDate(date.getUTCDate() + dir * 7);
                                    break;
                                case 'y':
                                    date = Datepicker.prototype.moveYear.call(Datepicker.prototype, date, dir);
                                    break;
                            }
                        }
                        return UTCDate(date.getUTCFullYear(), date.getUTCMonth(), date.getUTCDate(), 0, 0, 0);
                    }
                    parts = date && date.match(this.nonpunctuation) || [];
                    date = new Date();
                    var parsed = {},
                        setters_order = ['yyyy', 'yy', 'M', 'MM', 'm', 'mm', 'd', 'dd'],
                        setters_map = {
                            yyyy: function (d, v) {
                                return d.setUTCFullYear(v);
                            },
                            yy: function (d, v) {
                                return d.setUTCFullYear(2000 + v);
                            },
                            m: function (d, v) {
                                if (isNaN(d))
                                    return d;
                                v -= 1;
                                while (v < 0) v += 12;
                                v %= 12;
                                d.setUTCMonth(v);
                                while (d.getUTCMonth() !== v)
                                    d.setUTCDate(d.getUTCDate() - 1);
                                return d;
                            },
                            d: function (d, v) {
                                return d.setUTCDate(v);
                            }
                        },
                        val, filtered;
                    setters_map['M'] = setters_map['MM'] = setters_map['mm'] = setters_map['m'];
                    setters_map['dd'] = setters_map['d'];
                    date = UTCDate(date.getFullYear(), date.getMonth(), date.getDate(), 0, 0, 0);
                    var fparts = format.parts.slice();
                    // Remove noop parts
                    if (parts.length !== fparts.length) {
                        fparts = $(fparts).filter(function (i, p) {
                            return $.inArray(p, setters_order) !== -1;
                        }).toArray();
                    }

                    // Process remainder
                    function match_part() {
                        var m = this.slice(0, parts[i].length),
                            p = parts[i].slice(0, m.length);
                        return m === p;
                    }

                    if (parts.length === fparts.length) {
                        var cnt;
                        for (i = 0, cnt = fparts.length; i < cnt; i++) {
                            val = parseInt(parts[i], 10);
                            part = fparts[i];
                            if (isNaN(val)) {
                                switch (part) {
                                    case 'MM':
                                        filtered = $(dates[language].months).filter(match_part);
                                        val = $.inArray(filtered[0], dates[language].months) + 1;
                                        break;
                                    case 'M':
                                        filtered = $(dates[language].monthsShort).filter(match_part);
                                        val = $.inArray(filtered[0], dates[language].monthsShort) + 1;
                                        break;
                                }
                            }
                            parsed[part] = val;
                        }
                        var _date, s;
                        for (i = 0; i < setters_order.length; i++) {
                            s = setters_order[i];
                            if (s in parsed && !isNaN(parsed[s])) {
                                _date = new Date(date);
                                setters_map[s](_date, parsed[s]);
                                if (!isNaN(_date))
                                    date = _date;
                            }
                        }
                    }
                    return date;
                },
                formatDate: function (date, format, language) {
                    if (!date)
                        return '';
                    if (typeof format === 'string')
                        format = DPGlobal.parseFormat(format);
                    var val = {
                        d: date.getUTCDate(),
                        D: dates[language].daysShort[date.getUTCDay()],
                        DD: dates[language].days[date.getUTCDay()],
                        m: date.getUTCMonth() + 1,
                        M: dates[language].monthsShort[date.getUTCMonth()],
                        MM: dates[language].months[date.getUTCMonth()],
                        yy: date.getUTCFullYear().toString().substring(2),
                        yyyy: date.getUTCFullYear()
                    };
                    val.dd = (val.d < 10 ? '0' : '') + val.d;
                    val.mm = (val.m < 10 ? '0' : '') + val.m;
                    date = [];
                    var seps = $.extend([], format.separators);
                    for (var i = 0, cnt = format.parts.length; i <= cnt; i++) {
                        if (seps.length)
                            date.push(seps.shift());
                        date.push(val[format.parts[i]]);
                    }
                    return date.join('');
                },
                headTemplate: '<thead>' +
                    '<tr>' +
                    '<th class="prev">&laquo;</th>' +
                    '<th colspan="5" class="datepicker-switch"></th>' +
                    '<th class="next">&raquo;</th>' +
                    '</tr>' +
                    '</thead>',
                contTemplate: '<tbody><tr><td colspan="7"></td></tr></tbody>',
                footTemplate: '<tfoot>' +
                    '<tr>' +
                    '<th colspan="7" class="today"></th>' +
                    '</tr>' +
                    '<tr>' +
                    '<th colspan="7" class="clear"></th>' +
                    '</tr>' +
                    '</tfoot>'
            };
            DPGlobal.template = '<div class="datepicker">' +
                '<div class="datepicker-days">' +
                '<table class=" table-condensed">' +
                DPGlobal.headTemplate +
                '<tbody></tbody>' +
                DPGlobal.footTemplate +
                '</table>' +
                '</div>' +
                '<div class="datepicker-months">' +
                '<table class="table-condensed">' +
                DPGlobal.headTemplate +
                DPGlobal.contTemplate +
                DPGlobal.footTemplate +
                '</table>' +
                '</div>' +
                '<div class="datepicker-years">' +
                '<table class="table-condensed">' +
                DPGlobal.headTemplate +
                DPGlobal.contTemplate +
                DPGlobal.footTemplate +
                '</table>' +
                '</div>' +
                '</div>';

            $.fn.datepicker.DPGlobal = DPGlobal;


            /* DATEPICKER NO CONFLICT
            * =================== */

            $.fn.datepicker.noConflict = function () {
                $.fn.datepicker = old;
                return this;
            };


            /* DATEPICKER DATA-API
            * ================== */

            $(document).on(
                'focus.datepicker.data-api click.datepicker.data-api',
                '[data-provide="datepicker"]',
                function (e) {
                    var $this = $(this);
                    if ($this.data('datepicker'))
                        return;
                    e.preventDefault();
                    // component click requires us to explicitly show it
                    $this.datepicker('show');
                }
            );
            $(function () {
                $('[data-provide="datepicker-inline"]').datepicker();
            });

        }(window.jQuery));

        /*
        * Date Format 1.2.3
        * (c) 2007-2009 Steven Levithan <stevenlevithan.com>
        * MIT license
        *
        * Includes enhancements by Scott Trenda <scott.trenda.net>
        * and Kris Kowal <cixar.com/~kris.kowal/>
        *
        * Accepts a date, a mask, or a date and a mask.
        * Returns a formatted version of the given date.
        * The date defaults to the current date/time.
        * The mask defaults to dateFormat.masks.default.
        */

        var dateFormat = function () {
            var token = /d{1,4}|m{1,4}|yy(?:yy)?|([HhMsTt])\1?|[LloSZ]|"[^"]*"|'[^']*'/g,
                timezone = /\b(?:[PMCEA][SDP]T|(?:Pacific|Mountain|Central|Eastern|Atlantic) (?:Standard|Daylight|Prevailing) Time|(?:GMT|UTC)(?:[-+]\d{4})?)\b/g,
                timezoneClip = /[^-+\dA-Z]/g,
                pad = function (val, len) {
                    val = String(val);
                    len = len || 2;
                    while (val.length < len) val = "0" + val;
                    return val;
                };

// Regexes and supporting functions are cached through closure
            return function (date, mask, utc) {
                var dF = dateFormat;

                // You can't provide utc if you skip other args (use the "UTC:" mask prefix)
                if (arguments.length == 1 && Object.prototype.toString.call(date) == "[object String]" && !/\d/.test(date)) {
                    mask = date;
                    date = undefined;
                }

                // Passing date through Date applies Date.parse, if necessary
                date = date ? new Date(date) : new Date;
                if (isNaN(date)) throw SyntaxError("invalid date");

                mask = String(dF.masks[mask] || mask || dF.masks["default"]);

                // Allow setting the utc argument via the mask
                if (mask.slice(0, 4) == "UTC:") {
                    mask = mask.slice(4);
                    utc = true;
                }

                var _ = utc ? "getUTC" : "get",
                    d = date[_ + "Date"](),
                    D = date[_ + "Day"](),
                    m = date[_ + "Month"](),
                    y = date[_ + "FullYear"](),
                    H = date[_ + "Hours"](),
                    M = date[_ + "Minutes"](),
                    s = date[_ + "Seconds"](),
                    L = date[_ + "Milliseconds"](),
                    o = utc ? 0 : date.getTimezoneOffset(),
                    flags = {
                        d: d,
                        dd: pad(d),
                        ddd: dF.i18n.dayNames[D],
                        dddd: dF.i18n.dayNames[D + 7],
                        m: m + 1,
                        mm: pad(m + 1),
                        mmm: dF.i18n.monthNames[m],
                        mmmm: dF.i18n.monthNames[m + 12],
                        yy: String(y).slice(2),
                        yyyy: y,
                        h: H % 12 || 12,
                        hh: pad(H % 12 || 12),
                        H: H,
                        HH: pad(H),
                        M: M,
                        MM: pad(M),
                        s: s,
                        ss: pad(s),
                        l: pad(L, 3),
                        L: pad(L > 99 ? Math.round(L / 10) : L),
                        t: H < 12 ? "a" : "p",
                        tt: H < 12 ? "am" : "pm",
                        T: H < 12 ? "A" : "P",
                        TT: H < 12 ? "AM" : "PM",
                        Z: utc ? "UTC" : (String(date).match(timezone) || [""]).pop().replace(timezoneClip, ""),
                        o: (o > 0 ? "-" : "+") + pad(Math.floor(Math.abs(o) / 60) * 100 + Math.abs(o) % 60, 4),
                        S: ["th", "st", "nd", "rd"][d % 10 > 3 ? 0 : (d % 100 - d % 10 != 10) * d % 10]
                    };

                return mask.replace(token, function ($0) {
                    return $0 in flags ? flags[$0] : $0.slice(1, $0.length - 1);
                });
            };
        }();

        // Some common format strings
        dateFormat.masks = {
            "default": "ddd mmm dd yyyy HH:MM:ss",
            shortDate: "m/d/yy",
            mediumDate: "mmm d, yyyy",
            longDate: "mmmm d, yyyy",
            fullDate: "dddd, mmmm d, yyyy",
            shortTime: "h:MM TT",
            mediumTime: "h:MM:ss TT",
            longTime: "h:MM:ss TT Z",
            isoDate: "yyyy-mm-dd",
            isoTime: "HH:MM:ss",
            isoDateTime: "yyyy-mm-dd'T'HH:MM:ss",
            isoUtcDateTime: "UTC:yyyy-mm-dd'T'HH:MM:ss'Z'"
        };

        // Internationalization strings
        dateFormat.i18n = {
            dayNames: [
                "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat",
                "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"
            ],
            monthNames: [
                "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec",
                "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
            ]
        };

        // For convenience...
        Date.prototype.format = function (mask, utc) {
            return dateFormat(this, mask, utc);
        };

        $.fn.notes = function (name) {
            return this.each(function () {
                var self = $(this);
                var add = self.find(name + "__add");
                var time = self.find(name + "__time");
                var field = self.find(name + "__field");
                var list = self.find(name + "__list");

                var prevHtml = '';

                add.on('click', function () {
                    if (field.val() != '' && field.val() != prevHtml) {
                        var html = "<li><span>" + (time.val() ? time.val() : "00:00") + "</span>" + field.val() + "</li>";
                        prevHtml = field.val();

                        list.append(html);

                        setInterval(function () {
                            prevHtml = '';
                        }, 5000)
                    }

                    return false;
                });
            });
        }

        $(function () {
            $(".b-notes").notes(".b-notes");

            $("#calendar").datepicker({
                startDate: new Date(),
                todayHighlight: true,
                weekStart: 1
            }).on({
                'changeDate': function (e) {
                    console.log("Change Date", e);
                    console.log("Date", e.date);
                    console.log("Date", e.format('yyyy-mm-dd'));
                    if (typeof (e.date) == "undefined") return false;

                    var milliseconds = Date.parse(e.date);

                    setCelendarDay(milliseconds);
                }

            });

            var today = new Date();
            var milliseconds = Date.parse(today);

            setCelendarDay(milliseconds);

            async function setCelendarDay(milliseconds) {
                var date = new Date(milliseconds).format("dd/mm/yyyy");
                var formatTitle = new Date(milliseconds).format("dddd, <b>d mmmm</b>");

                var dateValue = new Date(milliseconds).format("yyyy-mm-dd");
                const dateInput = document.querySelector('[name="date"]');
                dateInput.value = dateValue;
                var list = $(".b-notes__list");
                var title = $(".b-app__title");

                const timeSlots = await getTimeSlots(dateValue);

                console.log("Got time slots:", timeSlots)
                if (timeSlots === undefined) {
                    return;
                }


                console.log('Time slots:', timeSlots);

                $.getJSON("https://dl.dropboxusercontent.com/u/27474693/db.json", function (data) {

                    $.each(data.days, function () {
                        var obj = this;

                        if (date == obj.day) {
                            var items = obj.data;

                            list.html('');

                            $.each(items, function () {
                                var html = "<li><span>" + this.time + "</span>" + this.title + "</li>";
                                list.append(html);
                            });

                            return false;
                        } else {
                            list.html('');
                        }

                        title.html(formatTitle);
                    })

                });
            }
        });
    </script>
    <script>
        let memo = {};

        function getTimeSlots(date) {
            // Check if the result for the given date is in the memo object
            if (memo[date]) {
                return Promise.resolve(memo[date]);
            }

            // Define the URL of the API endpoint
            const url = `<?=$pageUrl?>/available-date.php?date=${date}`;

            // Send a GET request to the server
            fetch(url)
                .then(response => {
                    // Check if the request was successful
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    // Parse the response as JSON
                    return response.json();
                })
                .then(data => {
                    memo[date] = data;

                    // Handle the parsed JSON data
                    if (data.timeSlots && data.timeSlots.length > 0) {
                        return handleTimeSlots(data.timeSlots);
                    } else {
                        handleNoSlotsAvailable();
                    }
                })
                .catch(error => {
                    // Handle any errors that occurred during the fetch operation
                    console.error('An error occurred:', error);
                });
        }

        function handleTimeSlots(timeSlots) {
            const availableTimeSlots = timeSlots.filter(slot => slot.available);

            if (availableTimeSlots.length === 0) {
                handleNoSlotsAvailable();
            } else {
                const slotParent = document.querySelector('.available-time-slots');
                slotParent.innerHTML = '';

                availableTimeSlots.forEach((slot, index) => {
                    const label = document.createElement('label');
                    label.classList.add('p-div-time');

                    const input = document.createElement('input');
                    input.type = 'radio';
                    input.value = slot.time;
                    input.name = 'time';
                    label.appendChild(input);

                    if (index === 0) {
                        input.checked = true;
                    }

                    const text = document.createTextNode(slot.formattedTime);
                    label.appendChild(text);
                    slotParent.appendChild(label);
                });
            }

        }

        function handleNoSlotsAvailable() {
            // Handle the case when there are no available time slots
            // This could be displaying a message in the UI, logging a message to the console, etc.
            console.log('No available time slots for this date.');
        }
    </script>
    </body>
    </html>
<?php

unset($_SESSION['form_errors']);
unset($_SESSION['form_success']);

?>