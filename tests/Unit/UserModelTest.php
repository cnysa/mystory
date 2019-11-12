<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserModelTest extends TestCase
{
    use DatabaseMigrations;

    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    /**
     * Test user belongs to QeoQeo by check verified email
     */
    public function test_user_qeoqeo()
    {
        $qeoqeoUser = User::find(1);

        $this->assertTrue($qeoqeoUser->is_qeoqeo_user);
    }
}
