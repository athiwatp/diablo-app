<?php

namespace App\Traits;

use Carbon\Carbon;

trait Queueable
{
    /**
     * @return bool
     */
    public function getAvailability()
    {
        if (is_null($this->queued_at)) {
            $queueable = true;
        } else {
            $queueable = $this->queued_at
                ->addHours(12)
                ->lte(Carbon::now());
        
        }

        if (is_null($this->queued_at)) {
            $available_in = null;
        } else {
            $available = $this->queued_at->addHours(12)
                ->lte(Carbon::now());

            $available_in = $available
                ? null
                : $this->queued_at->addHours(12)
                    ->diffForHumans();
        }

        $this->queueable = $queueable;
        $this->available_in = $available_in;
    }
}