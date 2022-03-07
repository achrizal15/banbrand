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
            merge: true,
            nav: true,
            dots: false,
            navText: ["<div class='nav-button owl-prev text-center'>‹</div>", "<div class='nav-button owl-next'>›</div>"],
            responsive: {
                0: {
                    margin: 100,
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
const stepWizzard = function () {
    // SmartWizard initialize
    $('#smartwizard').smartWizard({
        theme: 'arrows', enableURLhash: false, loader: "show",
        anchorSettings: {
            anchorClickable: false, // Enable/Disable anchor navigation
            enableAllAnchors: false, // Activates all anchors clickable all times
            markDoneStep: true, // Add done state on navigation
            markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
            removeDoneStepOnNavigateBack: true, // While navigate back done step after active step will be cleared
            enableAnchorOnDoneStep: false // Enable/Disable the done steps navigation
        },
    });
    // Initialize the leaveStep event
    let data = [];
    $("#smartwizard").on("leaveStep", function (e, anchorObject, currentStepIndex, nextStepIndex, stepDirection) {
        let form = $("form#form-" + nextStepIndex)
        if (stepDirection == "forward" && form.length != 0) {
            if ($(form).parsley().validate() == false) {
                return false;
            }
        }
        if (nextStepIndex == 3) {
            console.table(data)
            return false;
        }
        //get all value from form
        form.find("input,select,textarea").each(function (e) {
            //if key data duplicate update
            if (data[$(this).attr("name")]) {
                data[$(this).attr("name")] = $(this).val()
            } else {
                data[$(this).attr("name")] = $(this).val()
            }
        })
    });
}
const needValidation = () => {
    const form = $('.needs-validation')
    if (form.length > 0) {
        form.parsley()
    }
}
// Rating Initialization
$(document).ready(function () {

    needValidation()
    stepWizzard()
    carouselHandler()
    rateStars()
});
