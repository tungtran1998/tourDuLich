<?php

namespace App\Repositories;

interface EloquentInterface
{
    /**
     * Get all
     * @return mixed
     */
    public function getAll();

    /**
 	 * Get pluck with name and id
     * @return
     */
    public function getPluck($name, $id);
    
    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id);

    public function findCreatedBy($id);
    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, array $attributes);

    /**
     * Delete
     * @param $id
     * @return mixed
     */
    public function delete($id);
}