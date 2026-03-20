<?php

namespace App\Support;

use App\Models\Batch;
use App\Models\Semester;
use App\Models\Config;
use App\Models\Programme;

class NkaHelper
{

 /**
 * Generates a unique batch code for the given Config model or config ID.
 * Accepts either a Config instance or an integer ID, and returns the next available code.
 * Returns null if the config is not found or invalid.
 */
    public static function generateBatchCode(Config|int $config): string
    {
        if (is_int($config)) {
            $config = Config::find($config);

            if (!$config) {
                throw new \InvalidArgumentException('Config ID not found.');
            }
        }

        if (!$config instanceof Config) {
            throw new \InvalidArgumentException('Expected a Config model or config ID.');
        }

        $base = $config->code;
        $count = Batch::where('code', 'like', "{$base}_B%")->count();
        $nextNumber = $count + 1;

        return "{$base}_B{$nextNumber}";
    }



    /**
     * Retrieves the starting RQF level ID of a given Programme.
     * Accepts either a Programme model instance or its integer ID.
     * Throws an exception if the programme is not found or invalid.
     */
    public static function findStartingLevelOfProgramme(Programme|int $programme)
    {
        if (is_int($programme)) {
            $programme = Programme::find($programme);

            if (!$programme) {
                throw new \InvalidArgumentException('Programme ID not found.');
            }
        }

        if (!$programme instanceof Programme) {
            throw new \InvalidArgumentException('Expected a Config model or programme ID.');
        }

        return $programme->starting_level_id;

    }


    /**
     * Retrieves the highest RQF level offered by the given Programme.
     * Accepts either a Programme model instance or its integer ID.
     * Throws an exception if the programme is not found or invalid.
     */
    public static function findOfferingLevelOfProgramme(Programme|int $programme)
    {
        if (is_int($programme)) {
            $programme = Programme::find($programme);

            if (!$programme) {
                throw new \InvalidArgumentException('Programme ID not found.');
            }
        }

        if (!$programme instanceof Programme) {
            throw new \InvalidArgumentException('Expected a Config model or programme ID.');
        }

        return $programme->offered_level_id;

    }


}