<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Classes;
use App\Models\Parents;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_index_works() {
        $user = User::factory()->create()->first();

        $this->actingAs($user);

        $this->get('/')
            ->assertSuccessful()
            ->assertSee('مرحبا بك ' . $user->username);
    }

    public function test_student_dont_see_statistics() {
        Classes::factory()->create();
        Parents::factory()->create();
        Student::factory()->create();


        $this->actingAs(User::first());

        $this->get('/')
            ->assertSuccessful()
            ->assertDontSee('الطلاب')
            ->assertDontSee('المعلمين')
            ->assertDontSee('الفصول')
            ->assertDontSee('الموظفين');
    }


}
