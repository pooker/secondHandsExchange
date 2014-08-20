<?php defined('BASEPATH') OR exit('No direct script access allowed');
class GoodsM extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	function getAll()
	{
		$q = $this->db
		->order_by('update_time','desc')
		->get('goods');

			
		return $q->result();
	}

	function getby_type($type)
	{
		$q = $this->db
		->order_by('update_time','desc')
		->where('catagery',$type)
		->where('soldout',true)
		->get('goods');
			
			
		return $q->result();
	}
	
	function getby_id($id)
	{
		$q = $this->db
		->where('id',$id)
		->get('goods');
		
		return $q->result();
	}
	function getBy_sellor($id)
	{
		$q = $this->db
		->order_by('soldout','desc')
		->order_by('update_time', 'desc')
		->where('sellor',$id)
		->get('goods');
		
		return $q->result();
	}

	function add($catagery,$price,$picture,$title,$description,$address,$connector,$phone,$sellor)
	{
		$data = array(
			'catagery' =>$catagery,
			'price' =>$price,
			'picture' =>$picture,
			'title' =>$title,
			'description' => $description,
			'address' => $address,
			'connector' =>$connector,
			'phone' =>$phone,
			'sellor' =>$sellor
		);
		$q = $this->db->insert('goods',$data);
		return $q;
	}

	function delete($id)
	{
		$q = $this->db->where('id',$id)
		->delete('goods');
	}

	function getLimit($arr=array('num'=>FALSE,'offset'=>FALSE),$type)
	{
		//分页限制
		$limit='';
		if(isset($arr['num']) and isset($arr['offset']) and $arr['num']!==FALSE and $arr['offset']!==FALSE ){
			$limit=" LIMIT {$arr['offset']},{$arr['num']}";
		}
		$query = $this->db->query("select * from goods where catagery='$type' and soldout = true order by update_time desc $limit");

		$accounts = array();

		foreach ($query->result() as $row) {
			$accounts[] = $row;
		}
		return $accounts;

	}
	
	function sold_out($id)
	{
		$data = array(
			'soldout' => false,//means that thing is sold out
		);
		
		$this->db->where('id',$id);
		if($this->db->update('goods',$data))
		{
			return true;
		}
		else return false;
		
	}
	
	function count($type)
	{
		$this->db->where('catagery',$type)
		->where('soldout',true);
		$count = $this->db->count_all_result();
		
		return $count;
	}

	function getforSlide()
	{
		$q = $this->db
		->order_by('update_time','desc')
		->where('soldout',true)
		->where('sellor','1')
		->limit(5,0)//start from 0, count 5
		->get('goods');
		return $q->result();
	}
	function getfordownslide()
	{
		$q = $this->db
		->order_by('update_time','desc')
		->where('soldout',true)
		->limit(4,5)
		->get('goods');
		return $q->result();
	}

}