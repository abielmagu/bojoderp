<?php

if( isset( $data['work'] ) )
{
    require_once('work.php');
}
else
{
    require_once('list.php');
}