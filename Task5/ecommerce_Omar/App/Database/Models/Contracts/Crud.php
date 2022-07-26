<?php namespace App\Database\Models\Contracts;

interface Crud
{
    function create();
    function read();
    function update();
    function delete();
}
