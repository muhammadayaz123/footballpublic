// $(document).ready(function () {
//     setupHiddenInputChangeListener($('.iti__selected-flag'));


$(function(event) {

//    $("#phone_number-d").on("countrychange", function () {
//                 // debugger;
//                 // var SelectedCountry = iti.getSelectedCountryData();
//                 // console.log(SelectedCountry);
//                 var mobilePhoneInputField = document.querySelector("#phone_number-d");
//                 var mobilePhoneInput = window.intlTelInput(mobilePhoneInputField, {
//                     nationalMode: true,
//                     utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js?1613236686837",
//                 });

//                  mobilePhoneDialCode = mobilePhoneInput.getSelectedCountryData().dialCode;
//                 $('#country_code-d').val(mobilePhoneDialCode).attr('value', mobilePhoneDialCode);

//                 // on change of input field
//                 $(mobilePhoneInputField).on('change', function(e) {
//                     // console.log(mobilePhoneInput.getSelectedCountryData());
//                     mobilePhoneDialCode = mobilePhoneInput.getSelectedCountryData().dialCode;
//                     $('#country_code-d').val(mobilePhoneDialCode).attr('value', mobilePhoneDialCode);
//                 });
//            });


    // Mobile Phone Number
    var mobilePhoneInputField = document.querySelector("#phone_number-d");
                var mobilePhoneInput = window.intlTelInput(mobilePhoneInputField, {
                    nationalMode: true,
                    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js?1613236686837",
                });

    // mobilePhoneDialCode = mobilePhoneInput.getSelectedCountryData().dialCode;
    // $('#country_code-d').val(mobilePhoneDialCode).attr('value', mobilePhoneDialCode);

    // on change of input field
    $(mobilePhoneInputField).on('change', function(e) {
        // console.log(mobilePhoneInput.getSelectedCountryData());
        mobilePhoneDialCode = mobilePhoneInput.getSelectedCountryData().dialCode;
        $('#country_code-d').val(mobilePhoneDialCode).attr('value', mobilePhoneDialCode);
    });

    // $('.iti__selected-flag').on("change" , function(e) {
    //     elm = $(this);
    //     title = elm.attr('title');
    //     console.log(title);
    // });

});
