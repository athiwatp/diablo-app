<?php

namespace App\Traits;

use Carbon\Carbon;

trait Queueable
{
    /**
     * @return bool
     */
    public function setQueuable()
    {
        if (is_null($this->queued_at)) {
            $this->queuable = true;
        } else {
            $this->queuable = $this->queued_at
                ->addHours(12)
                ->lte(Carbon::now());
        }

    }

    /**
     * Set available in dynamic attribute
     */
    public function setAvailableIn()
    {
        if (is_null($this->queued_at)) {
            $this->available_in = null;
        } else {
            $available = $this->queued_at->addHours(12)
                ->lte(Carbon::now());

            $this->available_in = $available
                ? null
                : $this->queued_at->addHours(12)
                    ->diffForHumans();
        }
    }
}