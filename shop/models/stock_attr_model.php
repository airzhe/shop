<?php
/**
 * 库存表模型
 */
class Stock_attr_model extends MY_Model {
	
	protected $_table_name = 'stock_attr';
	protected $_primary_key = 'sa_id';
	protected $_primary_filter = 'intval';
}