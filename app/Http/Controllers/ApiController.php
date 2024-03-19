<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use League\Csv\Writer;
use League\Csv\CannotInsertRecord;
use SplTempFileObject;

class ApiController extends Controller
{
    public function index(){
    	return view('index');
    }

    public function show(Request $request){
    	$request->validate([
    		'searchTerm' => 'required',
    		'country' => 'required'
    	]);

    	$name=$request->searchTerm;
    	$location=$request->country;

    	$response = Http::get('https://api.valueserp.com/search', [
            'api_key' => '5F07AA9D5AC84306860313579F65111F',
            'q' => $name,
            'location' => $location,
    		"engine" => "google",
            'num' => 20
        ]);
    	 //dd($response->json());
        // Check if the request was successful
        if ($response->successful()) {
            // Parse the JSON response
            $data = $response->json();

           	// Pass the data to the view and render it
            return view('api', ['data' => $data]);         
                                    
        } else {
            // Handle the error
            // return response()->json(['error' => 'Failed to fetch data from API'], $response->status());
             return view('api');
        }
    }
    public function download(Request $request){
    	$name=$request->searchTerm;
    	$location=$request->country;

    	$response = Http::get('https://api.valueserp.com/search', [
            'api_key' => '5F07AA9D5AC84306860313579F65111F',
            'q' => $name,
            'location' => $location,
    		"engine" => "google",
            'num' => 20
        ]);
    	
    	// Check if the request was successful
        if ($response->successful()) {
            // Parse the JSON response
            $data = $response->json();

            // Format the data for CSV
            $csvData = [];
            foreach ($data['organic_results'] as $item) {
            	if (isset($item['snippet']) == '') {
            		$csvData[] = [
                    'Sno.' => $item['position'],
                    'Title' => $item['title'],
                    'Link' => $item['link'],
                    'Domain' => $item['domain'],
                    'Displayed Link' => $item['displayed_link'],
                    'Snippet' => '',
                    // Add more columns as needed
                ];
            	}else{
            		$csvData[] = [
                    'Sno.' => $item['position'],
                    'Title' => $item['title'],
                    'Link' => $item['link'],
                    'Domain' => $item['domain'],
                    'Displayed Link' => $item['displayed_link'],
                    'Snippet' => $item['snippet'],
                    // Add more columns as needed
                ];
            	}
                
            }

            // Generate CSV
        $csv = Writer::createFromFileObject(new SplTempFileObject());
        $csv->insertOne(array_keys($csvData[0])); // Insert header
        foreach ($csvData as $row) {
            try {
                $csv->insertOne($row);
            } catch (CannotInsertRecord $e) {
                // Handle error
            }
        }

        // Provide download
        $filename = 'export.csv';
        return response()->streamDownload(function () use ($csv) {
            echo $csv->getContent();
        }, $filename);
    } else {
        // Handle API request failure
        return response()->json(['error' => 'Failed to fetch data from API'], $response->status());
    }
    }
    
}
