<?php

namespace App\Interfaces;

interface ProductInterface 
{
    public function listAll();
    public function categoryList();
    public function subCategoryList();
    public function collectionList();
    public function listById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function toggle($id);
    public function delete($id);
}