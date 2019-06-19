<?php

class SessionModel extends Model
{
  private $table = 'pfm_sessions';

  public function __construct()
  {
    parent::__construct();
  }

  public function saveUserLogging( $userId )
  {
    $datetime_now = DATETIME_NOW;
    $sql = "INSERT INTO $this->table ( id_user, session_connected, session_status, session_date )
            VALUES ( $userId, '0.0.0.0', 0, '$datetime_now' )";
    return $this->query( $sql );
  }

}
