<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Testing\Fluent\AssertableJson;

test('successfully authorization and authentication', function () {
     Artisan::call('migrate:fresh');

    $response = $this->post(route('authorization'), [
        'hash' => encrypt(['id' => 1, 'username' => 'KaptainMidnight'])
    ]);

    $response->assertJson(fn (AssertableJson $json) => $json->hasAll(['access_token', 'token_type']));
});
