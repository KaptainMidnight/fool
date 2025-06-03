<?php
namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    protected function generateTelegramHash(array $data): string
    {
        $checkString = collect($data)
            ->except('hash')
            ->sortKeys()
            ->map(fn($value, $key) => "$key=$value")
            ->implode("\n");

        $secretKey = hash('sha256', config('telegram.bot_token'), true);
        return hash_hmac('sha256', $checkString, $secretKey);
    }

    public function test_authenticates_new_user_and_returns_token()
    {
        $telegramData = [
            'id' => 123456789,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'username' => 'johndoe',
            'auth_date' => now()->timestamp,
        ];
        $telegramData['hash'] = $this->generateTelegramHash($telegramData);

        $response = $this->postJson('/api/auth/telegram/login', $telegramData);

        $response->assertStatus(200)
            ->assertJsonStructure(['token']);

        $this->assertDatabaseHas('users', [
            'telegram_id' => $telegramData['id'],
            'name' => 'John',
            'surname' => 'Doe',
            'username' => 'johndoe',
        ]);
    }

    public function test_authenticates_existing_user()
    {
        $user = User::factory()->create([
            'telegram_id' => 123456789,
            'name' => 'John Doe',
            'username' => 'johndoe',
        ]);

        $telegramData = [
            'id' => 123456789,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'username' => 'johndoe',
            'auth_date' => now()->timestamp,
        ];
        $telegramData['hash'] = $this->generateTelegramHash($telegramData);

        $response = $this->postJson('/api/auth/telegram/login', $telegramData);

        $response->assertStatus(200)
            ->assertJsonStructure(['token']);
        $this->assertDatabaseHas('users', ['telegram_id' => $telegramData['id']]);
    }

    public function test_fails_with_invalid_hash()
    {
        $telegramData = [
            'id' => 123456789,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'username' => 'johndoe',
            'auth_date' => now()->timestamp,
            'hash' => 'invalid_hash',
        ];

        $response = $this->postJson('/api/auth/telegram/login', $telegramData);

        $response->assertStatus(401)
            ->assertJson(['error' => 'Invalid telegram data']);
    }

    public function test_fails_with_expired_auth_date()
    {
        $telegramData = [
            'id' => 123456789,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'username' => 'johndoe',
            'auth_date' => now()->subDays(2)->timestamp,
        ];
        $telegramData['hash'] = $this->generateTelegramHash($telegramData);

        $response = $this->postJson('/api/auth/telegram/login', $telegramData);

        $response->assertStatus(401)
            ->assertJson(['error' => 'Invalid telegram data']);
    }
}
