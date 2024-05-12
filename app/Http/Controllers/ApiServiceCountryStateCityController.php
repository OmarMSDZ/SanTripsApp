<?php

namespace App\Http\Controllers;

use App\Services\CountryStateCityService;
use Illuminate\Http\Request;

class ApiServiceCountryStateCityController extends Controller
{

    public function getCountries()
    {

        $data = new CountryStateCityService();
        $data = $data->getCountry();
        return $data;
    }

    public function getStates($country)
    {

        $data = new CountryStateCityService();
        $data = $data->getStates($country);

        $return = new \stdClass();
        $return->html = "<option value=''> === </option>";

        foreach ($data as $key) {
            $return->html .= "<option value='$key->id' code_iso2='$key->iso2_api'>$key->nombre</option>";
        }

        return response()->json($return);
    }

    public function getCities($country, $state)
    {

        $data = new CountryStateCityService();
        $data = $data->getCitiesByState($country, $state);

        $return = new \stdClass();
        $return->html = "<option value=''> === </option>";

        foreach ($data as $key) {
            $return->html .= "<option value='$key->id'>$key->nombre</option>";
        }

        return response()->json($return);
    }
}
