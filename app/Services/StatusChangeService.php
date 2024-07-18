<?php
namespace App\Services;


class StatusChangeService
{
    
    public function returnStatusBullets($table, $status, $id)
    {
        return view("components.status-change", compact("table","status","id"));
    }

}