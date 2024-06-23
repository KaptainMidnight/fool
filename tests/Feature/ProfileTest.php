<?php

use App\Infrastructure\Persistence\Eloquent\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Testing\Fluent\AssertableJson;

test('user profile shows correct', function () {
    Artisan::call('migrate:fresh');
    $user = User::query()->create([
        'telegram_id' => 1231,
        'username' => 'test',
        'coins' => 1000,
        'cash' => 0
    ]);
    $response = $this->actingAs($user)->get(route('profile'));

    $response->assertStatus(200);
    $response->assertJson(fn (AssertableJson $json) => $json->hasAll(['id', 'telegram_id', 'username', 'coins', 'cash', 'achievements']));
});
