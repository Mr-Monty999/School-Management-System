<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Classes;
use App\Models\Parents;
use App\Models\Student;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ParentsControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->owner()->create());
    }

    public function test_index_works() {
        $parent = Parents::factory()->create();

        $this->get(route('parents.index'))
            ->assertSuccessful()
            ->assertSee($parent->parent_name);
    }

    public function test_show_works() {
        $parent = Parents::factory()->create();
        Classes::factory()->create();
        $student = Student::factory()->create(['parent_id' => $parent->id]);

        $this->get(route('parents.show',$parent))
            ->assertSuccessful()
            ->assertSee($parent->parent_name)
            ->assertSee($student->student_name);
    }

    public function test_update_works() {
        $data = Parents::factory()->make()->toArray();
        $parent = Parents::factory()->create();

        $this->put(route('parents.update',$parent),$data)
            ->assertSuccessful()
            ->assertJson(['data' => $data]);
    }

}
