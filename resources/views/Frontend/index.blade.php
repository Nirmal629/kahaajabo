@extends('Frontend.Includes.main')
@section('main_content')


<!-----banner------>
<section class="banner">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="image-box">
                    <figure class="image_wrap">
                        <img src="{{asset('Frontend/Assets/images/banner.png')}}" class="img-fluid h-100" alt="banner" />
                    </figure>
                    <div class="banner-content">
                        <h1>Siddharth Nagar & Lucknow's Most Reliable Cab Network</h1>
                        <h4>Fixed fares. Background-verified drivers. No surprise cancellations</h4>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since 1966, when designers at Letraset and
                            James Mosley, the librarian at St Bride Printing Library, took a 1914 Cicero translation and
                            scrambled it to make dummy text for Letraset's Body Type sheets</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="image-box">
                    <figure class="image_wrap">
                        <img src="{{asset('Frontend/Assets/images/banner.png')}}" class="img-fluid h-100" alt="banner" />
                    </figure>
                    <div class="banner-content">
                        <h1>Siddharth Nagar & Lucknow's Most Reliable Cab Network</h1>
                        <h4>Fixed fares. Background-verified drivers. No surprise cancellations</h4>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since 1966, when designers at Letraset and
                            James Mosley, the librarian at St Bride Printing Library, took a 1914 Cicero translation and
                            scrambled it to make dummy text for Letraset's Body Type sheets.</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="image-box">
                    <figure class="image_wrap">
                        <img src="{{asset('Frontend/Assets/images/banner.png')}}" class="img-fluid h-100" alt="banner" />
                    </figure>
                    <div class="banner-content">
                        <h1>Siddharth Nagar & Lucknow's Most Reliable Cab Network</h1>
                        <h4>Fixed fares. Background-verified drivers. No surprise cancellations</h4>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since 1966, when designers at Letraset and
                            James Mosley, the librarian at St Bride Printing Library, took a 1914 Cicero translation and
                            scrambled it to make dummy text for Letraset's Body Type sheets</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

</section>

<section class="booking-form">
    <div class="cust_container">
        <div class="card_wrap">

            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                        aria-controls="pills-home" aria-selected="true">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
                                value="option1" checked>
                            <label class="form-check-label" for="exampleRadios1">
                             One way
                            </label>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                        aria-controls="pills-profile" aria-selected="false">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2"
                                value="option2" checked>
                            <label class="form-check-label" for="exampleRadios2">
                               Round Trip
                            </label>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab"
                        aria-controls="pills-contact" aria-selected="false">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3"
                                value="option3">
                            <label class="form-check-label" for="exampleRadios3">
                                Road Trip
                            </label>
                        </div>
                    </a>
                </li>
                  <li class="nav-item">
                    <a class="nav-link" id="pills-local-tab" data-toggle="pill" href="#pills-local" role="tab"
                        aria-controls="pills-local" aria-selected="false">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios4"
                                value="option4">
                            <label class="form-check-label" for="exampleRadios4">
                                Local transfer
                            </label>
                        </div>
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="row">
                        <div class="col-md-3 col-12">
                            <div class="box">
                                <h6>Pick Up Location</h6>
                                <input type="text" placeholder="City or Airport">
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="box">
                                <h6>Drop Location</h6>
                                <input type="text" placeholder="City or Airport">
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="box">
                                <h6>Pickup Date</h6>
                                <input type="date" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="box">
                                <h6>Mobile No</h6>
                                <input type="text" placeholder="9100000766">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="row">
                        <div class="col-md-3 col-12">
                            <div class="box">
                                <h6>Pick Up Location</h6>
                                <input type="text" placeholder="City or Airport">
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="box">
                                <h6>Drop Location</h6>
                                <input type="text" placeholder="City or Airport">
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="box">
                                <h6>Pickup Date</h6>
                                <input type="date" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="box">
                                <h6>Mobile No</h6>
                                <input type="text" placeholder="9100000766">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <div class="row">
                        <div class="col-md-3 col-12">
                            <div class="box">
                                <h6>Pick Up Location</h6>
                                <input type="text" placeholder="City or Airport">
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="box">
                                <h6>Drop Location</h6>
                                <input type="text" placeholder="City or Airport">
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="box">
                                <h6>Pickup Date</h6>
                                <input type="date" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="box">
                                <h6>Mobile No</h6>
                                <input type="text" placeholder="9100000766">
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="tab-pane fade" id="pills-local" role="tabpanel" aria-labelledby="pills-local-tab">
                    <div class="row">
                        <div class="col-md-3 col-12">
                            <div class="box">
                                <h6>Pick Up Location</h6>
                                <input type="text" placeholder="City or Airport">
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="box">
                                <h6>Drop Location</h6>
                                <input type="text" placeholder="City or Airport">
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="box">
                                <h6>Pickup Date</h6>
                                <input type="date" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="box">
                                <h6>Mobile No</h6>
                                <input type="text" placeholder="9100000766">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <button class="Primary-btn request_btn"><i class="fa-solid fa-phone mr-2"></i>Request Ride Confirmation</button>
    </div>
</section>


<!-----car-hire----->
<section class="car-hire">
    <div class="cust_container">
        <div class="section-top">
            <h2>Our Taxi For Hire</h2>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since 1966,
                when designers at Letraset and James Mosley, the librarian at St Bride Printing Library,
                took a 1914 Cicero translation and scrambled it to make dummy text for Letraset's
                Body Type sheets</p>
        </div>
        <div class="row">
            <div class="col-md-3 col-12">
                <div class="box text-center">
                    <img src="{{asset('Frontend/Assets/images/car.png')}}" alt="" class="img-fluid mb-3" />
                    <h5 class="mb-2">Dzire or Similar</h5>
                    <h6 class="mb-3">$12.00 / KM</h6>
                    <button class="Primary-btn">Book Now</button>
                </div>
            </div>
            <div class="col-md-3 col-12">
                <div class="box text-center">
                    <img src="{{asset('Frontend/Assets/images/car.png')}}" alt="" class="img-fluid mb-3" />
                    <h5 class="mb-2">Dzire or Similar</h5>
                    <h6 class="mb-3">$12.00 / KM</h6>
                    <button class="Primary-btn">Book Now</button>
                </div>
            </div>
            <div class="col-md-3 col-12">
                <div class="box text-center">
                    <img src="{{asset('Frontend/Assets/images/car.png')}}" alt="" class="img-fluid mb-3" />
                    <h5 class="mb-2">Dzire or Similar</h5>
                    <h6 class="mb-3">$12.00 / KM</h6>
                    <button class="Primary-btn">Book Now</button>
                </div>
            </div>
            <div class="col-md-3 col-12">
                <div class="box text-center">
                    <img src="{{asset('Frontend/Assets/images/car.png')}}" alt="" class="img-fluid mb-3" />
                    <h5 class="mb-2">Dzire or Similar</h5>
                    <h6 class="mb-3">$12.00 / KM</h6>
                    <button class="Primary-btn">Book Now</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!---popular-destination----->

<section class="popular-destination">
    <div class="cust_container">
        <div class="mb-5">
            <h3 class="sec-heading text-center mb-4">Popular Destination</h3>

        </div>
        <div class="swiper popularSwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="{{asset('Frontend/Assets/images/abe.png')}}" alt="" class="img-fluid w-100" />
                    <h6 class="mb-3">Mathura Taxi Service</h6>
                    <button class="Primary-btn m-auto d-table">Book Now</button>
                </div>
                <div class="swiper-slide">
                    <img src="{{asset('Frontend/Assets/images/abc.png')}}" alt="" class="img-fluid w-100" />
                    <h6 class="mb-3">Mathura Taxi Service</h6>
                    <button class="Primary-btn m-auto d-table">Book Now</button>
                </div>
                <div class="swiper-slide">
                    <img src="{{asset('Frontend/Assets/images/abd.png')}}" alt="" class="img-fluid w-100" />
                    <h6 class="mb-3">Mathura Taxi Service</h6>
                    <button class="Primary-btn m-auto d-table">Book Now</button>
                </div>
                <div class="swiper-slide">
                    <img src="{{asset('Frontend/Assets/images/abb.png')}}" alt="" class="img-fluid w-100" />
                    <h6 class="mb-3">Mathura Taxi Service</h6>
                    <button class="Primary-btn m-auto d-table">Book Now</button>
                </div>
                <div class="swiper-slide">
                    <img src="{{asset('Frontend/Assets/images/abe.png')}}" alt="" class="img-fluid w-100" />
                    <h6 class="mb-3">Mathura Taxi Service</h6>
                    <button class="Primary-btn m-auto d-table">Book Now</button>
                </div>
                <div class="swiper-slide">
                    <img src="{{asset('Frontend/Assets/images/abe.png')}}" alt="" class="img-fluid w-100" />
                    <h6 class="mb-3">Mathura Taxi Service</h6>
                    <button class="Primary-btn m-auto d-table">Book Now</button>
                </div>
            </div>
            <!-- <div class="swiper-pagination">
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div> -->
        </div>
    </div>
</section>


<!---how_it_works----->

<section class="How_it_works">
    <div class="cust_container">
        <div class="mb-5">
            <h3 class="sec-heading text-center">How It Works?</h3>
        </div>
        <div class="row pt-5">
            <div class="col-md-3 col-12">
                <div class="box">
                    <div class="icon"><img src="{{asset('Frontend/Assets/images/bus.png')}}" alt="" class="img-fluis" /></div>
                    <h5>Log Your Trip</h5>
                    <span class="h_line"></span>
                    <p> Fill out the quick form above.</p>
                </div>
            </div>
            <div class="col-md-3 col-12">
                <div class="box">
                    <div class="icon"><img src="{{asset('Frontend/Assets/images/phone-call.png')}}" alt="" class="img-fluis" /></div>
                    <h5>Get a Call</h5>
                    <span class="h_line"></span>
                    <p> A local area manager calls you within minutes to confirm vehicle availability and final pricing.
                    </p>
                </div>
            </div>
            <div class="col-md-3 col-12">
                <div class="box">
                    <div class="icon"><img src="{{asset('Frontend/Assets/images/security-services.png')}}" alt="" class="img-fluis" /></div>
                    <h5>Secure with UPI</h5>
                    <span class="h_line"></span>
                    <p>Receive a WhatsApp link to pay your booking deposit 1 hour before pickup.</p>
                </div>
            </div>
            <div class="col-md-3 col-12">
                <div class="box">
                    <div class="icon"><img src="{{asset('Frontend/Assets/images/sofa-bed.png')}}" alt="" class="img-fluis" /></div>
                    <h5>Ride in Comfort</h5>
                    <span class="h_line"></span>
                    <p> Your driver arrives exactly on time. Track your trip history directly in your user portal.
                    </p>
                </div>
            </div>
        </div>

    </div>
</section>





<!----testimonial---->

<section class="client">
    <div class="container">
        <h2 class="text-white text-center">CUSTOMER REVIEWS</h2>
        <div class='swiper clientSwiper'>
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class='wrap'>
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <p class="font-weight-bold py-3">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        <div class="circle-img">
                            <img src="{{asset('Frontend/Assets/images/image1.jpg')}}" class=" client-pic rounded-circle img-fluid">
                            <h6 class=" font-weight-bold">Tabish Khair</h6>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class='wrap'>
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <p class="font-weight-bold py-3">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        <div class="circle-img">
                            <img src="{{asset('Frontend/Assets/images/image1.jpg')}}" class=" client-pic rounded-circle img-fluid">
                            <h6 class=" font-weight-bold">Tabish Khair</h6>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class='wrap'>
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <p class="font-weight-bold py-3">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        <div class="circle-img">
                            <img src="{{asset('Frontend/Assets/images/image1.jpg')}}" class=" client-pic rounded-circle img-fluid">
                            <h6 class=" font-weight-bold">Tabish Khair</h6>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class='wrap'>
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <p class="font-weight-bold py-3">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        <div class="circle-img">
                            <img src="{{asset('Frontend/Assets/images/image1.jpg')}}" class=" client-pic rounded-circle img-fluid">
                            <h6 class=" font-weight-bold">Tabish Khair</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<!-----contact us----->
<section class="contact">
    <div class="cust_container">
        <div class="row">
            <div class="col-md-6">
                <h3>CONTACT US</h3>
                <ul class="menu">
                    <li>
                        <i class="fa fa-rocket" aria-hidden="true"></i>4096 N Highland St, Arlington VA 32101, USA
                    </li>
                    <li>
                        <i class="fa fa-phone" aria-hidden="true"></i>9876543xxx
                    </li>
                    <li>
                        <i class="fa fa-envelope" aria-hidden="true"></i>demo@company.com
                    </li>
                    <li>
                        <i class="fa-solid fa-clock"></i>Mon - Fri: 08.00
                        - 16.00
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <form>
                    <div class="row form-group">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Name" />
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Email" />
                        </div>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="inputAddress2" placeholder="subject" />
                    </div>
                    <div class="col">
                        <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Your Message"
                            rows="6" cols="6"></textarea>
                    </div>
                    <div class="col">
                        <button type="submit" class="Primary-btn">send message</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</section>



@endsection