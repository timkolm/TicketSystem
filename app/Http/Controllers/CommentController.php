<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Repositories\Contracts\CommentInterface;
use App\Http\Requests\CommentPost;

class CommentController extends Controller
{
  protected $comment;

  function __construct(CommentInterface $comment)
  {   
      $this->comment = $comment;
  }

  /**
   * stores a comment to a Ticket
   * @param  Request $request 
   * @return back           
   */
  public function store(Request $request)
  { 
    //validation through CommentPost Request
      
    //saving
    $this->comment->store($request);
    return back();
  }
}
