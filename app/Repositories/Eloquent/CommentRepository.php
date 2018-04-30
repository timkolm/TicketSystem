<?php
namespace Repositories\Eloquent;

use App\Comment;
use Repositories\Contracts\CommentInterface;

class CommentRepository implements CommentInterface{
  
  protected $comment;

  public function __construct(Comment $comment)
  {
    $this->comment = $comment;
  }

  /**
   * stores a comment
   * @param  Request $data 
   * @return Comment model       
   */
  public function store($data)
  {
    $this->comment->user = $data->user;
    $this->comment->body = $data->body;
    $this->comment->ticket_id = $data->ticket_id;
    return $this->comment->save();
  }
}