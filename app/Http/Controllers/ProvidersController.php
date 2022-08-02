<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\API\CQC;
use App\Models\Provider;

class ProvidersController extends Controller
{
    // Retrieve all the providers and pagination from the CQC API. 
    public function index(Request $request)
    {
        $providers = CQC::request('providers', $request->all());

        return $providers;
    }

    // Retrieve a provider from the CQC API.
    // - if it doesn't exist locally, it will be stored.
    // - if it does exist locally and it's older than a week, it will be updated.
    public function show($UUID)
    {
        $provider = CQC::request('providers/' . $UUID);

        if(!$provider){
            return response()->json(['error' => 'Provider not found'], 404);
        }

        $localProvider = $this->checkIfExists($UUID);

        if($localProvider)
        {
            if(strtotime($localProvider->updated_at) < strtotime('-1 week') || $localProvider->updated_at == null)
            {
                $localProvider->updateFromAPI($provider);
            }

            return $localProvider;
        } else {
            $newProvider = new Provider();
            $newProvider->uuid = $UUID;
            $newProvider->name = $provider['name'];
            $newProvider->info = $provider;
            $newProvider->save();

            return Provider::where('uuid', $UUID)->first();
        }
    }

    // Return an array of existing UUIDs for use in the API Explorer page.
    public function getExisting()
    {
        $existing = Provider::select('uuid', 'updated_at')->get();

        return $existing;
    }

    // Search the locally available providers.
    public function searchProviders($query)
    {
        $providers = Provider::where('name', 'like', '%' . $query . '%')->get();

        return $providers;
    }

    function checkIfExists($UUID)
    {
        return Provider::where('uuid', $UUID)->first();
    }
}
