<?php

namespace App\Ads\Domain\Resources;

use Illuminate\Container\Container;
use App\App\Domain\Resources\CollectionBaseResource;

class AdResourceCollection extends CollectionBaseResource
{
    public $a;
    public function __construct()
    {
        // $this->a = $a;
        parent::attributes(['sa' => 'dsfasdf']);
    }
    
    
   
    // This is intentionally empty
}
