@extends('Frontend.Includes.main')
@section('main_content')


<!-----banner------>
<section class="banner">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach ($get_banner as $get_bannerVal)
                <div class="swiper-slide">
                    <div class="image-box">
                        <figure class="image_wrap">
                            <img src="{{\App\Helpers\LocationHelper::imageUrl('uploads/home-dynamic/'.$get_bannerVal->banner_image)}}" class="img-fluid h-100 w-100" alt="banner" />
                        </figure>
                        <div class="banner-content">
                            <h1>{{ $get_bannerVal->banner_title }}</h1>
                            <h4>{{ $get_bannerVal->banner_sub_title }}</h4>
                            <p>{{ $get_bannerVal->banner_description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
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
            <h2>{{ $get_home_details->sectionSecond_title }}</h2>
            <p>{{ $get_home_details->sectionSection_description }}</p>
        </div>
        <div class="row">
            @foreach ($vehicle_rates as $vehicle_ratesVal)
                <div class="col-md-3 col-12">
                    <div class="box text-center">
                        <img src="{{\App\Helpers\LocationHelper::imageUrl('uploads/vehicle-rate/'.$vehicle_ratesVal->vehicle_image)}}" alt="" class="img-fluid mb-3" />
                        <h5 class="mb-2">
                            {{ $vehicle_ratesVal->vehicleType?->vehicle_type }}
                                / {{ $vehicle_ratesVal->vehicle_name }}
                        </h5>
                        <h6 class="mb-3">
                            ₹{{ number_format($vehicle_ratesVal->price_per_km, 2) }} / KM
                        </h6>
                        <button class="Primary-btn">Book Now</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!---popular-destination----->

<section class="popular-destination">
    <div class="cust_container">
        <div class="mb-5">
            <h3 class="sec-heading text-center mb-4">{{ $get_home_details->third_section_title }}</h3>

        </div>
        <div class="swiper popularSwiper">
            <div class="swiper-wrapper">
                @foreach ($get_popDestination as $get_popDestinationVal)
                    <div class="swiper-slide">
                        <img src="{{\App\Helpers\LocationHelper::imageUrl('uploads/home-dynamic/'.$get_popDestinationVal->image)}}" alt="" class="img-fluid w-100" />
                        <h6 class="mb-3">{{ $get_popDestinationVal->destination_name }}</h6>
                        <button class="Primary-btn m-auto d-table">Book Now</button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>


<!---how_it_works----->

<section class="How_it_works">
    <div class="cust_container">
        <div class="mb-5">
            <h3 class="sec-heading text-center">{{ $get_home_details->fourth_section_heading }}</h3>
        </div>
        <div class="row pt-5">
            <div class="col-md-3 col-12">
                <div class="box">
                    <div class="icon"><img src="{{\App\Helpers\LocationHelper::imageUrl('uploads/home-dynamic/'.$get_home_details->fourth_section_image_1)}}" alt="" class="img-fluis" /></div>
                    <h5>{{ $get_home_details->fourth_section_title_1 }}</h5>
                    <span class="h_line"></span>
                    <p>{{ $get_home_details->fourth_section_description_1 }}</p>
                </div>
            </div>
            <div class="col-md-3 col-12">
                <div class="box">
                    <div class="icon"><img src="{{\App\Helpers\LocationHelper::imageUrl('uploads/home-dynamic/'.$get_home_details->fourth_section_image_2)}}" alt="" class="img-fluis" /></div>
                    <h5>{{ $get_home_details->fourth_section_title_2 }}</h5>
                    <span class="h_line"></span>
                    <p>{{ $get_home_details->fourth_section_description_2 }}</p>
                </div>
            </div>
            <div class="col-md-3 col-12">
                <div class="box">
                    <div class="icon"><img src="{{\App\Helpers\LocationHelper::imageUrl('uploads/home-dynamic/'.$get_home_details->fourth_section_image_3)}}" alt="" class="img-fluis" /></div>
                    <h5>{{ $get_home_details->fourth_section_title_3 }}</h5>
                    <span class="h_line"></span>
                    <p>{{ $get_home_details->fourth_section_description_3 }}</p>
                </div>
            </div>
            <div class="col-md-3 col-12">
                <div class="box">
                    <div class="icon"><img src="{{\App\Helpers\LocationHelper::imageUrl('uploads/home-dynamic/'.$get_home_details->fourth_section_image_4)}}" alt="" class="img-fluis" /></div>
                    <h5>{{ $get_home_details->fourth_section_title_4 }}</h5>
                    <span class="h_line"></span>
                    <p>{{ $get_home_details->fourth_section_description_4 }}</p>
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
                            <img src="{{asset('public/Frontend/Assets/images/image1.jpg')}}" class=" client-pic rounded-circle img-fluid">
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
                            <img src="{{asset('public/Frontend/Assets/images/image1.jpg')}}" class=" client-pic rounded-circle img-fluid">
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
                            <img src="{{asset('public/Frontend/Assets/images/image1.jpg')}}" class=" client-pic rounded-circle img-fluid">
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
                            <img src="{{asset('public/Frontend/Assets/images/image1.jpg')}}" class=" client-pic rounded-circle img-fluid">
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
                        <i class="fa fa-rocket" aria-hidden="true"></i>{{ $contact_details->address }}
                    </li>
                    <li>
                        <i class="fa fa-phone" aria-hidden="true"></i>{{ $contact_details->phone_number }}
                    </li>
                    <li>
                        <i class="fa fa-envelope" aria-hidden="true"></i>{{ $contact_details->email_id }}
                    </li>
                    <li>
                        <i class="fa-solid fa-clock"></i>{{ $contact_details->open_time }}
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <form method="POST" action="{{ route('contact.enquiry.store') }}">
                    @csrf
                    <div class="row form-group">
                        <div class="col">
                            <input type="text" class="form-control" name="contact_first_name" value="{{ old('contact_first_name') }}" placeholder="First Name" />
                            @error('contact_first_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                         <div class="col">
                            <input type="text" class="form-control" name="contact_last_name" value="{{ old('contact_last_name') }}" placeholder="Last Name" />
                            @error('contact_last_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col">
                            <input type="email" class="form-control" name="contact_email" value="{{ old('contact_email') }}" placeholder="Email" />
                            @error('contact_email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" name="contact_phoneNo" value="{{ old('contact_phoneNo') }}" placeholder="Phone No" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
                            @error('contact_phoneNo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="contact_subject" value="{{ old('contact_subject') }}" id="inputAddress2" placeholder="subject" />
                        @error('contact_subject')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col">
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="contact_message" placeholder="Your Message"
                            rows="6" cols="6">{{ old('contact_message') }}</textarea>
                        @error('contact_message')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror    
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