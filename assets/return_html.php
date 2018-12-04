<?php
/**
 * Created by PhpStorm.
 * User: Pro
 * Date: 05.01.2016
 * Time: 14:45
 * this function return html and js code
 */

function rentit_Picking_Up_Location_html($name,$title,$value,$helptext="") {

    $helptext = explode("/",$helptext);

    ?>

    <div class="form-group has-icon has-label">
        <label  for='edited_labela<?php echo esc_attr($name);?>'><?php echo esc_html($title); ?>:</label>
        <input type="text"   class="form-control" id='edited_labela<?php echo esc_attr($name);?>' name='<?php echo esc_attr($name);?>'  value='' placeholder="<?php echo esc_html($value); ?>"/>

        <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
        <input type="hidden" id="<?php echo esc_attr($name);?>_lon" name="<?php echo esc_attr($name);?>_lon" value="">
        <input type="hidden" id="<?php echo esc_attr($name);?>_lat" name="<?php echo esc_attr($name);?>_lon" value="">

    </div>



    <script>



        function initialize_map() {
            // Create the autocomplete object, restricting the search to geographical
            // location types.
            autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('edited_labela<?php echo esc_attr($name);?>')),
                {types: ['geocode']});

            // When the user selects an address from the dropdown, populate the address
            // fields in the form.
            autocomplete.addListener('place_changed', function(){
                var place = autocomplete.getPlace();
                console.log(place);
                jQuery("#<?php echo esc_attr($name);?>_lon").val(place.geometry.location.lng());
                jQuery("#<?php echo esc_attr($name);?>_lat").val(place.geometry.location.lat());
            } );
        }





    </script>


    <?php




}



// function to geocode address, it will return false if unable to geocode address
function  rentit_geocode($address){

    // url encode the address
    $address = urlencode($address);


    // get the json response
    $resp_json = wp_remote_get("http://maps.google.com/maps/api/geocode/json?address={$address}");

    // decode the json
    $resp = json_decode($resp_json["body"], true);


    // response status will be 'OK', if able to geocode given address
    if($resp['status']=='OK'){

        // get the important data
        $lati = $resp['results'][0]['geometry']['location']['lat'];
        $longi = $resp['results'][0]['geometry']['location']['lng'];
        $formatted_address = $resp['results'][0]['formatted_address'];

        // verify if data is complete
        if($lati && $longi && $formatted_address){

            // put the data in the array
            $data_arr = array();

            array_push(
                $data_arr,
                esc_html($lati),
                esc_html($longi),
                esc_html($formatted_address)
            );

            return $data_arr;

        }else{
            return false;
        }

    }else{
        return false;
    }
}