<?php

namespace Whitecube\LaravelCookieConsent\Concerns;

use Closure;
use Illuminate\Support\Facades\App;
use Whitecube\LaravelCookieConsent\Consent;

trait HasRejectionCallback
{
    /**
     * The callback that should be called when consent is given.
     */
    protected ?Closure $rejectedCallback = null;

    /**
     * Set the cookie's rejection callback.
     */
    public function rejected(Closure $callback): static
    {
        $this->rejectedCallback = $callback;

        return $this;
    }

    /**
     * Check if there is a defined rejection callback.
     */
    public function hasRejectionCallback(): bool
    {
        return ! is_null($this->rejectedCallback);
    }

    /**
     * Check if there is a defined rejection callback.
     * We're using the Consent class to return the rejection result. (set cookie and script)
     */
    public function getRejectionResult(): Consent
    {
        $rejection = new Consent($this);

        App::call($this->rejectedCallback, ['rejection' => $rejection]);

        return $rejection;
    }
}
