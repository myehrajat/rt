(function($) {

  // Rentit booking frontend script

  /**
   * Calendar selection for product
   */

   var dateSelect = jQuery('.rentitDateSelection');
   if (dateSelect.length) {

     // dateSelect.datetimepicker();

     // var nowDate = new Date();
     // var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);

     var date = new Date();
     date.setDate(date.getDate()-1);

     var notAvailableDates = car_calendar.not_available_date;

     dateSelect.datepicker({
       startDate: date,
       daysOfWeekDisabled: notAvailableDates // Value: "0,6"
     });

   }

   /*
    * Calendar selection for product ends
    */


   /*
    * Detect date changed
    */

    jQuery('.rentitDateSelection').on('change', function () {

        var n = new Date(this.value);
        var w = n.getDay();
        console.log('Day: '+ this.value + ' '+ w);

        /*
         * Time selection starts
         */

         var ex1 = {
             disabled: []
         };

         watch(ex1, 'disabled', function(){

             jQuery('.dropin-time').timepicker('remove');

             listenTime(ex1.disabled);

             if(ex1.disabled == 'null'){
                jQuery('.dropin-time').timepicker(); // Default
             }

         });


        ex1.disabled = 'null';


        if(w == 1){ // Sun
          // ex1.disabled = ['1am', '4am'];

          // Not available time
          var notAvailableTime = [];
          notAvailableTime = car_calendar.not_available_times.day_1;

          console.log('Available time selection: ', notAvailableTime);

          ex1.disabled = notAvailableTime;

        }

        if(w == 2){ // Tu
          // ex1.disabled = ['1am', '4am'];

          // Not available time
          var notAvailableTime = [];
          notAvailableTime = car_calendar.not_available_times.day_2;

          console.log('Available time selection: ', notAvailableTime);

          ex1.disabled = notAvailableTime;

        }

        if(w == 3){ // Wed
          // ex1.disabled = ['1am', '4am'];

          // Not available time
          var notAvailableTime = [];
          notAvailableTime = car_calendar.not_available_times.day_3;

          console.log('Available time selection: ', notAvailableTime);

          ex1.disabled = notAvailableTime;

        }

        if(w == 4){ // Thu

          // Not available time
          var notAvailableTime = [];
          notAvailableTime = car_calendar.not_available_times.day_4;

          console.log('Available time selection: ', notAvailableTime);

          ex1.disabled = notAvailableTime;

        }

        if(w == 5){ // Fri
          // ex1.disabled = ['1am', '4am'];

          // Not available time
          var notAvailableTime = [];
          notAvailableTime = car_calendar.not_available_times.day_5;

          console.log('Available time selection: ', notAvailableTime);

          ex1.disabled = notAvailableTime;

        }


        if(w == 6){ // Sat
          // ex1.disabled = ['1am', '4am'];

          // Not available time
          var notAvailableTime = [];
          notAvailableTime = car_calendar.not_available_times.day_6;

          console.log('Available time selection: ', notAvailableTime);

          ex1.disabled = notAvailableTime;

        }

        var listenTime = function($time){
          var dropInSelect = jQuery('.dropin-time');
          if (dropInSelect.length) {
            dropInSelect.timepicker({
              'disableTimeRanges': [
                $time
              ]
            });
          }
        }

        /*
         * Time selection ends
         */


    });


    jQuery('.dropoff-time').timepicker();


    // Bulk resources
    jQuery('.has-select2').select2();


} )( jQuery );
