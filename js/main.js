jQuery(document).ready(function ($) {

  /*  jQuery('.product-list-item').click(function (e) {
        if (document.cookie.match(/.*?rentit_order_id.*?/)) {
            alert(2);
        }
    });*/
});

jQuery(document).ready(function ($) {
    $('.typeahead.dropdown-menu a').click(function () {
       // alert(1);
        $(this).hide();
    })
});

/**
 * Created by Pro on 21.06.2016.
 */
jQuery(document).ready(function ($) {
    $('.formSearchUpLocation').typeahead({
        minLength: 0,
        source: rentit_obj.location

    });


});


jQuery(document).ready(function ($) {
    $('.formSearchUpLocation').typeahead({
        minLength: 0,
        source: rentit_obj.location

    });
});
jQuery(document).ready(function ($) {
    $('.typeaheadgrupproduct').typeahead({
        minLength: 0,
        source: rentit_obj.price_group

    });
});


jQuery(document).ready(function ($) {
    $('#formSearchUpLocation2').typeahead({
        minLength: 0,
        source: rentit_obj.location

    });

});

jQuery(document).ready(function ($) {
    $('#formSearchOffLocation2').typeahead({
        minLength: 0,
        source: rentit_obj.location

    });
});
