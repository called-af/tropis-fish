<?php

test('company profile page can be accessed', function () {
    $response = $this->get('/company-profile');

    $response->assertSuccessful();
});

test('company profile page displays correct content', function () {
    $response = $this->get('/company-profile');

    $response->assertSee('Company Profile')
        ->assertSee('Established in 1986')
        ->assertSee('Our Farm')
        ->assertSee('Quality Control');
});

test('company profile page displays all sections', function () {
    $response = $this->get('/company-profile');

    $response->assertSuccessful()
        ->assertSee('Company Profile')
        ->assertSee('Leading Ornamental Fish Exporter')
        ->assertSee('Our Farm')
        ->assertSee('Quality Control');
});

test('company profile page has proper meta structure', function () {
    $response = $this->get('/company-profile');

    $response->assertSuccessful()
        ->assertSee('Leading Ornamental Fish Exporter')
        ->assertSee('Established in 1986')
        ->assertSee('South East Asia, Middle East, Europe, and USA')
        ->assertSee('ornamental fishes, Invertebrates, and Aquatic Plants');
});
