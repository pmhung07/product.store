<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupon';

    protected $guarded = ['id'];

    const VALUE_IS_PERCENT = 1;
    const VALUE_IS_VALUE = 2;

    // Áp dụng cho 1 hoặc nhiều sản phẩm
    const TYPE_PRODUCT = 1;

    // Áp dụng cho nhóm sản phẩm
    const TYPE_PRODUCT_GROUP = 2;

    // Áp dụng cho toàn bộ đơn hàng
    const TYPE_ORDER_VALUE = 3;

    public function getId()
    {
        return $this->id;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getType()
    {
        return $this->type;
    }

    static function types() {
        return [
            self::TYPE_PRODUCT => 'Áp dụng cho 1 hoặc nhiều sản phẩm đơn lẻ',
            self::TYPE_PRODUCT_GROUP  => 'Áp dụng cho 1 hoặc nhiều nhóm sản phẩm',
            self::TYPE_ORDER_VALUE    => 'Áp dụng cho giá trị đơn hàng',
        ];
    }

    static function typeValues() {
        return [
            self::VALUE_IS_PERCENT => 'Giảm giá theo %',
            self::VALUE_IS_VALUE   => 'Giảm giá theo giá trị'
        ];
    }

    static function type2Text($type) {
        $types = self::types();
        if( array_key_exists( $type , $types ) ) {
            return $types[$type];
        }
    }

    static function typeValue2Text($type) {
        $types = self::typeValues();
        if( array_key_exists( $type , $types ) ) {
            return $types[$type];
        }
    }


    public function decodeData()
    {
        return unserialize($this->data);
    }
}
