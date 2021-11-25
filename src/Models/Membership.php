<?php

namespace App\Models;

use App\Helpers\Membership as TheMembership;

class Membership extends TheMembership
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
}
