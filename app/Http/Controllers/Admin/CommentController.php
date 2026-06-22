<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CommentService;
use App\Services\ProductService;
use App\Http\Requests\AdminStoreUpdateCommentRequest;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(
        CommentService $commentService,
        ProductService $productService
    )
    {
        $this->commentService = $commentService;
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = $this->commentService->getAllComments();

        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $comment = null;

        $products = $this->productService->getProductsToSelect();

        return view('admin.comments.create', compact('comment', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminStoreUpdateCommentRequest $request)
    {
        $data = $request->all();
        $data["ip"] = $request->ip();

        $comment = $this->commentService->makeComment($data);

        return redirect()->route('admin.comments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $comment = $this->commentService->getCommentById($id);
        $comment->status = $comment->status == 'S' ? 'Ativo' : 'Inativo';

        return view('admin.comments.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $comment = $this->commentService->getCommentById($id);

        $products = $this->productService->getProductsToSelect();

        return view('admin.comments.edit', compact('comment', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminStoreUpdateCommentRequest $request, string $id)
    {
        $data = $request->all();

        $comment = $this->commentService->updateComment($id, $data);

        return redirect()->route('admin.comments.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = $this->commentService->destroyComment($id);

        return redirect()->route('admin.comments.index');
    }
}
