<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminStatusChangeRequest;
use Illuminate\Support\Facades\DB;


class StatusController extends Controller
{
    public function change(AdminStatusChangeRequest $request)
    {
        $table = $request->input("table");
        $status = $request->input("status");
        $id = $request->input("id");
        DB::transaction(function () use ($table, $status, $id) {
            DB::update("UPDATE $table SET status = '$status' WHERE id = $id");   
        });

        return response()->json([
            'status' => $status,
        ]);
    }
}
