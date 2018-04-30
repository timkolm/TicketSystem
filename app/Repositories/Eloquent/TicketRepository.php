<?php
namespace Repositories\Eloquent;

use App\Ticket;
use App\Comment;
use Repositories\Contracts\TicketInterface;
use Illuminate\Support\Facades\Storage;

class TicketRepository implements TicketInterface{
  
  protected $ticket;

  public function __construct(Ticket $ticket)
  {
    $this->ticket = $ticket;
  }

  /**
   * returns all tickets
   * @return collection 
   */
  public function all(){
    return $this->ticket
      ->withTrashed()
      ->orderBy('updated_at', 'desc')
      ->get();
  }

  /**
   * returns all tickets sorted and paginated
   * @param  int $count  how many on a page
   * @param  string $sortBy in format "field-direction"
   * @return collection         
   */
  public function paginate($count, $sortBy){
    if(!$sortBy) $sortBy = 'created_at-desc';
    $orderBy = explode('-', $sortBy);
    return $this->ticket
      ->withTrashed()
      ->with('comments')
      ->with('files')
      ->orderBy($orderBy[0], $orderBy[1])
      ->paginate($count);
  }

  /**
   * finds one ticket by id
   * @param  int $id 
   * @return model     Ticket
   */
  public function find($id){
    return $this->ticket->withTrashed()->findOrFail($id);
  }

  /**
   * finds one ticket with comments by id
   * @param  int $id 
   * @return Ticket model with Comment model(s)
   */
  public function findWithComments($id)
  {
    return $this->ticket->withTrashed()->with('comments')->with('files')->findOrFail($id);
  }

  /**
   * makes an empty Ticket
   * @return model Ticket
   */
  public function empty()
  {
    $this->ticket->fill(['user' => '', 'subject' => '', 'urgency' => '', 'description' => '']);
    return $this->ticket;
  }

  /**
   * stores Ticket in the Database
   * @param  Request $data 
   * @return int       Ticket id
   */
  public function store($data){
    $this->ticket->user = $data->name;
    $this->ticket->subject = $data->subject;
    $this->ticket->urgency = $data->urgency;
    $this->ticket->description = $data->description;
    $this->ticket->save();
    return $this->ticket->id;
  }

  /**
   * updates Ticket in the database
   * @param  int $id   
   * @param  Request $data 
   * @return none       
   */
  public function update($id, $data){
    $this->ticket = $this->find($id);
    $this->store($data);
  }

  /**
   * closes a Ticket by "soft-deleting"
   * @param  int $id 
   * @return none     
   */
  public function close($id){
    $this->ticket = $this->ticket->find($id);
    $this->ticket->status = 'Closed';
    $this->ticket->save();
    $this->ticket->delete();
  }

  /**
   * reopens a Ticket that was "soft-deleted"
   * @param  int $id 
   * @return none
   */
  public function reopen($id){
    $this->ticket = $this->ticket->withTrashed()->find($id);
    $this->ticket->status = 'Open';
    $this->ticket->save();
    $this->ticket->restore();
  }

  /**
   * deletes a Ticket permanentely from Database and it's files from the filesystem
   * @param  int $id 
   * @return none
   */
  public function destroy($id)
  {
    $this->ticket = $this->ticket->withTrashed()->with('files')->find($id);
    foreach ($this->ticket->files as $file) {
      if(!Storage::exists($file->filename)) continue;
      Storage::delete($file->filename);
    }
    $this->ticket->forceDelete();
  }

}