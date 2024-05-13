<?php

namespace App\Services;

use App\Models\Ciudad;
use App\Models\Pais;
use App\Models\Provincia;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CountryStateCityService
{
    protected $client;
    protected $country;
    protected $state;

    protected $API_KEY='d3hDZm5UV2ZhazZ4TExoQ05UblY5akQyM0FXTENpeDB5Q1JyYWhEag==';

    public function __construct() {
        $this->client = new Client([
            'base_uri' => 'https://api.countrystatecity.in/v1/',
            'verify' => false,
        ]);
    }

    public function getCountry()
    {

        $minutes = 360000; // Por ejemplo, se almacena en caché durante 3 MESES

        // Comprueba si los países están en la caché
        $countries = Cache::remember('countries', $minutes, function () {

            $data = DB::table('paises AS p')
                            ->where('p.activo', 1)
                            ->orderBy('p.nombre')
                            ->whereIn('p.iso2_api', ['DO','MX','US','AR','PE','PR','SV'])
                            ->get();

            if(count($data) > 0) {
                return $data;
            } else {
                // Si no están en caché, realiza una solicitud a la API utilizando la instancia de cliente creada en el constructor
                $response = $this->client->get('countries', [
                    'headers' => [
                        'X-CSCAPI-KEY' => $this->API_KEY,//env('COUNTRYSTATECITY_API_KEY'),
                    ]
                ]);

                $data = json_decode($response->getBody(), true);

                $data_insert = [];

                foreach($data as $key) {
                    $data_insert[] = [
                        'id_pais_api' => $key['id'],
                        'iso2_api' => $key['iso2'],
                        'nombre' => $key['name'],
                    ];
                }

                DB::table('paises')->insert($data_insert);

                $data = DB::table('paises AS p')
                            ->select(
                                'id',
                                'iso2_api',
                                'nombre',
                                'id_pais_api',
                                'nombre',
                            )
                            ->where('p.activo', 1)
                            ->whereIn('p.iso2_api', ['DO','MX','US','AR','PE','PR','SV'])
                            ->get();

                return $data;
            }

        });


        return $countries;
    }


    public function getStates($country = 'DO')
    {
        $minutes = 1;
        $this->country = $country;

        $states = Cache::remember("states-$country", $minutes, function () {
            $data = DB::table('provincias AS p')
                        ->select(
                            'p.id',
                            'p.id_pais',
                            'p.id_provincia_api',
                            'p.iso2_api',
                            'p.nombre',
                        )
                        ->join('paises AS pa', 'pa.id', '=', 'p.id_pais')
                        ->where('pa.iso2_api', $this->country)
                        ->where('pa.activo', 1)
                        ->orderBy('pa.nombre')
                        ->get();

            if(count($data) > 0) {

                return $data;

            } else {
                $country = $this->country;
                $response = $this->client->get("countries/$country/states", [
                    'headers' => [
                        'X-CSCAPI-KEY' => $this->API_KEY,//env('COUNTRYSTATECITY_API_KEY'),
                    ]
                ]);

                $country = Pais::where('iso2_api', $country)->first();

                if(!$country) {
                    $this->getCountry();
                    // echo $country;die;

                    $country = Pais::where('iso2_api', $country)->first()->id;
                } else {
                    $country = $country->id;
                }

                $data = json_decode($response->getBody(), true);

                $data_insert = [];

                foreach($data as $key) {
                    $data_insert[] = [
                        'id_pais' => $country,
                        'id_provincia_api' => $key['id'],
                        'iso2_api' => $key['iso2'],
                        'nombre' => $key['name'],
                    ];
                }

                DB::table('provincias')->insert($data_insert);

                $data = DB::table('provincias AS p')
                        ->select(
                            'p.id',
                            'p.id_pais',
                            'p.id_provincia_api',
                            'p.iso2_api',
                            'p.nombre',
                        )
                        ->join('paises AS pa', 'pa.id', '=', 'p.id_pais')
                        ->where('p.id_pais', $country)
                        ->where('p.activo', 1)
                        ->get();

                return $data;
            }
        });

        $country = Pais::where('iso2_api', $country)->first();

        if(!($country)) {
            // echo "entro";die;
            $this->getCountry();
            $country = Pais::where('iso2_api', $country)->first();

            // print_r($country);die;
        }

        if(!Provincia::first()) {
            $data = [];

            foreach($states as $key) {
                $data[] = [
                    'id_pais' => $country->id,
                    'id_provincia_api' => $key['id'],
                    'iso2_api' => $key['iso2'],
                    'nombre' => $key['name'],
                ];
            }

            DB::table('provincias')->insert($data);
        }

        return $states;
    }

    public function getCitiesByState($country = 'DO', $state)
    {
        $minutes = 1;
        $this->country = $country;
        $this->state = $state;

        $cities = Cache::remember("cities-$country-$state", $minutes, function () {

            $country = Pais::where('iso2_api', $this->country)->first()->id;
            $state = Provincia::where('id_pais', $country)->where('iso2_api', $this->state)->first()->id;


            if(Ciudad::where('id_provincia', $state)->first()) {

                $data = Ciudad::select('id', 'nombre')->where('id_provincia', $state)->get();

                return $data;
            } else {

                $response = $this->client->get("countries/{$this->country}/states/{$this->state}/cities", [
                    'headers' => [
                        'X-CSCAPI-KEY' => $this->API_KEY,//env('COUNTRYSTATECITY_API_KEY'),
                    ]
                ]);

                $cities = json_decode($response->getBody(), true);

                $data = [];

                $state = Provincia::where('id_pais', $country)->where('iso2_api', $this->state)->first()->id;

                foreach($cities as $key) {
                    $data[] = [
                        'id_provincia' => $state,
                        'id_ciudad_api' => $key['id'],
                        'nombre' => $key['name'],
                    ];
                }

                DB::table('ciudades')->insert($data);

                $data = Ciudad::select('id', 'nombre')->where('id_provincia', $state )->orderBy('nombre')->get();

                return $data;
            }
        });


        return $cities;
    }

}
