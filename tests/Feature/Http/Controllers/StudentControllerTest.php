<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\User;
use App\Models\Classes;
use App\Models\Parents;
use App\Models\Student;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Database\Seeders\PermissionsSeeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StudentControllerTest extends TestCase
{
    private $parent , $class;


    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->owner()->create());

        $this->parent = Parents::factory()->create();

        $this->class = Classes::factory()->create();

    }

    public function test_index_works() {

        $student = Student::factory()->create();

        $this->get(route('students.index'))
            ->assertSuccessful()
            ->assertSee($student->student_name);
    }

    public function test_create_works() {
        $this->get(route('subjects.create'))
            ->assertSuccessful();
    }

    public function test_edit_works() {
        $student = Student::factory()->create();

        $this->get(route('students.edit',$student))
            ->assertSuccessful();
    }

    public function test_show_works() {

        $student = Student::factory()->create();

        $this->get(route('students.show',$student))
            ->assertSuccessful()
            ->assertSee($student->student_name);
    }

    public function test_store_works() {

        $data = [
            'student_name' => 'Ashraf',
            'student_address' => 'Any Address',
            'student_birthdate' => '2022-08-10',
            'student_registered_date' => '2022-08-10',
            'student_paid_price' => '2200',
            'student_gender' => 'ذكر',
            'student_national_number' => '121212121212',
            'class_id' => (string)$this->class->id,
            'parent_name' => 'Abu Ashraf',
            'parent_job' => 'Developer',
            'parent_phone' => '2222222222',
            'parent_national_number' => '121212121212',
        ];

        $response = $this->post(route('students.store',$data))
            ->assertSuccessful()
            ->assertJsonMissingValidationErrors();

    }

    public function test_update_works() {

        $data = [
            'student_name' => 'Ashraf',
            'student_address' => 'Any Address',
            'student_birthdate' => '2022-08-10',
            'student_registered_date' => '2022-08-10',
            'student_paid_price' => 2200,
            'student_gender' => 'ذكر',
            'student_national_number' => 121212121212,
            'class_id' => $this->class->id,
            'parent_id' => $this->parent->id,
            'parent_name' => 'Abu Ashraf',
            'parent_job' => 'Developer',
            'parent_phone' => 2222222222,
            'parent_national_number' => 121212121212,
        ];
        $student = Student::factory()->create();

        $this->put(route('students.update',$student),$data)
            ->assertSuccessful()
            ->assertJsonMissingValidationErrors();
    }

    public function test_destory_works() {

        $student = Student::factory()->create(['user_id' => User::factory()->create()]);

        $this->delete(route('students.destroy',$student));

        $this->assertSoftDeleted($student);

        $this->assertSoftDeleted(User::withTrashed()->find($student->user_id));

    }

    public function test_destory_all_students_works() {

        Student::factory(2)->create();

        $this->assertDatabaseCount(Student::class,2)
            ->post(route('students.destroy.all'))
            ->assertSuccessful();

        $this->assertEmpty(Student::all()->toArray());
        $this->assertEmpty(User::has('student')->get());
    }
}
