<?php
namespace Repositories\Contracts;

interface CommentInterface
{
  /**
   * stores a comment
   * @param  Request $data 
   * @return Comment model       
   */
  public function store($data);
}