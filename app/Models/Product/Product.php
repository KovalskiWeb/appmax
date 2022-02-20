<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'sku',
        'title',
        'price',
        'stock',
        'active',
        'description',
        'added_via',
        'removed_via',
    ];

    protected $dates = ['deleted_at'];

    /**
     * Relationship with image
     */
    public function image()
    {
        return $this->hasOne(ImageProduct::class);
    }

    public function getAddedViaAttribute($value)
    {
        return ($value == 'system' ? 'Sistema' : 'API');
    }

    public function getActiveAttribute($value)
    {
        return ($value == 1 ? 'Ativo' : 'Inativo');
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = (!empty($value) ? floatval($this->convertStringToDouble($value)) : null);
    }

    public function getPriceAttribute($value)
    {
        if (empty($value)) {
            return null;
        }

        return number_format($value, 2, ',', '.');
    }

    private function convertStringToDouble($param)
    {
        if(empty($param)){
            return null;
        }

        return str_replace(',', '.', str_replace('.', '', $param));
    }
}
