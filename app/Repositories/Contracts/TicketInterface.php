<?php
namespace Repositories\Contracts;

interface TicketInterface
{
  /**
   * returns all tickets
   * @return collection 
   */
  public function all();

  /**
   * returns all tickets sorted and paginated
   * @param  int $count  how many on a page
   * @param  string $sortBy in format "field-direction"
   * @return collection         
   */
  public function paginate($count, $sortBy);

  /**
   * finds one ticket by id
   * @param  int $id 
   * @return model     Ticket
   */
  public function find($id);

  /**
   * finds one ticket with comments by id
   * @param  int $id 
   * @return Ticket model with Comment model(s)
   */
  public function findWithComments($id);

  /**
   * makes an empty Ticket
   * @return model Ticket
   */
  public function empty();

  /**
   * stores Ticket in the Database
   * @param  Request $data 
   * @return int       Ticket id
   */
  public function store($data);

  /**
   * updates Ticket in the database
   * @param  int $id   
   * @param  Request $data 
   * @return none       
   */
  public function update($id, $data);

  /**
   * closes a Ticket by "soft-deleting"
   * @param  int $id 
   * @return none     
   */
  public function close($id);

  /**
   * deletes a Ticket permanentely from Database
   * @param  int $id 
   * @return none
   */
  public function reopen($id);
}