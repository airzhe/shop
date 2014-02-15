<?php 
class Settings_model extends MY_Model{
	protected $_table_name = 'settings';
	protected $_primary_key = 'name';
	protected $_primary_filter = 'addslashes';
	
}