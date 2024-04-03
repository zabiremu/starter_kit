(function ($) {
    "use strict";
    $(document).ready(function () {
        // statistic counter
        $(".shownum--box").each(function () {
            var $this = $(this);
            $this.on("inview", function (event, visible) {
                if (visible) {
                    $this.find(".counter").each(function () {
                        var $counter = $(this);
                        $({ Counter: 0 }).animate(
                            { Counter: $counter.text() },
                            {
                                duration: 1500,
                                easing: "swing",
                                step: function () {
                                    $counter.text(Math.ceil(this.Counter));
                                },
                            }
                        );
                    });
                    $this.unbind("inview");
                }
            });
        });

        // testimonial slider
        $(".testimonial--content--wrapper .owl-carousel").owlCarousel({
            items: 1,
            loop: true,
            margin: 40,
            autoplay: false,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            dots: true,
            //   responsive: {
            //     0: {
            //       items: 1,
            //     },
            //     600: {
            //       items: 3,
            //     },
            //     1000: {
            //       items: 5,
            //     },
            //   },
        });

        // popup auth functionality
        function popUpAuth() {
            let popUpWrapper = document.querySelector(
                ".popup--auth--area--wrapper"
            );
            let popUpArea = document.querySelector(
                ".popup--auth--area--content"
            );

            if (popUpWrapper) {
                let steps = document.querySelectorAll(".auth--content");
                let stepsArray = Array.from(steps);
                let stepIndex = 0;
                let openPopUp = document.querySelectorAll(".open--popup");
                let closePopUp = document.querySelector(
                    ".popup--close--button"
                );
                let goBackBtn = document.querySelector(".go--back--btn");

                // opening popup
                openPopUp.forEach((item) => {
                    item.addEventListener("click", (event) => {
                        event.preventDefault();
                        popUpWrapper.classList.add("show--area");
                        document.body.style.overflowY = "hidden";
                        event.stopPropagation();
                    });
                });

                // closing popup
                closePopUp.addEventListener("click", (event) => {
                    event.preventDefault();
                    popUpWrapper.classList.remove("show--area");
                    document.body.style.overflowY = "auto";
                });

                // close popup on outside click
                document.addEventListener("click", (event) => {
                    if (
                        !popUpArea.contains(event.target) &&
                        popUpWrapper.contains(event.target)
                    ) {
                        popUpWrapper.classList.remove("show--area");
                        document.body.style.overflowY = "auto";
                    }
                });

                // multistep form functionality
                stepsArray.forEach((step) => {
                    let nextStepBtn = step.querySelector(
                        ".auth--next--step--btn"
                    );
                    let inputFields = step.querySelectorAll("input[required]");

                    // checking the required field
                    inputFields.forEach((item) => {
                        item.addEventListener("input", () => {
                            if (!item.value.length) {
                                nextStepBtn.classList.add("disabled");
                            } else {
                                nextStepBtn.classList.remove("disabled");
                            }
                        });
                    });


                    let phoneNumber = step.querySelectorAll(
                        "input[name='phone_number']"
                    );
                    phoneNumber.forEach((item) => {
                        item.addEventListener("input", () => {
                            if (item.value.length <= 8) {
                                nextStepBtn.classList.add("disabled");
                            } else {
                                nextStepBtn.classList.remove("disabled");
                            }
                        });
                    });

                    // changing the steps function
                    function changeStep() {
                        // hiding the current step
                        step.classList.add("d-none");

                        // showing next step
                        stepsArray[stepIndex].classList.remove("d-none");
                    }

                    nextStepBtn.addEventListener("click", (event) => {
                        event.preventDefault();
                        // final submit button logic
                        if (event.target.classList.contains("final--submit")) {
                            return window.location.reload();
                        }

                        // increasing the steps index
                        stepIndex++;

                        // else change the steps
                        changeStep();
                    });

                    // going back to one step functionality
                    goBackBtn.addEventListener("click", (event) => {
                        // decreasing the index
                        stepIndex = 1;

                        // then changing the steps , going back !
                        changeStep();
                    });
                });

                // otp input functionality
                function otpInput() {
                    var otp_inputs = document.querySelectorAll(".otp__digit");
                    var mykey = "0123456789".split("");
                    otp_inputs.forEach((_) => {
                        _.addEventListener("keyup", handle_next_input);
                    });
                    function handle_next_input(event) {
                        let current = event.target;
                        let index = parseInt(
                            current.classList[1].split("__")[2]
                        );
                        current.value = event.key;

                        if (event.keyCode == 8 && index > 1) {
                            current.previousElementSibling.focus();
                        }
                        if (
                            index < 6 &&
                            mykey.indexOf("" + event.key + "") != -1
                        ) {
                            var next = current.nextElementSibling;
                            if (next) {
                                next.focus();
                            }
                        }
                        var _finalKey = "";
                        for (let { value } of otp_inputs) {
                            _finalKey += value;
                        }
                        if (
                            _finalKey.length == 6 &&
                            document.querySelector("#_otp")
                        ) {
                            document
                                .querySelector("#_otp")
                                .classList.replace("_notok", "_ok");
                            document.querySelector("#_otp").innerText =
                                _finalKey;
                        } else {
                            if (document.querySelector("#_otp")) {
                            }
                        }
                    }
                }

                otpInput();
            }
        }
        popUpAuth();

        // repeat booking functionality
        function repeatBooking() {
            let repeatCheckToggle = document.getElementById("repeat-booking");
            let repeatBookingContainer = document.querySelector(
                ".repeat--booking--holder"
            );
            let singleWeekDayWrapper = document.querySelector(
                ".single--weekday--wrapper"
            );

            let dayMonthYearSelect = document.getElementById(
                "day--month--year--select"
            );

            let weekDaySelectHolder = document.querySelector(
                ".week--day--select--holder"
            );

            let weekDayToggle = document.getElementById("week--day");
            if (repeatBookingContainer) {
                // showing the original bottom content
                repeatCheckToggle.addEventListener("input", () => {
                    repeatBookingContainer.classList.toggle("show--bottom");
                });

                // toggling the week days section
                weekDayToggle.addEventListener("change", (event) => {
                    let value = event.target.value;
                    console.log(value);
                    if (value === "these-day-of-week") {
                        singleWeekDayWrapper.classList.add(
                            "show--single--weekday--wrapper"
                        );
                    } else {
                        singleWeekDayWrapper.classList.remove(
                            "show--single--weekday--wrapper"
                        );
                    }
                });

                // toggling the day week or year select
                dayMonthYearSelect.addEventListener("change", (event) => {
                    let value = event.target.value;
                    console.log(value);

                    if (value === "weeks") {
                        weekDaySelectHolder.classList.add(
                            "show--week--day--holder"
                        );
                    } else {
                        weekDaySelectHolder.classList.remove(
                            "show--week--day--holder"
                        );
                    }
                });
            }
        }
        repeatBooking();

        // hamburger menu functionality
        function hamburgerIcon() {
            let button = document.querySelector(".hamburger--menu");
            let header = document.querySelector("header");

            button.addEventListener("click", (event) => {
                event.stopPropagation(); // Stop propagation to prevent immediate closing due to the document click event
                header.classList.toggle("show--nav");
                button.classList.toggle("open");
            });

            // closing the navbar on outside click
            document.addEventListener("click", (event) => {
                if (
                    !header.contains(event.target) &&
                    !button.contains(event.target)
                ) {
                    header.classList.remove("show--nav");
                    button.classList.remove("open");
                }
            });
        }

        hamburgerIcon();

        // user profile dropdown functionality
        function userProfile() {
            let profileButton = document.querySelector(".user--profile");
            let closeProfile = document.querySelector(
                ".profile--close--button"
            );
            let userProfile = document.querySelector(
                ".user--profile--info--wrapper"
            );
            if (userProfile) {
                // opening wrapper
                profileButton.addEventListener("click", (event) => {
                    event.preventDefault();
                    userProfile.classList.add("show--profile");
                });
                // closing wrapper
                closeProfile.addEventListener("click", (event) => {
                    event.preventDefault();
                    event.stopPropagation();
                    userProfile.classList.remove("show--profile");
                });

                // closing wrapper on outside click
                document.addEventListener("click", (event) => {
                    if (
                        !userProfile.contains(event.target) &&
                        !profileButton.contains(event.target)
                    ) {
                        userProfile.classList.remove("show--profile");
                    }
                });
            }
        }

        userProfile();
    });
})(jQuery);
