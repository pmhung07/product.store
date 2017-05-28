<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use App\Exceptions\CategoryCanNotBeParentItSelftException;
use App\Exceptions\SafeUpdateException;

/**
 * Các hàm phục vụ loại danh mục nói chung
 * Ví dụ: Danh mục sản phẩm, Danh mục tin tức, Menu đa cấp....
 */
trait CategoryTrait {

    public function safeUpdate(array $data, $id, Collection $categories) {
        // Lấy tất cả các con, cháu, chắt, chút, chít... của nó
        $childIds = $this->getChildRecursive($id, $categories)->keys()->toArray();

        // Nếu id cha mà trong list id con thì ko cho update
        $parentId = (int) array_get($data, 'parent_id');

        // Không thể chọn nó làm cha của chính nó
        if($parentId == $id) {
            throw new CategoryCanNotBeParentItSelftException("It can't be parent of it self", 1);
        }

        // Con nó không thể làm cha của nó
        if(in_array($parentId, $childIds)) {
            throw new SafeUpdateException("Child of category can't be the parent of category", 1);
        }

        $result = parent::update($data, ['id' => $id]);

        $this->optimizeCategories();

        return $result;
    }


    public function getChildRecursive($parentId, Collection $categories) {
        $this->childRecursive = new Collection;
        $this->_getChildRecursive($parentId, $categories);
        return $this->childRecursive;
    }


    /**
     *  Đệ quy tim các con của một danh mục
     * @param  integer     $parentId
     * @param  \Illuminate\Support\Collection $categories
     * @return \Illuminate\Support\Collection
     */
    private function _getChildRecursive($parentId, Collection $categories) {
        foreach($categories as $category) {
            if($category->parent_id == $parentId) {
                $this->childRecursive->put($category->getId(), $category);
                $this->_getChildRecursive($category->getId(), $categories);
            }
        }
    }

}