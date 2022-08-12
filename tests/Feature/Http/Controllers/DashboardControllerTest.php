<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Classes;
use App\Models\Employe;
use App\Models\Parents;
use App\Models\Student;
use App\Models\Teacher;
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

        $this->get(route('dashboard.index'))
            ->assertSuccessful()
            ->assertSee('مرحبا بك ' . $user->username);
    }

    public function test_student_doesnt_see_statistics() {
        Classes::factory()->create();
        Parents::factory()->create();
        Student::factory()->create();

        $this->actingAs(User::first());

        $this->get(route('dashboard.index'))
            ->assertSuccessful()
            ->assertDontSee('عدد الطلاب')
            ->assertDontSee('عدد المعلمين')
            ->assertDontSee('عدد الفصول')
            ->assertDontSee('عدد الموظفين');
    }

    public function test_teacher_doesnt_see_statistics() {
        Teacher::factory()->create();

        $this->actingAs(User::first());

        $this->get(route('dashboard.index'))
            ->assertSuccessful()
            ->assertDontSee('عدد الطلاب')
            ->assertDontSee('عدد المعلمين')
            ->assertDontSee('عدد الفصول')
            ->assertDontSee('عدد الموظفين');
    }

    public function test_employe_doesnt_see_statistics() {
        Employe::factory()->create();

        $this->actingAs(User::first());

        $this->get(route('dashboard.index'))
            ->assertSuccessful()
            ->assertDontSee('عدد الطلاب')
            ->assertDontSee('عدد المعلمين')
            ->assertDontSee('عدد الفصول')
            ->assertDontSee('عدد الموظفين');
    }

    public function test_admin_see_statistics() {
        Employe::factory()->admin()->create();

        $this->actingAs(User::first());

        $this->get(route('dashboard.index'))
            ->assertSuccessful()
            ->assertSee('عدد الطلاب')
            ->assertSee('عدد المعلمين')
            ->assertSee('عدد الفصول')
            ->assertSee('عدد الموظفين');
    }

    public function test_owner_see_statistics() {
        User::factory()->owner()->create();

        $this->actingAs(User::first());

        $this->get(route('dashboard.index'))
            ->assertSuccessful()
            ->assertSee('عدد الطلاب')
            ->assertSee('عدد المعلمين')
            ->assertSee('عدد الفصول')
            ->assertSee('عدد الموظفين');
    }
}
