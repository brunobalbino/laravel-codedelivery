<?php

namespace CodeDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Order extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'client_id',
        'user_deliveryman_id',
        'total',
        'status',
        'cupom_id'
    ];
    
    public function transform(){
        return [
            'order' => $this->id,
            'order_items' => $this->items
        ];
    }

    public function client()
    {
        return $this->belongsTo(client::class);
    }

    public function cupom()
    {
        return $this->belongsTo(cupom::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function deliveryman()
    {
        return $this->belongsTo(User::class, 'user_deliveryman_id', 'id');
    }

}
