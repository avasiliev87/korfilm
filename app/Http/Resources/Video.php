<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Video as VideoResource;
use App\Http\Resources\Category as CategoryResource;
use App\Http\Resources\SeriesShort as SeriesShortResource;
use App\Models\Series;
class Video extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id"=> $this->id,
						"name"=> $this->name,
						"description"=> $this->description,
						"slug"=> $this->slug,
						"duration"=> $this->duration,
						"width"=> $this->width,
						"height"=> $this->height,
						"type"=> $this->type,
						"status"=> $this->status,
						"featured_image_url"=> $this->featured_image_url(),
						"featured_video"=> new VideoResource(Video::find($this->featured_video_id)),
						"vimeo_video_id"=> $this->vimeo_video_id,
						"thumbnail_url"=> $this->thumbnail_url,
						"uri"=> $this->uri,
						"embed"=> $this->embed,
						"categories" => $this->categories()->pluck('slug'),
						"groups" => $this->groups()->pluck('slug'),
						"series" => new SeriesShortResource(Series::find($this->series_id)),
						"tags" => $this->tagged->pluck('tag_slug'),
						"views" => $this->getUniqueViews()
        ];
    }
}