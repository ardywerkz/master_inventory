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
		$sql = "SELECT SUM(gross_amount) AS sale_yearly, year(sales_date) AS Year FROM orders GROUP BY year(sales_date)";
		$query = $this->db->query($sql);
		return $query->result();
	}
}
