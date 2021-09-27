<?php

namespace Tests\Unit;

use App\Models\Employer;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    /** @test */
    public function a_employer_belong_to_a_company()
    {
        $employer = Company::factory()->create();
        $this->assertInstanceOf(Collection::class, $employer->employers);
    }
}
