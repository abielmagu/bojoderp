<?php
  $api_url = "http://api.sba.gov/geodata/city_data_for_state_of/tx.json";
  $api_json = file_get_contents( $api_url );
  $api_array = json_decode( $api_json , true);
  $api_places = [];
  $options_cities = "";

  foreach ( $api_array as $item ) {
    array_push( $api_places , $item["name"] );
  }

  $places = array_unique( $api_places );
  sort( $places );

  foreach ( $places as $place ) {
    $options_cities .= "'$place', <br>" . NL;
  }

  echo $options_cities;
