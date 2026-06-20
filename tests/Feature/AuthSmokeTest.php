<?php

it('loads the staff login page', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});
