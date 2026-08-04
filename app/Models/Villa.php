<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'slug', 'short_description', 'base_price_idr', 'max_occupants_pax', 'bedrooms', 'bathrooms', 'area_sqm', 'location_district', 'google_maps_url'])]
class Villa extends Model
{
    //
}
