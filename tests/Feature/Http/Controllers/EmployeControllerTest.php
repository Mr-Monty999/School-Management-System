<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Employe;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->owner()->create());
    }

    public function test_index_works() {

        $employe = Employe::factory()->create();

        $this->get(route('employees.index'))
            ->assertSuccessful()
            ->assertSee($employe->employe_name);
    }

    public function test_create_works() {
        $this->get(route('employees.create'))
            ->assertSuccessful();
    }

    public function test_edit_works() {
        $employe = Employe::factory()->create();

        $this->get(route('employees.edit',$employe))
            ->assertSuccessful();
    }

    public function test_show_works() {
        $employe = Employe::factory()->create();

        $this->get(route('employees.show',$employe))
            ->assertSuccessful()
            ->assertSee($employe->employe_name);
    }

    public function test_store_works() {
        $employe = Employe::factory()->make()->toArray();

        $this->post(route('employees.store',$employe))
            ->assertSuccessful()
            ->assertJsonMissingValidationErrors();
    }

    public function test_update_works() {
        $employe = Employe::factory()->create();

        $data = Employe::factory()
            ->make(['user_id' => $employe->user_id])
            ->toArray();

        $this->put(route('employees.update',$employe),$data)
            ->assertSuccessful()
            ->assertJsonMissingValidationErrors();
    }

    public function test_destroy_works() {
        $employe = Employe::factory()->create();

        $this->delete(route('employees.destroy',$employe));

        $this->assertSoftDeleted($employe);
    }

    public function test_destroy_all_works() {
        $employees = Employe::factory(2)->create();

        $this->post(route('employees.destroy.all'));

        $this->assertSoftDeleted($employees[0]);
        $this->assertSoftDeleted($employees[1]);
    }
}
