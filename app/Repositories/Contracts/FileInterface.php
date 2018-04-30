<?php
namespace Repositories\Contracts;

interface FileInterface
{
  /**
   * stores a file in the DB and in the filesystem
   * @param  Illuminate\Support\Facades\Storage $file      
   * @param  int $ticket_id the ticket in the DB to attatch to
   * @return none            
   */
  public function store($file, $ticket_id);

  /**
   * deletes file from the DB and the filesystem
   * @param  int $id 
   * @return none     
   */
  public function destroy($id);
}