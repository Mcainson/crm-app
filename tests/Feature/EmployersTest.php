<?php

namespace Tests\Feature;

use App\Models\Employer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Company;


class EmployersTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */
    public function only_authenticated_user_can_view_company_list()
    {
        $this->json('GET', 'api/employers')->assertStatus(401);
    }

    /** @test */
    public function a_user_can_create_an_employer()
    {
     //   $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create(), 'sanctum');
        $company_id = Company::factory()->create()->id;
        $attributes = [
            'firstname' => $this->faker->name(),
            'lastname' => $this->faker->name(),
            'email' => $this->faker->unique()->email,
            'phone' => $this->faker->numerify('##########'),
            'company_id' => $company_id
        ];
       // dd($attributes);
        $response = $this->json('POST', 'api/employers', $attributes);
        $response->assertStatus(200);
    }

    /** @test */
    public function a_user_can_update_an_employer()
    {
      //  $this->withoutExceptionHandling();
        $employer = Employer::factory()->create();
        $this->actingAs(User::factory()->create(), 'sanctum');
        $attributes = Employer::factory()->create()->toArray();
        $response = $this->json('PUT', 'api/employers/' . $employer->id, $attributes);
        //  $fileName = Str::slug($attributes['name'], '_') . '_logo.' . $file->extension();
        $response->assertStatus(200);
    }

    /** @test */
    public function a_user_can_delete_an_employer()
    {
        $this->withoutExceptionHandling();
        $employer = Employer::factory()->create();
        $this->actingAs(User::factory()->create(), 'sanctum');

        $response = $this->json('DELETE', 'api/employers/' . $employer->id);
        $response->assertStatus(200);
    }

    /** @test */
    public function a_user_can_view_an_employer()
    {
        $this->withoutExceptionHandling();
        $employer = Employer::factory()->create();
        $this->actingAs(User::factory()->create(), 'sanctum');

        $response = $this->json('GET', 'api/employers/' . $employer->id);
        $response->assertStatus(200);
    }

    /** @test */
    public function a_user_can_view_companies()
    {
        $employer = Employer::factory()->create();
        $this->actingAs(User::factory()->create(), 'sanctum');

        $response = $this->json('GET', 'api/employers/');

        $response->assertStatus(200);
    }

    /** @test */
    public function an_employer_requires_a_firstname()
    {
        $this->actingAs(User::factory()->create());
        $attributes = Employer::factory()->raw(['firstname' => '']);
        $response = $this->json('POST', 'api/employers', $attributes)->assertJsonValidationErrors(['firstname']);
    }

    /** @test */
    public function an_employer_requires_a_lastname()
    {
        $this->actingAs(User::factory()->create());
        $attributes = Employer::factory()->raw(['lastname' => '']);
        $response = $this->json('POST', 'api/employers', $attributes)->assertJsonValidationErrors(['lastname']);
    }

    /** @test */
    public function an_employer_requires_a_company()
    {
        $this->actingAs(User::factory()->create());
        $attributes = Employer::factory()->raw(['company_id' => '']);
        $response = $this->json('POST', 'api/employers', $attributes)->assertJsonValidationErrors(['company_id']);
    }

}
