<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $guarded = ['id'];

    // Trạng thái
    const ACTIVE   = 1;
    const DEACTIVE = 0;

    // Vị trí hiển thị.
    const POSITION_TOP    = 'top';
    const POSITION_RIGHT  = 'right';
    const POSITION_LEFT   = 'left';
    const POSITION_BOTTOM = 'bottom';
    const POSITION_TOP_RIGHT = 'top-right';
    const POSITION_TOP_LEFT = 'top-left';
    const POSITION_BOTTOM_LEFT = 'bottom-left';
    const POSITION_BOTTOM_RIGHT = 'bottom-right';
    const POSITION_CENTER_CENTER = 'center-center';
    const POSITION_CENTER_LEFT = 'center-left';
    const POSITION_CENTER_RIGHT = 'center-right';

    const PAGE_HOME = 'home';
    const PAGE_PRODUCT_DETAIL = 'product_detail';

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getTeaser() {
        return $this->teaser;
    }

    public function getPosition() {
        return $this->position;
    }

    public function getPage() {
        return $this->page;
    }

    public function getUrl()
    {
        return $this->link != null ? $this->link : '';
    }

    public function getLink() {
        return $this->getUrl();
    }

    public function getStatus()
    {
        return $this->status != null ? $this->status : 0;
    }

    public function getImage($value='')
    {
        return parse_image_url($this->image);
    }

    public function getImageAlt()
    {
        return $this->image_alt;
    }

    public function getSort()
    {
        return $this->sort;
    }

    public static function getPositionList() {
        return [
            self::POSITION_TOP           => 'Bên trên',
            self::POSITION_RIGHT         => 'Bên phải',
            self::POSITION_LEFT          => 'Bên trái',
            self::POSITION_BOTTOM        => 'Bên dưới',
            self::POSITION_TOP_RIGHT     => 'Phía trên bên phải',
            self::POSITION_TOP_LEFT      => 'Phía trên bên trái',
            self::POSITION_BOTTOM_LEFT   => 'Phía dưới bên trái',
            self::POSITION_BOTTOM_RIGHT  => 'Phía dưới bên phải',
            self::POSITION_CENTER_CENTER => 'Ở giữa',
            self::POSITION_CENTER_LEFT   => 'Ở giữa bên trái',
            self::POSITION_CENTER_RIGHT  => 'Ở giữa bên phải',
        ];
    }

    public static function getPageList() {
        return config('banner.pages');
    }
}
