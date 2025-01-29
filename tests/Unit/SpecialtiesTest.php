<?php

namespace Tests\Unit;

use App\Models\Specialties;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SpecialtiesTest extends TestCase
{
    use RefreshDatabase;

    public function test_crear_especialidad()
    {
        $specialty = Specialties::create([
            'name' => 'Gastroenterologo',
            'description' => 'Revisa el sistema gastrico'
        ]);
        expect($specialty->name)->toBe('Gastroenterologo');
        expect($specialty->description)->toBe('Revisa el sistema gastrico');
    
        $this->assertDatabaseHas('specialties', [
            'name' => 'Gastroenterologo',
            'description' => 'Revisa el sistema gastrico',
        ]);
    }
}
