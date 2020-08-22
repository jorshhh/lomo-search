<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;
use App\Traits\LomoIndexed;
use Laravel\Scout\Searchable;

class Camera extends Model
{
    use LomoIndexed;
    use Searchable;

    function __construct() {
        $this->endpoint = "http://api.lomography.com/v1/cameras";
        $this->key = "cameras";
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize array...

        return $array;
    }

}
