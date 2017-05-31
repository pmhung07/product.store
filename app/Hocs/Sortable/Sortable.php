<?php

namespace App\Hocs\Sortable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Sortable {

    /**
     * Original data
     * @var array
     */
    protected $originalData;


    /**
     * Temp data sorted
     * @var array
     */
    protected $tempData;


    /**
     * Data sorted
     * @var \Illuminate\Support\Collection
     */
    protected $data;


    /**
     * Optimize
     * @var boolean
     */
    protected $optimize;


    /**
     * Lấy dữ liệu sau khi được sắp xếp, có lựa chọn optimize hay không
     * Chọn optimize thì sắp xếp nhanh hơn thì nó sẽ kiểm tra trường has_child nếu có thì mới đệ quy
     *
     * Lần đầu chạy không nên chọn optimize vì lúc này trường has_child chưa được cập nhật
     *
     */
    public function __construct(Collection $originalData, $optimize = false)
    {
        $this->originalData = $originalData;
        $this->optimize = $optimize;
        $this->tempData = [];
    }


    public function getOriginalData()
    {
        return $this->originalData;
    }

    /**
     * Get temp data
     * @return array
     */
    public function getTempData()
    {
        return $this->tempData;
    }


    public function getOptimize()
    {
        return $this->optimize;
    }


    /**
     * Get data
     * @return \Illuminate\Support\Collection
     */
    public function getData()
    {
        // Đệ quy sắp xếp
        $this->sort($this->prepare(), 0, 0, $this->getOptimize());

        // Dữ liệu tạm
        $tempData = $this->getTempData();

        // Tạo collection
        $this->data = new Collection;

        // Convert to collection
        foreach($tempData as $category) {
            $this->data->push($category);
        }

        return $this->data;
    }


    /**
     * Chuẩn bị dữ liệu để đệ quy
     * @return array
     */
    public function prepare()
    {
        $_data = $this->getOriginalData();
        $data = [];
        foreach($_data as $c) {
            if($c->parent_id == 0) {
                $data[0][$c->id] = $c;
            }

            foreach($_data as $cc) {
                if($c->id == $cc->parent_id) {
                    $data[$c->id][$cc->id] = $cc;
                }
            }
        }

        return $data;
    }

    /**
     * Hàm đệ quy để lấy ra danh mục
     * @param  [type]  $data
     * @param  integer $parent
     * @param  boolean $list
     * @param  boolean $optimize
     * @return void
     */
    public function sort($data, $parent = 0, $level = 0, $optimize = false)
    {
        // Lặp qua mảng dữ liệu, đệ quy lần lượt để ghép cha và con lại gần nhau hơn
        if(array_key_exists($parent, $data)) {
            // Nếu nó có con, cháu, chắt thì tăng level lên
            $level ++;
            foreach ($data[$parent] as $key => $category) {
                if ($category['parent_id'] == $parent) {
                    $category['level'] = $level;
                    $this->tempData[] = $category;
                    if($optimize) {
                        if($category->has_child) {
                            $this->sort($data, $category['id'], $level, $optimize);
                        }
                    } else {
                        $this->sort($data, $category['id'], $level, $optimize);
                    }
                }
            }
        }
    }
}