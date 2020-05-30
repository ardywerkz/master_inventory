<?php

class Model_products extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the brand data */
	public function getProductData($id = null)
	{
		if ($id) {
			$sql = "SELECT * FROM products where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM products ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getActiveProductData()
	{
		$sql = "SELECT * FROM products WHERE availability = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function create($data)
	{
		if ($data) {
			$insert = $this->db->insert('products', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if ($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('products', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if ($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('products');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalProducts()
	{
		$sql = "SELECT * FROM products";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	// get sales everyday
	public function getSales_today($today)
	{
		//$condition = "company LIKE '%" . $today . "%' and provider LIKE '%" . $today . "%' AND status=0 ";
		$sql = "SELECT SUM(gross_amount) AS SaleToday FROM orders WHERE sales_date LIKE '%" . $today . "%' ";
		$query = $this->db->query($sql);
		return $query->result();
	}

	//get sale monthly
	public function get_saleMonthly()
	{
		$sql = "SELECT SUM(gross_amount) AS sale_monthly, month(sales_date) AS Montly FROM orders";
		$query = $this->db->query($sql);
		return $query->result();
	}

	//get sale yearly
	public function get_saleYearly()
	{
		$sql = "SELECT SUM(gross_amount) AS sale_yearly, year(sales_date) AS Year FROM orders ";
		$query = $this->db->query($sql);
		return $query->result();
	}


	//get product expire
	public function get_product_expire($limit, $start, $st = "", $orderField, $orderDirection)
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->or_like('name', $st);
		$this->db->or_like('price', $st);
		$this->db->or_like('date_expire', $st);
		$this->db->limit($limit, $start);
		$this->db->order_by($orderField, $orderDirection);
		$this->db->order_by('created_at', 'DESC');
		$query = $this->db->get();

		return $query->result();
	}
	public function count_product_expire($limit, $start, $st = "", $orderField, $orderDirection)
	{
		$this->db->select();
		$this->db->from('products');
		$this->db->or_like('name', $st);
		$this->db->or_like('price', $st);
		$this->db->or_like('date_expire', $st);
		$this->db->order_by($orderField, $orderDirection);
		$query = $this->db->get();
		return $query->num_rows();
	}
}
