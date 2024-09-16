<?php

namespace App\Interfaces;

interface LibraryRepositoryInterface 
{

    // index  Library
    public function index();

    // create  Library
    public function create();

    // store  Library
    public function store($request);

    // edit  Library
    public function edit($id);

    // update  Library
    public function update($request);

    // download Attachment
    public function downloadAttachment($filename);
}