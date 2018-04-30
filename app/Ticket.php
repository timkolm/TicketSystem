<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Repositories\Contracts\TicketInterface;

class Ticket extends Model
{
  use SoftDeletes;

  protected $fillable = ['subject', 'status', 'description', 'urgency', 'user', 'file', ];

  public $urgencyOptions = ['Very urgent', 'Urgent', 'Average urgency', 'Not urgent'];

  /**
   * The attributes that should be mutated to dates.
   *
   * @var array
   */
  protected $dates = ['deleted_at'];


  /**
   * Get the comments for the ticket.
   */
  public function comments()
  {
      return $this->hasMany('App\Comment');
  }

  /**
   * Get the files for the ticket.
   */
  public function files()
  {
      return $this->hasMany('App\File');
  }
}
