(function ($) {

    function str_replace(search, replace, subject) {

        // Replace all occurrences of the search string with the replacement string
        //
        // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        // +   improved by: Gabriel Paderni

        if (!(replace instanceof Array)) {
            replace = new Array(replace);
            if (search instanceof Array) {//If search	is an array and replace	is a string, then this replacement string is used for every value of search
                while (search.length > replace.length) {
                    replace[replace.length] = replace[0];
                }
            }
        }

        if (!(search instanceof Array)) search = new Array(search);
        while (search.length > replace.length) {//If replace	has fewer values than search , then an empty string is used for the rest of replacement values
            replace[replace.length] = '';
        }

        if (subject instanceof Array) {//If subject is an array, then the search and replace is performed with every entry of subject , and the return value is an array as well.
            for (k in subject) {
                subject[k] = str_replace(search, replace, subject[k]);
            }
            return subject;
        }

        for (var k = 0; k < search.length; k++) {
            var i = subject.indexOf(search[k]);
            while (i > -1) {
                subject = subject.replace(search[k], replace[k]);
                i = subject.indexOf(search[k], i);
            }
        }

        return subject;

    }


    setTimeout(function () {
        jQuery('[href="#rental_cost_and_resources"]').click();
    }, 500);
    jQuery('select#product-type').change(function () {
        if (jQuery(this).val() == "rentit_rental") {
            jQuery('.show_if_rentit_rental').show();
        }
        else {
            jQuery('.show_if_rentit_rental').hide();
        }
    });


    $('.has-timepicker').timepicker();


    // Repeatable locations
    $('#woocommerce-product-data').on('click', '.car_locations a.insert', function () {
        $(this).closest('.car_locations').find('tbody').append($(this).data('row'));
        return false;
    });
    $('#woocommerce-product-data').on('click', '.car_locations a.delete', function () {
        $(this).closest('tr').remove();
        return false;
    });

    // Repeatable resources
    $('#woocommerce-product-data').on('click', '.rental-resources a.insert', function () {
        $(this).closest('.rental-resources').find('tbody').append($(this).data('row'));
        return false;
    });
    $('#woocommerce-product-data').on('click', '.rental-resources a.delete', function () {
        $(this).closest('tr').remove();
        return false;
    });


    // insert_charge_locations
    $('#woocommerce-product-data').on('click', 'a.insert_charge_locations', function () {
        $(this).closest('.rental-charge-location').find('tbody').append($(this).data('row'));



        $(this).closest('.t_season_discounts').find('tbody').append($(this).data('row'));


        $('.tbody_charge_locations_tr').each(function (index) {
            console.log(index);


            var cost = $(this).find('.input_text.cost').attr('name');

            var drop_in = $(this).find('.drop-in').attr('name');
            var drop_off = $(this).find('.drop-off').attr('name');
            var days = $(this).find('.days').attr('name');

            if (typeof cost !== 'undefined' && cost)
                $(this).find('.input_text.cost').attr('name', cost.replace(/\d+/, index));

            if (typeof drop_in !== 'undefined' && drop_in)
                $(this).find('.drop-in').attr('name', drop_in.replace(/\d+/, index));

            if (typeof drop_off !== 'undefined' && drop_off)
                $(this).find('.drop-off').attr('name', drop_off.replace(/\d+/, index));

            if (typeof days !== 'undefined' && days)
                $(this).find('.days').attr('name', days.replace(/\d+/, index));


        });


        $('.wc-enhanced-select').select2();
        return false;
    });

    $('#woocommerce-product-data').on('click', '.rental-charge-location a.delete', function () {
        $(this).closest('tr').remove();
        return false;
    });


    // Bulk resources

    $('#woocommerce-product-data').on('click', '.rental-discounts a.insert', function () {

        $(this).closest('.rental-discounts').find('tbody').append($(this).data('row'));
        return false;
    });
    $('#woocommerce-product-data').on('click', '.rental-discounts a.delete', function () {
        $(this).closest('tr').remove();
        return false;
    });


    // sesonal dicount


    $('#woocommerce-product-data').on('click', 'a.insert_season_discounts', function () {

        $data = $(this).data('row');


        $(this).closest('.t_season_discounts').find('tbody').append($(this).data('row'));


        $('.tbody_season_tr').each(function (index) {
            console.log(index);


            $(this).find('.t_season_discounts').each(function (i) {
                var cost = $(this).find('.input_text.cost').attr('name');

                var duration_val = $(this).find('.duration_val').attr('name');
                var duration_type = $(this).find('.duration_type').attr('name');

                if (typeof cost !== 'undefined' && cost)
                    $(this).find('.input_text.cost').attr('name', cost.replace(/\d+/, index));

                if (typeof duration_val !== 'undefined' && duration_val)
                    $(this).find('.duration_val').attr('name', duration_val.replace(/\d+/, index));
                if (typeof duration_type !== 'undefined' && duration_type)
                    $(this).find('.duration_type.cost').attr('name', duration_type.replace(/\d+/, index));

            });

        });


        return false;
    });

    // Bulk unavable date

    jQuery('[href="#rental_cost_and_resources"]').click();
    $('#woocommerce-product-data').on('click', '.insert_season_date', function () {
        $(this).closest('.rental-unavailable-date').find('.tbody_season').append($(this).data('row'));
        var i = 0;
        $('.rental-unavailable-date input').each(function () {

            $(this).data('id', 'rentit_startdate_m' + i);
            $(this).addClass('rentit_startdate_m' + i);
            i++;
        });

        jQuery('.rentit_startdate').each(function () {

            $('.' + $(this).data('id')).datetimepicker({
                minDate: today,
                format: "MM/DD/YYYY H:mm"

            });
        });

        jQuery('.rentit_enddate').each(function () {

            $('.' + $(this).data('id')).datetimepicker({
                minDate: today,
                format: "MM/DD/YYYY H:mm"

            });
        });


        $(this).closest('.t_season_discounts').find('tbody').append($(this).data('row'));


        $('.tbody_season_tr').each(function (index) {
            console.log(index);


            $(this).find('.t_season_discounts').each(function (i) {
                // $(this).find('.duration_val').hide();
                var cost = $(this).find('.input_text.cost').attr('name');
                //  $(this).find('.input_text.cost').val('222');
                var duration_val = $(this).find('.duration_val').attr('name');
                var duration_type = $(this).find('.duration_type').attr('name');
                if (typeof cost !== 'undefined' && cost) {
                    //   console.log(cost.replace('/\[\\d\]/', '200'));
                }

                if (typeof cost !== 'undefined' && cost)
                    $(this).find('.input_text.cost').attr('name', cost.replace(/\d+/, index));

                if (typeof duration_val !== 'undefined' && duration_val)
                    $(this).find('.duration_val').attr('name', duration_val.replace(/\d+/, index));
                if (typeof duration_type !== 'undefined' && duration_type)
                    $(this).find('.duration_type.cost').attr('name', duration_type.replace(/\d+/, index));

            });

        });


        return false;

    });

    $('#woocommerce-product-data').on('click', '.rental-unavailable-date a.insert', function () {

        //    alert(2);
        $(this).closest('.rental-unavailable-date').find('tbody').append($(this).data('row'));

        var i = 0;
        $('.rental-unavailable-date input').each(function () {

            $(this).data('id', 'rentit_startdate_m' + i);
            $(this).addClass('rentit_startdate_m' + i);
            i++;
        });

        jQuery('.rentit_startdate').each(function () {

            $('.' + $(this).data('id')).datetimepicker({
                minDate: today,
                format: "MM/DD/YYYY H:mm"

            });
        });

        jQuery('.rentit_enddate').each(function () {

            $('.' + $(this).data('id')).datetimepicker({
                minDate: today,
                format: "MM/DD/YYYY H:mm"

            });
        });

        return false;
    });
    $('#woocommerce-product-data').on('click', '.rental-unavailable-date a.delete', function () {

        $(this).closest('tr').remove();
        return false;
    });
    var nowDate = new Date();
    var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);


    jQuery('.rentit_enddate').each(function () {

        $('.' + $(this).data('id')).datetimepicker({
            minDate: today,
            format: "MM/DD/YYYY H:mm"

        });
    });


    jQuery('.rentit_startdate').each(function () {

        $('.' + $(this).data('id')).datetimepicker({
            minDate: today,
            format: "MM/DD/YYYY H:mm"

        });
    });


    /*jQuery(document).ready(function() {
     jQuery('.rentit_enddate').datepicker({
     dateFormat : 'dd-mm-yy'
     });
     });*/
})(jQuery);

