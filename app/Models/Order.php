<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class Order extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'orders';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const PAYMENT_METHOD_SELECT = [
        'option-cash'           => 'Cash',
        'option-app-wallet'     => 'App wallet',
        'option-card'           => 'Card',
        'option-digital-wallet' => 'Digital Wallet',
    ];

    const STATUS_SELECT = [
        'option_pending'    => 'Pending',
        'option_processing' => 'Processing',
        'option_completed'  => 'Completed',
        'option_cancelled'  => 'Cancelled',
        'option_refunded'   => 'Refunded',
    ];

    protected $fillable = [
        'client_id',
        'address_id',
        'product_id',
        'number_of_product',
        'payment_method',
        'tax_id',
        'delivery_fee_id',
        'status',
        'total_amount',
        'note',
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

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function address()
    {
        return $this->belongsTo(ClientAddress::class, 'address_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function tax()
    {
        return $this->belongsTo(TaxValue::class, 'tax_id');
    }

    public function delivery_fee()
    {
        return $this->belongsTo(DeliveryFee::class, 'delivery_fee_id');
    }
}
