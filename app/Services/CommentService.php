<?php

namespace App\Services;

use App\Repositories\Contracts\CommentRepositoryInterface;

class CommentService
{
    protected $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * Select all comments
     * @return array
    */
    public function getAllComments()
    {
        return $this->commentRepository->getAllComments();
    }

     /**
     * Create a new comment
     * @param array $data
     * @return object
    */
    public function makeComment(array $data)
    {
        $data["status"] = isset($data["status"]) ? 'S' : 'N';

        $comment = $this->commentRepository->createComment($data);

        return $comment;
    }

    /**
     * Get Comment by  ID
     * @param int $id
     * @return object
    */
    public function getCommentById(int $id)
    {
        return $this->commentRepository->getCommentById($id);
    }

    /**
     * Update a comment
     * @param int $id
     * @param arrray $data
     * @return json response
    */
    public function updateComment(int $id, array $data)
    {

        $comment = $this->commentRepository->getCommentById($id);

        if (!$comment) {
            return response()->json(['message' => 'Comment Not Found'], 404);
        }

        $data["status"] = isset($data["status"]) ? 'S' : 'N';

        $this->commentRepository->updateComment($comment, $data);
        return response()->json(['message' => 'Comment Updated'], 200);
    }

    /**
     * Delete a comment
     * @param int $id
     * @return json response
    */
    public function destroyComment(int $id)
    {
        $comment = $this->commentRepository->getCommentById($id);

        if (!$comment) {
            return response()->json(['message' => 'Comment Not Found'], 404);
        }

        $this->commentRepository->destroyComment($comment);

        return response()->json(['message' => 'Comment Deleted'], 200);
    }
}
