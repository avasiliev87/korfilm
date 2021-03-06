<?php
namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use CyrildeWit\EloquentViewable\Viewable;
class Series extends Model
{
    use SoftDeletes;
    use Sluggable;
    use Viewable;

    public $table = 'series';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    protected $appends = ['featured_image_url'];

    public $fillable = [
        'name',
        'description',
        'slug',
        'featured_image_id',
        'views_count',
        'views_count_last_7days',
        'views_count_last_30days',
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'slug' => 'string'
    ];

  
    public static $rules = [
       'name' => 'required' 
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function featured_image()
    {
        return $this->belongsTo('App\Models\Image', 'featured_image_id');
    }
    
    public function featured_image_url()
    {
        if ($this->featured_image)
        {
            return $this->featured_image->uri;
        }

        return null;
    }

    public function getFeaturedImageUrlAttribute()
    {
        return $this->featured_image_url();
    }

    public function videos()
    {
        return $this->hasMany('App\Models\Video');
    }
    
    public static function update_counter_cache()
    {
        foreach( Series::all() as $aseries )
        {
            $aseries->videos_count = $aseries->videos()->count();
            $aseries->save();
        }
    }
}
