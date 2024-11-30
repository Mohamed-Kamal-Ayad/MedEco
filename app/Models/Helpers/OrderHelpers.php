<?php

namespace App\Models\Helpers;

trait OrderHelpers
{
    /**
     * @return bool
     */
    public function isCompleted()
    {
        return $this->is_completed;
    }
}
