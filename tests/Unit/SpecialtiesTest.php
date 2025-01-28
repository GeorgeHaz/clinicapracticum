<?php

use App\Models\Specialties;
use Illuminate\Foundation\Testing\RefreshDatabase;


uses(Tests\TestCase::class, RefreshDatabase::class);

test('creacion de especialidad en memoria', function () {
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
});
