<?php

namespace Nht\Hocs\Core;

use Nht\Http\Requests\Request;

/**
 * An abstract class for repository.
 *
 * @author	AlvinTran
 */
abstract class BaseRepository
{
	/**
	 * Get all items of model
	 * @return Illuminate\Support\Collection Model collections
	 */
	public function getAll()
	{
		return $this->model->all();
	}

	/**
	 * Get item of model. If model not exist then it will throw an exception
	 * @param  int $id Model ID
	 * @return Model
	 */
	public function getById($id)
	{
		return $this->model->findOrFail($id);
	}

	/**
	 * Get item of model
	 * @param  int $id Model ID
	 * @return Model
	 */
	public function find($id)
	{
		return $this->model->find($id);
	}

	/**
	 * Get items with filter & paginate
	 * @param  array  $filter
	 * @param  integer $pageSize
	 * @return Illuminate\Support\Collection Model collections
	 */
	public function getAllWithPaginate($filter = [], $pageSize = 20)
	{
		if ( ! empty($filter))
		{
			foreach ($filter as $key => $value)
			{
				if ($value == '')
				{
					unset($filter[$key]);
				}
			}
			return $this->model->where($filter)->paginate($pageSize);
		}
		return $this->model->paginate($pageSize);
	}

	/**
	 * Create a new model
	 * @param  array $attributes
	 * @return Bool
	 */
	public function create($attributes)
	{
		// $object = $this->getInstance();
		// foreach($attributes as $key => $value) {
		// 	$object->$key = $value;
		// }
		// if($object->save()) {
		// 	return $object;
		// }

		return $this->model->create($attributes);
	}

	/**
	 * Update an exitst model
	 * @param  array $attributes
	 * @param  array $condition
	 * @return Bool
	 */
	public function update($attributes, $condition = [])
	{
		if ( ! empty($condition))
		{
			return $this->model->where($condition)->update($attributes);
		}
		return $this->model->update($attributes);
	}

	/**
	 * Delete an exist model
	 * @return Bool
	 */
	public function delete($id)
	{
		$user = $this->getById($id);
		return $user->delete();
	}

	public function getInstance() {
		return new $this->model;
	}

	public function getModel()
	{
		return $this->model;
	}

	public function count() {
		return $this->model->count();
	}

	public function insert($data) {
		return $this->model->insert($data);
	}

	public function _getByIds(array $ids) {
		return $this->model->whereIn($this->model->getKeyName(), $ids)->get();
	}

	public function countByIds(array $ids) {
		return $this->model->whereIn($this->model->getKeyName(), $ids)->count();
	}
}
