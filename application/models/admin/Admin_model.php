<?php class Admin_Model extends CI_Model {
	public function login() {

		if($this->input->post()){
		$phone = $this->input->post('phone');
		$password = md5($this->input->post('password'));
		$sql = $this->db->query("SELECT * FROM admin WHERE phone='$phone' and password='$password'");
		return $sql->row_array();
		}
	}
	public function chngpass($admin_name,$oldpass,$user_id)
	{
				$qry="select * from admin where username='".$this->db->escape_str($admin_name)."' and password =md5('".$this->db->escape_str($oldpass)."') and id='".$user_id."'";
				$res=$this->db->query($qry);
				return $res->row();
	}
	public function chng_pass($admin_name,$newpass)
	{
		$qry="update admin set password=md5('".$this->db->escape_str($newpass)."')  where username='".$this->db->escape_str($admin_name)."'   ";
		$res=$this->db->query($qry);
		return $res;
	}
	public function get_chalets()
	{
		$sql = $this->db->query("SELECT * FROM user WHERE user_type='chalet' and active_status='1'");
		return $sql->result_array();
	}
	public function chalets()
	{
		$sql = $this->db->query("SELECT * FROM user WHERE user_type='chalet' order by id desc limit 13");
		return $sql->result_array();
	}
	public function bookings()
	{
		$sql = $this->db->query("SELECT b.id,b.booking_id,b.booking_status,b.created,b.current_price,h.image,h.name,h.price,h.city,c.first_name as chalet_name,u.first_name as user_name from booking as b left join user as c on b.chalet_id=c.id left join user as u on b.user_id=u.id left join hotels as h on h.id = b.hotel_id group by b.id order by b.id");
		return $sql->result_array();
	}
	public function latest_bookings()
	{
		$sql = $this->db->query("SELECT b.id,b.booking_id,b.booking_status,b.created,b.current_price,h.image,h.name,h.price,h.city,c.first_name as chalet_name,u.first_name as user_name from booking as b left join user as c on b.chalet_id=c.id left join user as u on b.user_id=u.id left join hotels as h on h.id = b.hotel_id group by b.id order by b.id desc limit 5 ");
		return $sql->result_array();
	}
	public function cancel_bookings()
	{
		$sql = $this->db->query("SELECT b.id,b.booking_id,b.booking_status,b.created,b.current_price,h.image,h.name,h.price,h.city,c.first_name as chalet_name,u.first_name as user_name from booking as b left join user as c on b.chalet_id=c.id left join user as u on b.user_id=u.id left join hotels as h on h.id = b.hotel_id where b.booking_status = '1' group by b.id order by b.id");
		return $sql->result_array();
	}
	public function get_cancel_unreadbookings()
	{
		$sql = $this->db->query("SELECT b.id,b.booking_id,b.booking_status,b.current_price,b.created,h.image,h.name,h.price,h.city,c.first_name as chalet_name,u.first_name as user_name from booking as b left join user as c on b.chalet_id=c.id left join user as u on b.user_id=u.id left join hotels as h on h.id = b.hotel_id where b.read_status = '0' and b.booking_status = '1' group by b.id order by b.id");
		return $sql->result_array();
	}
	public function single_booking($id)
	{
		$sql = $this->db->query("SELECT b.id,b.booking_id,b.booking_status,b.current_price,b.created,h.image,h.name,u.phone as user_phone,h.price,h.city,c.first_name as chalet_name,u.first_name as user_name from booking as b left join user as c on b.chalet_id=c.id left join user as u on b.user_id=u.id left join hotels as h on h.id = b.hotel_id  where b.id = '$id'");
		return $sql->row_array();
	}


}
