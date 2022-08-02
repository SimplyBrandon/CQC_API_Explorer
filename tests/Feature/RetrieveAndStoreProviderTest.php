<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Provider;

class RetrieveAndStoreProviderTest extends TestCase
{
    const ProviderUUID = '1-10000227676';

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_RetrieveAndStoreProviderFromCqcApi()
    {
        // Remove the provider if it exists.
        $provider = Provider::where('uuid', '=', self::ProviderUUID)->first();
        if($provider)
        {
            $provider->delete();
        }

        // Retrieve the provider from the CQC API and store it in the database.
        $this->retrieveProvider(self::ProviderUUID);

        // Check if the provider now exists in the database.
        $this->assertTrue(Provider::where('uuid', '=', self::ProviderUUID)->exists());
    }

    // By querying the local CQC API, we will retrieve the provider from the CQC API and:
    // - if it doesn't exist, it will be stored locally.
    // - if it does exist and it's older than a week, it will be updated locally.

    public function retrieveProvider()
    {
        $response = $this->get('/api/providers/' . self::ProviderUUID);

        // True [200] means the provider exists.
        // False [404] means the provider doesn't exist.
        // Null [500] means the provider might exist, but the CQC API is experiencing issues.
        $response->assertStatus(200);
    }
}
