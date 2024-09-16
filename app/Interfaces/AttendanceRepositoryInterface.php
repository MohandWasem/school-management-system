<?php

namespace App\Interfaces;

interface AttendanceRepositoryInterface 
{

    // get grades to attendance
    public function index();

    // show grades to attendance
    public function show($id);

    // store grades to attendance
    public function store($request);

}