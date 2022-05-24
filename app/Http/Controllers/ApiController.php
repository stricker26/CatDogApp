<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    // Get Cats and Dogs
    public function Home(Request $request) {
        $page = is_numeric($request->input('page')) ? $request->input('page') : 1;
        $dogs = $this->ApiCall('DOG', false, false, $page);
        $cats = $this->ApiCall('CAT', false, false, $page);

        return view('home', compact('dogs', 'cats'));
    }

    // Search Cat
    public function GetCat($cat) {
        $getCat = $this->ApiCall('CAT', $cat, false, false);
        $pet = json_decode($getCat['response']);
        $petImage = asset('images/cat-default.jpg');
        $is_dog = false;
        // If has image reference ID call Image API
        if(isset($pet[0]->reference_image_id)) {
            $reqCatImage = $this->ApiCall('CAT', $cat, $pet[0]->reference_image_id, false);
            $decodeCatImage = json_decode($reqCatImage['response']);
            $petImage = $decodeCatImage->url;
        }

        return view('pet', compact('pet', 'petImage', 'is_dog'));
    }

    // Search Cat
    public function GetDog($dog) {
        $getDog = $this->ApiCall('DOG', $dog, false, false);
        $pet = json_decode($getDog['response']);
        $petImage = asset('images/dog-default.jpg');
        $is_dog = true;
        // If has image reference ID call Image API
        if(isset($pet[0]->reference_image_id)) {
            $reqDogImage = $this->ApiCall('DOG', $dog, $pet[0]->reference_image_id, false);
            $decodeDogImage = json_decode($reqDogImage['response']);
            $petImage = $decodeDogImage->url;
        }
        
        return view('pet', compact('pet', 'petImage', 'is_dog'));
    }

    // API Call for Cat and Dog
    function ApiCall($request, $value, $image, $page) {
        /*
            request variable    -> Contains either CAT or DOG value
            value variable      -> Contains the name of cacat or Dog for search API
            image variable      -> Indicator for Image request API
            page variable      -> Handles pagination
        */
        if($request == 'DOG') {
            $key = env("DOG_KEY");
            if($image) {
                $url = "https://api.thedogapi.com/v1/images/$image";
            } else {
                $url = $value ? "https://api.thedogapi.com/v1/breeds/search?q=$value" : "https://api.thedogapi.com/v1/breeds?page=$page&limit=8";
            }
        } else {
            $key = env("CAT_KEY");
            if($image) {
                $url = "https://api.thecatapi.com/v1/images/$image";
            } else {
                $url = $value ? "https://api.thecatapi.com/v1/breeds/search?q=$value" : "https://api.thecatapi.com/v1/breeds?page=$page&limit=8";
            }
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "x-api-key: $key"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return array(
           'error'  => $err,
           'response' => $response
        );
    }
}
