<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';

    protected $fillable = ['id', 'customer_id', 'payment_method_id','channel_id', 'code', 'order_status','lading_status', 'total_price', 'created_at'];

    public $timestamps = true;

    const STATUS_WAITING   = 0; // Chờ duyệt
    const STATUS_CHECKED   = 1; // Đã duyệt
    const STATUS_TRANSPORT = 2; // Vận đơn
    const STATUS_SUCCESS   = 3; // Hoàn thành
    const STATUS_CANCEL    = 4; // Hủy
    const STATUS_VIRTUAL   = 5; // Ảo
    const STATUS_REFUN     = 6; // Trả hàng

    const PAYMENT_STATUS_WAITING = 0; // Chờ xử lý
    const PAYMENT_STATUS_SUCCESS = 1; // Thanh toán
    const PAYMENT_STATUS_UNPAID = 2; // Chưa thanh toán

    public function product(){
		return $this->belongsToMany('App\Product');
	}
	//note
	public function customers(){
		return $this->belongsTo('App\Customers','customer_id');
	}

	public function payment_methods(){
		return $this->belongsTo('App\PaymentMethods');
	}

	public function channel(){
		return $this->belongsTo('App\Channel');
	}

    static function generateCode() {
        return 'MDH/'.date('dmYhis');;
    }
}
