<?php

test('debug current env', function () {
    expect(app()->environment('testing'))->toBeTrue();
});