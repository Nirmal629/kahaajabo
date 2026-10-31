window.onscroll = function() {myFunction()};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

// function myFunction() {
//   if (window.pageYOffset > sticky) {
//     header.classList.add("sticky");
//   } else {
//     header.classList.remove("sticky");
//   }
// }

//body-scroll


window.onscroll = function () {
    myFunction();
};

var header = document.getElementById("myHeader");

if (header) {

    var sticky = header.offsetTop;

    function myFunction() {

        if (window.pageYOffset > sticky) {

            header.classList.add("sticky");

        } else {

            header.classList.remove("sticky");

        }

    }

}

const myModal = document.getElementById('registerModal');

myModal.addEventListener('shown.bs.modal', function () {
    document.body.style.overflow = 'hidden';
});

myModal.addEventListener('hidden.bs.modal', function () {
    document.body.style.overflow = '';
});


//banner swiper
var swiper = new Swiper(".mySwiper", {
    spaceBetween: 30,
    centeredSlides: true,
    loop:true,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },

    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});

//client Swiper
var swiper = new Swiper(".clientSwiper", {
    slidesPerView: 1,
    spaceBetween: 10,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    autoplay: {
        delay: 3000,
    },
    breakpoints: {
        640: {
            slidesPerView: 1,
            spaceBetween: 15,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        1024: {
            slidesPerView: 3,
            spaceBetween: 30,
        },
    },
});

//destination

var swiper = new Swiper(".popularSwiper", {
    slidesPerView: 1,
    spaceBetween: 10,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    autoplay: {
        delay: 3000,
    },
    breakpoints: {
        640: {
            slidesPerView: 2,
            spaceBetween: 15,
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 20,
        },
        1024: {
            slidesPerView: 4,
            spaceBetween: 30,
        },
    },
});



//data-table
new DataTable('#example');