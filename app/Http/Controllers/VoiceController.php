<?php

namespace App\Http\Controllers;

use App\Clients\TwilioClient;
use App\Http\Requests\Voice\VoiceRequest;
use Exception;
use Twilio\Exceptions\RestException;

class VoiceController extends Controller
{

    protected TwilioClient $twilioClient;

    public function __construct(
        TwilioClient $twilioClient
    ) 
    {
        $this->twilioClient = $twilioClient;
    }

    public function initiateCall(VoiceRequest $request) 
    {
        // The twilio number you purchased
        $from = config('services.twilio.phone_number');

        try {
            // Lookup phone number to make sure it is valid before initiating call
            $phone_number = $this->twilioClient
                ->getClient()
                ->lookups
                ->v1
                ->phoneNumbers($request->phone_number)
                ->fetch();
        
            // If phone number is valid and exists
            if ($phone_number) { 
                // Initiate call and record call
                $call = $this->twilioClient
                    ->getClient()
                    ->account
                    ->calls
                    ->create(
                    $request->phone_number, // Destination phone number
                    $from, // Valid Twilio phone number
                    [
                        "record" => True,
                        "url" => "http://demo.twilio.com/docs/voice.xml",
                    ]
                );
                
                if ($call) {
                    echo 'Call initiated successfully';
                } else {
                    echo 'Call failed!';
                }
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        } catch (RestException $rest) {
            echo 'Error: ' . $rest->getMessage();
        }
    }
    
}
