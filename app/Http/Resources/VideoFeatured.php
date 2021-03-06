<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Video as VideoResource;
use App\Http\Resources\Category as CategoryResource;
use App\Http\Resources\SeriesShort as SeriesShortResource;
use App\Models\Series;
use Illuminate\Support\Facades\Auth;
class VideoFeatured extends JsonResource
{
    public function toArray($request)
    {
        return [
            "name"=> $this->name,
			"duration"=> $this->duration,
			"width"=> $this->width,
            "height"=> $this->height,
            "duration"=> $this->duration,
            "formatted_duration" => gmdate("H:i:s", $this->duration),
			"featured_image_url"=> $this->featured_image_url(),
			"embed"=> $this->embed,
        ];
    }
}