<?php

namespace App\Repositories;

use App\Repositories\Contracts\CommentRepositoryInterface;
use App\Models\Comment;

class CommentRepository implements CommentRepositoryInterface
{
    protected $entity;

    public function __construct(Comment $comment)
    {
        $this->entity = $comment;
    }

    /**
     * Get all Comments
     * @return array
     */
    public function getAllComments()
    {
        return $this->entity->all();
    }

    /**
     * Select Comment by ID
     * @param int $id
     * @return object
     */
    public function getCommentById($id)
    {
        return $this->entity->find($id);
    }

    /**
     * Create a new Comment
     * @param array $data
     * @return object
     */
    public function createComment(array $data)
    {
        return $this->entity->create($data);
    }

     /**
     * Update data of comment
     * @param object $comment
     * @param array $data
     * @return object
     */
    public function updateComment(Comment $comment, array $data)
    {
        return $comment->update($data);
    }

    /**
     * Delete a Comment
     * @param object $comment
     */
    public function destroyComment(Comment $comment)
    {
        return $comment->delete();
    }
}
