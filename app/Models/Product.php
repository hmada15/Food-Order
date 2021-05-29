<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class Product extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'products';

    protected $appends = [
        'photo',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const IN_STOCK_RADIO = [
        'option-yes' => 'yes',
        'option-no'  => 'no',
    ];


    const IS_PUBLISH_RADIO = [
        'option-yes' => 'yes',
        'option-no'  => 'no',
    ];

    protected $fillable = [
        'name',
        'slug',
        'brand_id',
        'description',
        'regular_price',
        'sale_price',
        'sku',
        'in_stock',
        'is_publish',
        'category_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function tags()
    {
        return $this->belongsToMany(ProductTag::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function getPhotoAttribute()
    {
        $files = $this->getMedia('photo');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $files;
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function scopeIsPublish($query)
    {
        return $query->where('is_publish', 'option-yes');
    }
}
