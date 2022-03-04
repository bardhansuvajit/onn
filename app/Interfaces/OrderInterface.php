<?php

namespace App\Interfaces;

interface OrderInterface 
{
    public function listAll();
    public function listById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function toggle($id, $status);
    // public function delete($id);
}