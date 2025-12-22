<?php

use App\Livewire\Pages\Landing;
use App\Models\Gallery;
use Livewire\Livewire;

test('landing page loads successfully', function () {
    $response = $this->get('/');

    $response->assertSuccessful();
});

test('landing page only displays fish galleries', function () {
    // Create galleries with different categories
    $fishGallery = Gallery::factory()->create([
        'title' => 'Beautiful Betta',
        'category' => 'fish',
        'is_active' => true,
        'order' => 1,
    ]);

    $farmGallery = Gallery::factory()->create([
        'title' => 'Our Farm',
        'category' => 'farm',
        'is_active' => true,
        'order' => 2,
    ]);

    $qualityGallery = Gallery::factory()->create([
        'title' => 'Quality Control',
        'category' => 'quality',
        'is_active' => true,
        'order' => 3,
    ]);

    Livewire::test(Landing::class)
        ->assertSee($fishGallery->title)
        ->assertDontSee($farmGallery->title)
        ->assertDontSee($qualityGallery->title);
});

test('landing page respects gallery active status for fish', function () {
    $activeFish = Gallery::factory()->create([
        'title' => 'Active Fish',
        'category' => 'fish',
        'is_active' => true,
        'order' => 1,
    ]);

    $inactiveFish = Gallery::factory()->create([
        'title' => 'Inactive Fish',
        'category' => 'fish',
        'is_active' => false,
        'order' => 2,
    ]);

    Livewire::test(Landing::class)
        ->assertSee($activeFish->title)
        ->assertDontSee($inactiveFish->title);
});

test('landing page limits fish galleries to 8 items', function () {
    // Create 10 fish galleries
    Gallery::factory()->count(10)->create([
        'category' => 'fish',
        'is_active' => true,
    ]);

    $component = Livewire::test(Landing::class);
    $galleries = $component->viewData('galleries');

    expect($galleries)->toHaveCount(8);
});

test('landing page orders fish galleries by order field', function () {
    $gallery1 = Gallery::factory()->create([
        'title' => 'Third Gallery',
        'category' => 'fish',
        'is_active' => true,
        'order' => 3,
    ]);

    $gallery2 = Gallery::factory()->create([
        'title' => 'First Gallery',
        'category' => 'fish',
        'is_active' => true,
        'order' => 1,
    ]);

    $gallery3 = Gallery::factory()->create([
        'title' => 'Second Gallery',
        'category' => 'fish',
        'is_active' => true,
        'order' => 2,
    ]);

    $component = Livewire::test(Landing::class);
    $galleries = $component->viewData('galleries');

    expect($galleries->first()->title)->toBe('First Gallery')
        ->and($galleries->last()->title)->toBe('Third Gallery');
});
