<?php

namespace App\Enums;

enum PhaseType: string
{
    case PENDING = 'pending';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';

    /**
     * Get a list of statuses as key-value pairs.
     *
     * @return array
     */
    public static function getPhaseList(): array
    {
        $list = [];
        foreach (self::cases() as $case) {
            $list[$case->value] = $case->value; // or $case->value if you want the value as the label
        }
        return $list;
    }
}
