<?php

use App\Models\Specialties;

uses(Tests\TestCase::class, RefreshDatabase::class);

test('creacion de especialidad en memoria', function () {
    $specialty = Specialties::create([
        'name' => 'Gastroenterologo',
        'description' => 'Revisa el sistema gastrico'
    ]);
    expect($specialty->name)->toBe('Gastroenterólogo');
    expect($specialty->description)->toBe('Revisa el sistema gástrico');
});
