<?php

namespace App\Interfaces;

interface PromotionRepositoryInterface 
{

    // index promotion
    public function index();

    // store promotion 
    public function store($request);

    // create promotion management
    public function create();

    // destory promotion 
    public function destory($request);


}