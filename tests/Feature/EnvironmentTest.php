<?php

test('debug current env', function () {
    dump(app()->environment());
    expect(app()->environment('testing'))->toBeTrue();
});