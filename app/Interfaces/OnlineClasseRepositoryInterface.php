<?php

namespace App\Interfaces;

interface OnlineClasseRepositoryInterface 
{

    // index  onlline classes
    public function index();

    // create  onlline classes page
    public function create();

    // store  onlline classes page
    public function store($request);

    // destroy  onlline classes page
    public function destroy($request);

    // create offlineClasseCreate
    public function offlineClasseCreate();

    // Store offlineClasseCreate
    public function offlineClasseStore($request);

}