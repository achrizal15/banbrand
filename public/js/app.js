const rateStars = function () {
    $("div#rateYo").each(function (e) {
        let readOnly = $(this).data("readonly")
        let value = $(this).data("value") ? $(this).data("value") : 5
        // console.log(readOnly);
        $(this).rateYo({
            starWidth: "15px",
            readOnly: readOnly,
            rating: value
        })
    })
}
//funtion date to time ago

let carouselHandler = function () {
    $('.owl-carousel').each(function (e) {
        $(this).owlCarousel({
            stagePadding: 50,
            loop: false,
            margin: 10,
            merge:true,
            nav: true,
            dots: false,
            navText: ["<div class='nav-button owl-prev text-center'>‹</div>", "<div class='nav-button owl-next'>›</div>"],
            responsive: {
               0: {
                    margin:100,
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                },
                1200: {
                    items: 4
                }
            }
        });
    })
   
}

// Rating Initialization
$(document).ready(function () {
    carouselHandler()
    rateStars()
});
