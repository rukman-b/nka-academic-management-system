<?php

it('runs in the testing environment', function () {
    expect(app()->environment())->toBe('testing');
});
