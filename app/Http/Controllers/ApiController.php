<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    // Get Cats and Dogs
    public function Home(Request $request) {
        $limit = 8;
        $page = is_numeric($request->input('page')) ? $request->input('page') : 1;
        $dogs = $this->ApiCall('DOG', false, false, $page, $limit);
        $cats = $this->ApiCall('CAT', false, false, $page, $limit);
        
        return view('home', compact('dogs', 'cats'));
    }

    // Search Cat
    public function GetCat($cat) {
        $getCat = $this->ApiCall('CAT', $cat, false, false, false);
        $pet = json_decode($getCat['response']);
        $petImage = asset('images/cat-default.jpg');
        $is_dog = false;
        // If has image reference ID call Image API
        if(isset($pet[0]->reference_image_id)) {
            $reqCatImage = $this->ApiCall('CAT', $cat, $pet[0]->reference_image_id, false, false);
            $decodeCatImage = json_decode($reqCatImage['response']);
            $petImage = $decodeCatImage->url;
        }

        return view('pet', compact('pet', 'petImage', 'is_dog'));
    }

    // Search Cat
    public function GetDog($dog) {
        $getDog = $this->ApiCall('DOG', $dog, false, false, false);
        $pet = json_decode($getDog['response']);
        $petImage = asset('images/dog-default.jpg');
        $is_dog = true;
        // If has image reference ID call Image API
        if(isset($pet[0]->reference_image_id)) {
            $reqDogImage = $this->ApiCall('DOG', $dog, $pet[0]->reference_image_id, false, false);
            $decodeDogImage = json_decode($reqDogImage['response']);
            $petImage = $decodeDogImage->url;
        }
        
        return view('pet', compact('pet', 'petImage', 'is_dog'));
    }

    // All cats Only
    public function AllCats(Request $request) {
        $limit = 16;
        $page = is_numeric($request->input('page')) ? $request->input('page') : 1;
        $cats = $this->ApiCall('CAT', false, false, $page, $limit);

        return view('cats', compact('cats'));
    }

    // All cats Only
    public function AllDogs(Request $request) {
        $limit = 16;
        $page = is_numeric($request->input('page')) ? $request->input('page') : 1;
        $dogs = $this->ApiCall('DOG', false, false, $page, $limit);

        return view('dogs', compact('dogs'));
    }

    // API Call for Cat and Dog
    function ApiCall($request, $value, $image, $page, $limit) {
        /*
            request variable    -> Contains either CAT or DOG value
            value variable      -> Contains the name of cacat or Dog for search API
            image variable      -> Indicator for Image request API
            page variable      -> Handles pagination page item
            limit variable      -> Handles pagination number of items
        */
        if($request == 'DOG') {
            $key = env("DOG_KEY");
            if($image) {
                $url = "https://api.thedogapi.com/v1/images/$image";
            } else {
                $url = $value ? "https://api.thedogapi.com/v1/breeds/search?q=$value" : "https://api.thedogapi.com/v1/breeds?page=$page&limit=$limit";
            }
        } else {
            $key = env("CAT_KEY");
            if($image) {
                $url = "https://api.thecatapi.com/v1/images/$image";
            } else {
                $url = $value ? "https://api.thecatapi.com/v1/breeds/search?q=$value" : "https://api.thecatapi.com/v1/breeds?page=$page&limit=$limit";
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
