<?php

namespace Tests\Feature;

use Domain\Entities\User\User;
use Faker\Factory;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * @test
     */
    public function guest_register()
    {
        Notification::fake();

        $faker = Factory::create();

        $response = $this->get(route('register'));

        $response->assertStatus(200);

        $password = $faker->password(8, 10);
        $email = $faker->email;

        // Test missing password
        $response = $this->post(route('register'), [
            'name' => $faker->name,
            'email' => $email,
            'password' => $password,
        ]);

        $response->assertSessionHasErrors();

        // Test success
        $response = $this->post(route('register'), [
            'name' => $faker->name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password,
        ]);

        Notification::assertSentTo(User::where('email', $email)->first(), VerifyEmail::class);

        $response->assertStatus(200);
        $response->assertJson(['status' => true]);
    }

    /**
     * @test
     */
    public function guest_login()
    {
        $faker = Factory::create();

        $password = $faker->password(8, 10);

        $user = factory(User::class)->create([
            'password' => bcrypt($password),
        ]);

        $response = $this->get(route('login'));
        $response->assertStatus(200);

        // False password
        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => $password . '123',
        ]);

        $response->assertJson(['status' => false]);

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertStatus(200);
        $response->assertJson(['status' => true]);
    }

    /**
     * @test
     */
    public function user_login()
    {
        // Unverified user
        $user = factory(User::class)->create([
            'email_verified_at' => null,
        ]);

        $response = $this->actingAs($user)->get(route('site.forum.index'));
        $response->assertStatus(302);

        // Verified user
        $user = factory(User::class)->create([
            'email_verified_at' => now(),
        ]);

        $response = $this->actingAs($user)->get(route('site.forum.index'));
        $response->assertStatus(200);

        // Not allowed!
        $response = $this->actingAs($user)->get(route('admin.dashboard'));
        $response->assertRedirect('/');
    }
}
