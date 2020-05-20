<?php

class Model_sales extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_sales_query()
    {
        $sql = "SELECT products.name, 
        year(orders.sales_date) AS year, 
        date_format(orders.sales_date, '%M') AS month, 
        SUM(orders_item.amount) AS amount FROM orders_item
        LEFT JOIN orders ON orders.id = orders_item.order_id 
        LEFT JOIN products ON products.id = orders_item.product_id
        GROUP BY products.name ,year(orders.sales_date), date_format(orders.sales_date, '%M')
        ORDER BY products.name ,year(orders.sales_date), date_format(orders.sales_date, '%M')";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_sales_everyday()
    {
        $sql = "SELECT products.name, 
        year(orders.sales_date) AS year, 
        DATE(orders.sales_date) AS Day, 
        SUM(orders_item.amount) AS amount FROM orders_item
        LEFT JOIN orders ON orders.id = orders_item.order_id 
        LEFT JOIN products ON products.id = orders_item.product_id
        GROUP BY products.name ,year(orders.sales_date), DATE(orders.sales_date)
        ORDER BY orders_item.created_at DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
