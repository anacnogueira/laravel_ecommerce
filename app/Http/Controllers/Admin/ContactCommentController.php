<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CommentService;
use App\Services\CustomerService;
use App\Services\ProductService;
use App\Http\Requests\AdminStoreUpdateCommentRequest;

class ContactCommentController extends Controller
{
    protected $CommentService;
    protected $customerService;
    protected $productService;

    public function __construct(
        CommentService $commentService,
        CustomerService $customerService,
        ProductService $productService
        )
    {
        $this->commentService = $commentService;
        $this->customerService = $customerService;
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($contactId)
    {

        $customer = $this->customerService->getCustomerById($contactId);

        $comments = $this->commentService->getAllCommentsByContactId($contactId);

        return view('admin.contact-comments.index', compact('comments','customer'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($contactId)
    {
        $customer = $this->customerService->getCustomerById($contactId);

        $comment = new \stdClass();
        $comment->name = $customer->name;
        $comment->email = $customer->email;

        $products = $this->productService->getProductToSelect();

        return view('admin.contact-comments.create', compact('comment','customer','products'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminStoreUpdateCommentRequest $request, $contactId)
    {
        $data = $request->all();
        $data["ip"] = '';

        $comment = $this->commentService->makeComment($data);

        return redirect()->route('admin.customers.comments.index', $contactId);
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($contactId, $id)
    {
        $comment = $this->commentService->getCommentById($id);
        $comment->status = $comment->status == 'S' ? 'Ativo' : 'Inativo';

        return view('admin.contact-comments.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($contactId, $id)
    {
        $customer = $this->customerService->getCustomerById($contactId);
        $comment = $this->commentService->getCommentById($id);
        $products = $this->productService->getProductToSelect();

        return view('admin.contact-comments.edit', compact('customer', 'comment', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminStoreUpdateCommentRequest $request, $contactId, $id)
    {
        $data = $request->all();

        $comment = $this->commentService->updateComment($id, $data);

        return redirect()->route('admin.customers.comments.index', $contactId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $contactId, $id)
    {
         $comment = $this->commentService->destroyComment($id);

        return redirect()->route('admin.customers.comments.index', $contactId);
    }
}
