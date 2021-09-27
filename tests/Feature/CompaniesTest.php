<?php

namespace Tests\Feature;

use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CompaniesTest extends TestCase
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
        $this->json('GET','api/companies')->assertStatus(401);
    }

    /** @test */
    public function a_user_can_create_a_company()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create(), 'sanctum');
        $file = UploadedFile::fake()->image('avatar.jpg', 100, 100);

        $attributes = [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'logo' => $file,
            'website' =>  $this->faker->url(),
        ];
        $response = $this->json('POST','api/companies', $attributes);
      //  $fileName = Str::slug($attributes['name'], '_') . '_logo.' . $file->extension();
        $response->assertStatus(200);
    }

    /** @test */
    public function a_user_can_update_a_company()
    {
        $this->withoutExceptionHandling();
        $company = Company::factory()->create();
        $this->actingAs(User::factory()->create(), 'sanctum');
        $file = UploadedFile::fake()->image('avatar.jpg', 100, 100);

        $attributes = [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'logo' => $file,
            'website' =>  $this->faker->url(),
            '_method' => 'PUT'
        ];
        $response = $this->json('POST', 'api/companies/'.$company->id, $attributes);
        //  $fileName = Str::slug($attributes['name'], '_') . '_logo.' . $file->extension();
        $response->assertStatus(200);
    }

    /** @test */
    public function a_user_can_delete_a_company()
    {
        $this->withoutExceptionHandling();
        $company = Company::factory()->create();
        $this->actingAs(User::factory()->create(), 'sanctum');
        
        $response = $this->json('DELETE', 'api/companies/' . $company->id);
        //  $fileName = Str::slug($attributes['name'], '_') . '_logo.' . $file->extension();
        $response->assertStatus(200);
    }

    /** @test */
    public function a_user_can_view_a_company()
    {
        $this->withoutExceptionHandling();
        $company = Company::factory()->create();
        $this->actingAs(User::factory()->create(), 'sanctum');

        $response = $this->json('GET', 'api/companies/' . $company->id);
        //  $fileName = Str::slug($attributes['name'], '_') . '_logo.' . $file->extension();
        $response->assertStatus(200);
    }

    /** @test */
    public function a_user_can_view_companies()
    {
        $company = Company::factory()->create();
        $this->actingAs(User::factory()->create(), 'sanctum');

        $response = $this->json('GET', 'api/companies/');
        //  $fileName = Str::slug($attributes['name'], '_') . '_logo.' . $file->extension();
        $response->assertStatus(200);
    }

    /** @test */
    public function a_company_requires_a_name()
    {
        $this->actingAs(User::factory()->create());
        $attributes = Company::factory()->raw(['name' => '']);
        $response = $this->json('POST', 'api/companies', $attributes)->assertJsonValidationErrors(['name']);
    }

    /** @test */
    public function a_company_requires_a_valid_email()
    {
        $this->actingAs(User::factory()->create());
        $attributes = Company::factory()->raw(['email' => '']);
        $response = $this->json('POST', 'api/companies', $attributes)->assertJsonValidationErrors(['email']);
    }

    /** @test */
    public function a_company_requires_a_valid_logo()
    {
        $this->actingAs(User::factory()->create());
        $attributes = Company::factory()->raw(['logo' => '']);
        $response = $this->json('POST', 'api/companies', $attributes)->assertJsonValidationErrors(['logo']);
    }
}
