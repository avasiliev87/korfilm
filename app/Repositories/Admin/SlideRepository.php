<?php

namespace App\Repositories\Admin;

use App\Models\Slide;
use App\Repositories\BaseRepository;

class SlideRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'image_url',
        'title',
        'description',
        'link_text',
        'link_url',
        'style'
    ];

    public function model()
    {
        return Slide::class;
    }
}
