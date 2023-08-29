<?php

namespace Tests\Unit\Api\v1\Admin;

use App\Models\User;
use App\Services\Authentication;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserDeleteTest extends TestCase
{
    public function test_should_respond_success(): void
    {
        $admin = User::query()
            ->where('email', 'admin@buckhill.co.uk')
            ->first();

        $user = User::query()->latest()->first();

        $user->update([
            "is_admin" => false,
        ]);

        $token = Authentication::issue($admin);

        $response = $this->json("DELETE", route("api::v1::admin::user-delete", $user), [], ["Authorization" => "Bearer {$token}"]);

        $response->assertSuccessful()
            ->assertJsonStructure([
                "success",
                "data",
                "error",
                "errors",
                "extra",
            ]);
    }

    public function test_should_respond_unauthorized(): void
    {
        $user = User::query()->latest()->first();

        $response = $this->json("DELETE", route("api::v1::admin::user-delete", $user));

        $response->assertUnauthorized();
    }
}
