<?php
class Goods_Pic_model extends MY_Model {
	
	protected $_table_name = 'goods_pic';
	protected $_primary_key = 'pic_id';
	protected $_primary_filter = 'intval';
	
	function __construct() {
		parent::__construct();
	}
}