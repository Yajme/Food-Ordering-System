<?php
class Location{
    
    public static function Location($index,$code){
        /**
         * Fetches data from an API based on the given index.
         *
         * @param string $index The index to determine the API URL.
         * @param string $code The code used in the API URL.
         * @return array The fetched data from the API.
         */
        $type = array(
            'barangayAll'=> "https://psgc.gitlab.io/api/cities-municipalities/$code/barangays.json",
            'barangay'=> "https://psgc.gitlab.io/api/barangays/$code.json",
            'municipalityAll'=> "https://psgc.gitlab.io/api/provinces/041000000/cities-municipalities.json",
            'municipality'=> "https://psgc.gitlab.io/api/cities-municipalities/$code.json",
        );
        // Fetch data from API

        $apiUrl = $type[$index];


        // Initialize cURL session
        $ch = curl_init($apiUrl);

        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute cURL session and get the response
        $response = curl_exec($ch);

        // Check if the request was successful
        if ($response === FALSE) {
            die('Error occurred while fetching data from the API: ' . curl_error($ch));
        }

        // Close cURL session
        curl_close($ch);

        // Decode the JSON response
        $data = json_decode($response, true);

        // Check if JSON decoding was successful
        if ($data === NULL) {
            die('Error decoding JSON response from the API');
        }

                return $data;
        }
}
        
        
    

    ?>
