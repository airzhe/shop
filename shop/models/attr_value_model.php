<?php
class Attr_value_model extends MY_Model {
	
	protected $_table_name = 'attr_value';
	protected $_primary_key = 'av_id';
	protected $_primary_filter = 'intval';
	
	
	function __construct() {
		parent::__construct();
	}
	
}