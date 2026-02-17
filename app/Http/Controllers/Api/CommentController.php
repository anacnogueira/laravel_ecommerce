<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Services\CommentService;
use App\Http\Requests\ApiRateCommentRequest;
use App\Http\Requests\ApiStoreCommentRequest;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function rate(ApiRateCommentRequest $request)
    {
        $data = $request->all();
        $data['ip'] = '';

        $response = $this->commentService->makeRate($data);

        return response()->json($response, 201);
    }

    public function store(ApiStoreCommentRequest $request)
    {
        $data = $request->all();
        $data["ip"] = '';
        $data["status"] = 'N';
        $data["contact_id"] = Auth::check() ? Auth::id() : null;

        $response = $this->commentService->makeCommentFromSite($data);

        if ($response['success']) {
            return response()->json($response, 201);
        }

        return response()->json($response, 500);

    }
}
