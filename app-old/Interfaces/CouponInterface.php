<?php

namespace App\Interfaces;

interface CouponInterface
{
    public function listAll();
    public function getSearchCoupons(string $term);
    public function listById($id);
    public function usageById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function toggle($id);
    public function delete($id);
}