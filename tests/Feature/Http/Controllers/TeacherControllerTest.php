<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TeacherControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->owner()->create());
    }

    public function test_index_works() {
        $teacher = Teacher::factory()->create();

        $this->get(route('teachers.index'))
            ->assertSuccessful()
            ->assertSee($teacher->teacher_name);
    }

    public function test_create_works() {
        $this->get(route('teachers.create'))
            ->assertSuccessful();
    }

    public function test_edit_works() {
        $teacher = Teacher::factory()->create();

        $this->get(route('teachers.edit',$teacher))
            ->assertSuccessful();
    }

    public function test_show_works() {
        $teacher = Teacher::factory()->create();

        $this->get(route('teachers.show',$teacher))
            ->assertSuccessful()
            ->assertSee($teacher->teacher_name);
    }

    public function test_update_works() {
        $teacher = Teacher::factory()->create();
        $data = Teacher::factory()->make(['user_id' => $teacher->user_id])->toArray();

        $this->put(route('teachers.update',$teacher),$data)
            ->assertSuccessful()
            ->assertJson(['data' => $data]);
    }

    public function test_destroy_works() {
        $teacher = Teacher::factory()->create();

        $this->delete(route('teachers.destroy',$teacher))
            ->assertSuccessful();

        $this->assertSoftDeleted($teacher);
    }

    public function test_destroy_all_works() {
        $teachers = Teacher::factory(2)->create();

        $this->post(route('teachers.destroy.all'))
            ->assertSuccessful();

        $this->assertSoftDeleted($teachers[0]);
        $this->assertSoftDeleted($teachers[1]);
    }
}
