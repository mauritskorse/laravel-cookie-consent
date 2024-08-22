<?php

use Whitecube\LaravelCookieConsent\Concerns\HasRejectionCallback;

it('can define a rejection callback', function () {
    $instance = new class() {
        use HasRejectionCallback;
    };

    expect($instance->hasRejectionCallback())->toBeFalse();
    $instance->rejected(fn() => true);
    expect($instance->hasRejectionCallback())->toBeTrue();
});
