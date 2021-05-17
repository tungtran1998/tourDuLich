<?php

namespace App\Repositories;

use App\Repositories\EloquentInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;
abstract class EloquentRepository implements EloquentInterface
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $_model;

    /**
     * EloquentRepository constructor.
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * get model
     * @return string
     */
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->_model = app()->make(
            $this->getModel()
        );
    }

    /**
     * Get All
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return $this->_model->where('isdeleted',false)->orderBy('created_at', 'desc')->get();
    }

    /**
     * Get pluck with name and id
     * @param $id, $name
     * @return
     */
    public function getPluck($name, $id)
    {
        return $this->_model::where('isdeleted', false)->get()->pluck($name, $id);
    }
    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $result = $this->_model->where('isdeleted',false)->findOrfail($id);
        return $result;
    }

    public function findCreatedBy($id)
    {
        $result = Admin::findOrfail($id);
        return $result;
    }


    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->_model->create($attributes);
    }

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update($id, array $attributes)
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    /**
     * Delete
     *
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->isdeleted = true;
            $result->update();
            return true;
        }

        return false;
    }

}