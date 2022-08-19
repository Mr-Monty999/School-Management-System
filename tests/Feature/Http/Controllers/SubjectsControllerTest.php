<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\User;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\SubjectTeacher;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SubjectsControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->owner()->create());
    }

    public function test_index_works() {
        Classes::factory()->create();
        $subject = Subject::factory()->create();

        $this->get(route('subjects.index'))
            ->assertSuccessful()
            ->assertSee($subject->subject_name);
    }

    public function test_create_works() {
        $this->get(route('subjects.create'))
            ->assertSuccessful();
    }

    public function test_edit_works() {
        Classes::factory()->create();
        $subject = Subject::factory()->create();

        $this->get(route('subjects.edit',$subject))
            ->assertSuccessful();
    }

    public function test_show_works() {
        Classes::factory()->create();
        $subject = Subject::factory()->create();

        $this->get(route('subjects.show',$subject))
            ->assertSuccessful()
            ->assertSee($subject->subject_name);
    }

    public function test_store_works() {
        Classes::factory()->create();
        $data = Subject::factory()->make()->toArray();

        $this->post(route('subjects.store'),$data)
            ->assertSuccessful()
            ->assertJsonMissingValidationErrors();
    }

    public function test_update_works() {
        Classes::factory()->create();
        $subject = Subject::factory()->create(['subject_name' => 'subject one']);
        $data = Subject::factory()->make(['subject_name' => 'subject two'])->toArray();

        $this->put(route('subjects.update',$subject),$data)
            ->assertSuccessful()
            ->assertJsonMissingValidationErrors();
    }

    public function test_destroy_works() {
        Classes::factory()->create();

        $subject = Subject::factory()->create();

        $this->delete(route('subjects.destroy',$subject));

        $this->assertDatabaseMissing(Subject::class,$subject->toArray());
    }

    public function test_attach_teacher_works() {
        $teacher = Teacher::factory()->create();

        Classes::factory()->create();

        $subject = Subject::factory()->create();

        $this->post(route('subjects.attachTeacher',$subject),['teachers' => $teacher->id])
        ->assertSessionHasNoErrors();

        $this->assertDatabaseHas(SubjectTeacher::class,[
            'teacher_id' => $teacher->id,
            'subject_id' => $subject->id,
        ]);

        $this->get(route('subjects.show',$subject))
            ->assertSee($teacher->teacher_name);
    }

    public function test_detach_teacher_works() {
        $teacher = Teacher::factory()->create();

        Classes::factory()->create();

        $subject = Subject::factory()->create();

        SubjectTeacher::factory()->create([
            'teacher_id' => $teacher->id,
            'subject_id' => $subject->id
        ]);

        $this->post(route('subjects.detachTeacher',$subject),['teachers' => $teacher->id])
        ->assertSessionHasNoErrors();

        $this->assertDatabaseMissing(SubjectTeacher::class,[
            'teacher_id' => $teacher->id,
            'subject_id' => $subject->id,
        ]);
    }
}
