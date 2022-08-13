<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\User;
use App\Models\Classes;
use App\Models\Parents;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\TeacherSubject;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClassesControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->owner()->create());
    }

    public function test_index_works() {
        $class = Classes::factory()->create();

        $this->get(route('classes.index'))
            ->assertSuccessful()
            ->assertSee($class->class_name);
    }

    public function test_edit_works() {
        $class = Classes::factory()->create();

        $this->get(route('classes.edit',$class))
            ->assertSuccessful();
    }

    public function test_show_works() {
        $class = Classes::factory()->create();

        $this->get(route('classes.show',$class))
            ->assertSuccessful()
            ->assertSee($class->class_name);
    }

    public function test_store_works() {
        $data = ['class_name' => 'class one'];

        $this->post(route('classes.store'),$data)
            ->assertSuccessful()
            ->assertJsonMissingValidationErrors();
    }

    public function test_update_works() {
        $data = ['class_name' => 'class one'];

        $class = Classes::factory()->create();

        $this->put(route('classes.update',$class),$data)
            ->assertSuccessful()
            ->assertJsonMissingValidationErrors();
    }

    public function test_change_student_class_works() {
        [$classOne , $classTwo] = Classes::factory(2)->create();
        Parents::factory()->create();
        $student = Student::factory()->create(['class_id' => $classOne->id]);

        $this->post(route('classes.changeStudentClass'),[
            'ids' => $student->id,
            'class_id' => $classTwo->id
        ])
            ->assertRedirect();

        $student->refresh();

        $this->assertEquals($student->class_id,$classTwo->id);
    }

    public function test_change_multiple_students_class_works() {
        $classes = Classes::factory(2)->create();
        Parents::factory()->create();
        $students = Student::factory(2)->create(['class_id' => $classes[0]->id]);

        $this->post(route('classes.changeStudentClass'),[
            'ids' => $students->pluck('id')->toArray(),
            'class_id' => $classes[1]->id
        ])
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $students[0]->refresh();
        $students[1]->refresh();

        $this->assertEquals($students[0]->class_id,$classes[1]->id);
        $this->assertEquals($students[1]->class_id,$classes[1]->id);
    }

    public function test_add_subject_to_class_works() {
        $class = Classes::factory()->create();

        $teachers = Teacher::factory(2)->create();

        $this->post(route('classes.addSubjectToClass'),[
            'class_id' => $class->id,
            'subject_name' => 'Subject one',
            'teachers' => $teachers->pluck('id')->toArray()
        ])
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertDatabaseHas(Subject::class,[
            'subject_name' => 'Subject one',
            'class_id' => $class->id
        ]);

    }
}
