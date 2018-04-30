<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Repositories\Contracts\TicketInterface;
use Repositories\Contracts\FileInterface;
use App\Http\Requests\TicketPost;
use App\Http\Requests\FilePost;

class TicketController extends Controller
{
    protected $ticket;
    protected $file;

    function __construct(TicketInterface $ticket)
    {   
      $this->ticket = $ticket;
    }

    /**
     * Display a listing of the Tickets.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($sortBy=null)
    {
        $tickets = $this->ticket->paginate(10, $sortBy);
        $colors = [
          'Closed' => 'secondary',
          'Open' => 'default',
          'Responded' => 'success'
        ];
        return view('tickets.list')->with(compact('tickets', 'colors'));  
    }

    /**
     * Show the form for creating a new Ticket.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $ticket = $this->ticket->empty();
      return view('tickets.new')->with(compact('ticket'));
    }

    /**
     * Store a newly created Ticket in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketPost $request, FilePost $fileRequest)
    {
      //validation through TicketPost and FilePost Requests 

      //saving
      $ticket_id = $this->ticket->store($request);
      if($fileRequest->hasFile('files')) $this->saveFiles($fileRequest, $ticket_id);
      return redirect(route('index'));
    }

    /**
     * Display the specified Ticket.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $ticket = $this->ticket->findWithComments($id);
      $comments = $ticket->comments;
      return view('tickets.show')->with(compact('ticket', 'comments'));
    }

    /**
     * Show the form for editing the specified Ticket.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $ticket = $this->ticket->findWithComments($id);
      if(count($ticket->comments) > 0) return back()->withErrors(['You cannot edit ticket after it was commented!']);
      return view('tickets.edit')->with(compact('ticket'));
    }

    /**
     * Update the specified Ticket in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TicketPost $request, FilePost $fileRequest, $id)
    {
      $this->ticket->update($id, $request);
      if($fileRequest->hasFile('files')) $this->saveFiles($fileRequest, $id);
      return redirect(route('index'));
    }

    /**
     * Close the specified ticket. The ticket is not deleted, but is closed. (soft-deleted)
     *
     * @param  int  $id
     * @return index view
     */
    public function close($id)
    {
      $this->ticket->close($id);
      return redirect(route('index'));
    }

    /**
     * Reopen the specified ticket.
     *
     * @param  int  $id
     * @return index view
     */
    public function reopen($id)
    {
      $this->ticket->reopen($id);
      return redirect(route('index'));
    }

    /**
     * Remove the specified Ticket from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $this->ticket->destroy($id);
      return redirect(route('index'));
    }

    /**
     * remove the specified file from the database and from the filesystem
     * @param  int $id 
     * @return back   
     */
    public function removeFile($id)
    {
      $this->file = resolve('Repositories\Contracts\FileInterface');
      $this->file->destroy($id);
      return back();
    }

    /**
     * save uploaded files to the filesystem and to the database
     * @param  Request $fileRequest 
     * @param  int $ticket_id   
     * @return none              
     */
    public function saveFiles($fileRequest, $ticket_id)
    {
      $files = $fileRequest->file('files');
      foreach ($files as $file) {
        $this->file = resolve('Repositories\Contracts\FileInterface');
        $this->file->store($file, $ticket_id);
      }
    }
}
