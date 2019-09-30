$(document).ready(function() {
    var $countrySelect = $('.js-car-form-country');
    var $cityTarget = $('.js-city-target');

    $countrySelect.on('change', function(e) {
        $.ajax({
            url: $countrySelect.data('city-url'),
            data: {
                country: $countrySelect.val()
            },
            success: function (html) {
                console.log(1);
                console.log($countrySelect.val());

                if (!html) {
                    $cityTarget.find('select').remove();
                    $cityTarget.addClass('d-none');

                    return;
                }

                $cityTarget
                    .html(html)
                    .removeClass('d-none')
            }
        });
    });
});