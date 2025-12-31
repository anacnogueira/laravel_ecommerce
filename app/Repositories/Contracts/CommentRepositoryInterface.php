<?php

namespace App\Repositories\Contracts;

use App\Models\Comment;

interface CommentRepositoryInterface
{
    public function getAllComments();
    public function getCommentById($id);
    public function createComment(array $data);
    public function updateComment(Comment $comment, array $data);
    public function destroyComment(Comment $comment);
}
