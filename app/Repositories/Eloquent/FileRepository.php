<?php
namespace Repositories\Eloquent;

use App\File;
use App\Ticket;
use Repositories\Contracts\FileInterface;
use Illuminate\Support\Facades\Storage;

class FileRepository implements FileInterface{
  
  protected $file;

  public function __construct(File $file)
  {
    $this->file = $file;
  }

  /**
   * stores a file in the DB and in the filesystem
   * @param  Illuminate\Support\Facades\Storage $file      
   * @param  int $ticket_id the ticket in the DB to attatch to
   * @return none            
   */
  public function store($file, $ticket_id)
  { 
    $newName = $file->store('uploads');
    $this->file->filename = $newName;
    $this->file->size = $file->getClientSize();
    $this->file->filename_old = $file->getClientOriginalName();
    $this->file->ticket_id = $ticket_id;
    $this->file->save();
  }

  /**
   * deletes file from the DB and the filesystem
   * @param  int $id 
   * @return none     
   */
  public function destroy($id)
  {
    $file = $this->file->find($id);
    if(!Storage::exists($file->filename)) return;
    Storage::delete($file->filename);
    $file->delete();
  }
}