<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class COMMON_MODEL extends CI_Model {
    public function insert_data($data,$tbl_name){
		$sql = $this->db->insert($tbl_name,$data);
		return ( $this->db->insert_id() );
	}
   public function get_data($tbl,$field,$value,$limit=0,$limit_start=0){
		if(!empty($field)){
			$this->db->where($field,$value);
		}
		if(!empty($limit)){
			$this->db->limit($limit, $limit_start);
		}

		$this->db->order_by('id','DESC');
		return $this->db->get($tbl)->result_array();
	}
	public function get_all_data($tbl){

		$this->db->order_by('id','DESC');
		return $this->db->get($tbl)->result_array();
	}


	public function update($tbl,$data,$field,$value){
		$this->db->where($field,$value);
		return $this->db->update($tbl,$data);
	}
	public function get_rows($tbl,$field=0,$value=0)	{
		if(!empty($field)){
			$this->db->where($field,$value);
		}
		return $this->db->get($tbl)->num_rows();
	}
	public function get_data_by_id($tbl,$field=0,$value=0){
		if(!empty($field)){
			$this->db->where($field,$value);
		}
		return $this->db->get($tbl)->row_array();
	}

	public function delete($tbl,$field=0,$value=0){
		$this->db->where($field,$value);
		return $this->db->delete($tbl);
	}
	public function count_data_with_id($tbl,$field=0,$value=0){
		if(!empty($field)){
			$this->db->where($field,$value);
		}
		return $this->db->count_all_results($tbl);
	}
  public function change_status($table, $column, $value, $uniqueNameCol, $uniqueColValue)
	{
		$query = $this->db->query("UPDATE ".$table." SET `".$column."` = '".$value."' WHERE `".$uniqueNameCol."` = '".$uniqueColValue."' ");
		//echo $this->db->last_query();
	}

	public function num_data($id,$tbl)
	{
		$this->db->select('*');
		$this->db->order_by($id);
		$result = $this->db->get($tbl);
		return $result->num_rows();
	}

	public function get_b_commnt($limit , $start,$b_id ){
		$this->db->select('tbl_blog_comments.*');
		$this->db->join('tbl_blog','tbl_blog.b_id = tbl_blog_comments.b_id','left');
		$this->db->limit($limit, $start);
		$this->db->where("tbl_blog.b_id",$b_id);
		$qry = $this->db->get('tbl_blog_comments');
		// echo $this->db->last_query();
		return $qry->result_array();
	}

	public function num_comnt_data($b_id)
	{
		$this->db->select('tbl_blog_comments.*');
		$this->db->join('tbl_blog','tbl_blog.b_id = tbl_blog_comments.b_id','left');
		$this->db->where("tbl_blog.b_id",$b_id);
		$qry = $this->db->get('tbl_blog_comments');
		return $qry->num_rows();
	}

	public function get_faqs() {
		$this->db->select('*');
		$this->db->order_by('id','DESC');
		$result = $this->db->get('tbl_faqs');
		return $result->result();
	}
	public function save_faq($faq_data){
		$sql =$this->db->insert('tbl_faqs' ,$faq_data);
		return true;
	}
	public function edit_faq($faq_id){
		$this->db->select('*');
		$this->db->where('id',$faq_id);
		$result = $this->db->get('tbl_faqs');
		return $result->row();
	}
	public function update_faq($faq_id ,$news_data){
		$this->db->where("id", $faq_id);
		$sql =$this->db->update('tbl_faqs' ,$news_data);
		return true;
	}
	public function delete_faq($faq_id){
		$query = $this->db->where('id', $faq_id);
		$query = $this->db->delete('tbl_faqs');
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function get_images($_id)
	{
		$this->db->select('*');
		$this->db->where("gallery_id",$_id);
		$result = $this->db->get('tbl_images');
		// echo $this->db->last_query();
		return $result->result();
	}
	 public function get_datas_search($tbl,$field,$value,$limit=0,$limit_start=0,$searh_query){
		if(!empty($field)){
			$this->db->where($field,$value);
		}
		if(!empty($searh_query))
		{
			$this->db->like('user_group', $searh_query);
		}
		if(!empty($limit)){
			$this->db->limit($limit, $limit_start);
		}
		return $this->db->get($tbl)->result_array();
	}
		 public function get_datas_searches($tbl,$limit=0,$limit_start=0,$searh_query){

		if(!empty($searh_query))
		{
			$this->db->like('user_group', $searh_query);
		}
		if(!empty($limit)){
			$this->db->limit($limit, $limit_start);
		}
		return $this->db->get($tbl)->result_array();
	}

	public function getDriverDocument($ids){
		$sql = $this->db->query("SELECT p.title,d.* FROM partnershipDocument as p left join driverDocuments as d on d.patnershipDocumentID = p.id where d.driverId = $ids and p.id NOT IN('19') ");
		return $sql->result_array();
	}

	public function partnershipDocumentDetails($finalIDs){
		$sql = $this->db->query("SELECT * FROM partnershipDocument where id not in ($finalIDs) ");
		return $sql->result_array();
	}

  public function getTop10User(){
    $sql = $this->db->query("select * from userDetails ORDER BY id DESC LIMIT 8;");
    return $sql->result_array();
  }

  public function getTop10Order(){
    $sql = $this->db->query("select * from userBookingServices ORDER BY id DESC LIMIT 7;");
    return $sql->result_array();
  }
  public function deleteSubcategory($categoryId){
    $sql = $this->db->query("delete from subCategory where categoryId = $categoryId ");
    return $sql;
  }
  public function getSubCategories(){
    $sql = $this->db->query("select subCategory.*,category.name as categoryName from subCategory left join category on category.id = subCategory.categoryId order by subCategory.id asc");
    return $sql->result_array();
  }
   public function getCategorydata(){
    $sql = $this->db->query("select storyCategory.*,maincategory.title ,maincategory.image from storyCategory left join maincategory on maincategory.id = storyCategory.titleId ");
    return $sql->result_array();
  }

  public function getCoralzTitle($postion){
    $sql = $this->db->query("select * from coralz where id = $postion ");
    return $sql->result_array();
  }

  public function getUniversity(){
	  $sql = $this->db->query("SELECT countrylist.title as countryTitle,university.* FROM university left JOIN countrylist on countrylist.id = university.countryId where university.status = '0' order by university.id DESC ");
    return $sql->result_array();
  }

  public function getSchool(){
	  $sql = $this->db->query("SELECT countrylist.title as countryTitle,school.* FROM school left JOIN countrylist on countrylist.id = school.countryId where school.status = '0' order by school.id DESC ");
    return $sql->result_array();
  }

  public function getStudies(){
	  $sql = $this->db->query("SELECT countrylist.title as countryTitle,studies.* FROM studies left JOIN countrylist on countrylist.id = studies.countryId where studies.status = '0' order by studies.id DESC ");
    return $sql->result_array();
  }
  public function subCategory(){
	  $sql = $this->db->query("SELECT category.title as categoryTitle, subcategory.* FROM `subcategory` left join category on category.id = subcategory.categoryId order by subcategory.id DESC ");
    return $sql->result_array();
  }

  public function getVideos($status){
    $sql = $this->db->query("SELECT users.username,users.name,users.email,users.phone,users.image,userVideos.* FROM `userVideos` left join users on users.id = userVideos.userId where userVideos.status = 0 order by userVideos.id desc");
    return $sql->result_array();

  }

  public function serchList($startdate,$enddate,$status,$search,$todatDate){
    $data = array();
    $whre ='';
    if(!empty($status)){
      $data[] = "onlineStatus = '$status'";
    }
    if(!empty($search)){
      $data[] = "username like '%$search%'";
    }
    if(!empty($startdate) && !empty($enddate)){
      $data[] = "date(created) >= '$startdate' and date(created) <= '$enddate'";
    }
    elseif(!empty($enddate)){
      $data[] = "date(created) = '$enddate'";
    }
    elseif(!empty($startdate)){
      $data[] = "date(created) = '$startdate'";
    }

    if(!empty($data)){
      $whre = 'and '.implode(' and ', $data);
    }
    $sql = $this->db->query("SELECT * FROM `users`  where id != 0 $whre");
    return $sql->result_array();

  }

   public function searchCoinsHistory($end, $pname, $start, $Urifunction, $offset){



         if(!empty($end) && !empty($pname) && !empty($start)){

            $where = "DATE_FORMAT(userCoinHistory.created ,'%Y-%m-%d') between '$start' and '$end' and users.username like '%$pname%' and userCoinHistory.type = 1 ";

         }
         elseif (!empty($start) && !empty($end)) {

             $where = "DATE_FORMAT(userCoinHistory.created ,'%Y-%m-%d') between '$start' and '$end' ";
         }
         elseif(!empty($start) && !empty($pname)){

           $where = "DATE_FORMAT(userCoinHistory.created ,'%Y-%m-%d') = '$start' and (users.username like '%$pname%' or users.email like '%$pname%' or users.phone like '%$pname%'  and userCoinHistory.type = 1)  ";

         }
         elseif(!empty($end) && !empty($pname)){

           $where = "DATE_FORMAT(userCoinHistory.created ,'%Y-%m-%d') = '$end' and (users.username like '%$pname%' or users.email like '%$pname%' or users.phone like '%$pname%'  and userCoinHistory.type = 1)  ";

         }
         elseif(!empty($start)){
           $where = "DATE_FORMAT(userCoinHistory.created ,'%Y-%m-%d') = '$start'  and userCoinHistory.type = 1 ";
         }
         elseif(!empty($end)){
           $where = "DATE_FORMAT(userCoinHistory.created ,'%Y-%m-%d') = '$end'  and userCoinHistory.type = 1";
         }
          else{
            $where = "users.username like '%$pname%' or users.email like '%$pname%' or users.phone like '%$pname%'  and userCoinHistory.type = 1 ";
          }
          $sql = $this->db->query("select users.username,users.name,users.image,users.email,users.phone,admin.id as adminId, admin.name as adminName,userCoinHistory.* FROM userCoinHistory left join users on users.id = userCoinHistory.userId left join admin on admin.id = userCoinHistory.subminId  where $where order by userCoinHistory.id  limit $offset,10 ")->result_array();
          $count = $this->db->query("select users.username,users.name,users.image,users.email,users.phone,admin.id as adminId, admin.name as adminName,userCoinHistory.* FROM userCoinHistory left join users on users.id = userCoinHistory.userId left join admin on admin.id = userCoinHistory.subminId  where $where order by userCoinHistory.id ")->num_rows();

          return  $data = [$sql,$count];

   }


  public function searchResult($end, $pname, $start, $Urifunction, $offset){
    if($Urifunction == 'getApproved'){
      $status = '0';
    }
    else if($Urifunction == 'getNonViewed'){
      $status = '3';
    }
    else if($Urifunction == 'getTrending'){
      $status = '1';
    }
    else if($Urifunction == 'getRejected'){
      $status = '2';
    }

      if(!empty($end) && !empty($pname) && !empty($start)){
        $where = "userVideos.created between '$start' and '$end' and users.username like '%$pname%' or users.email like '%$pname%' or users.phone like '%$pname%' and userVideos.status = '$status' ";

      }
      elseif(!empty($start) && !empty($end)){
        $where = "userVideos.created between '$start' and '$end' and userVideos.status = '$status' ";
      }
      elseif(!empty($start) && !empty($pname)){
        $where = "userVideos.created = '$start' and (users.username like '%$pname%' or users.email like '%$pname%' or users.phone like '%$pname%') and userVideos.status = '$status' ";
      }
      elseif(!empty($end) && !empty($pname)){
        $where = "userVideos.created = '$end' and (users.username like '%$pname%' or users.email like '%$pname%' or users.phone like '%$pname%') and userVideos.status = '$status'";
      }
      elseif(!empty($start)){
        $where = "userVideos.created = '$start' and userVideos.status = '$status' ";
      }
      elseif(!empty($end)){
        $where = "userVideos.created = '$end' and userVideos.status = '$status'";
      }

      elseif(!empty($pname)){
        $where = "users.username like '%$pname%' and userVideos.status = '$status'  or users.email like '%$pname%' and userVideos.status = '$status'  or users.phone like '%$pname%' and userVideos.status = '$status' ";
      }
      else{
        $where = "userVideos.status = '$status' ";
      }

       $sql = $this->db->query("select userVideos.*, users.username, users.email, users.phone ,users.image,hashtag.id as di,hashtag.hashtag as hash from userVideos left join users on users.id=userVideos.userId left join hashtag on hashtag.id = userVideos.hashTag where $where  limit $offset,10 ")->result_array();
         $count = $this->db->query("select userVideos.*, users.username, users.email, users.phone ,users.image,hashtag.id as di,hashtag.hashtag as hash from userVideos left join users on users.id=userVideos.userId left join hashtag on hashtag.id = userVideos.hashTag where $where order by users.id ")->num_rows();

 // echo $this->db->last_query();
 // die;
      return  $data = [$sql,$count];
  }


  public function countVideoComLike($useid){
    $sql = $this->db->query("SELECT count(id) as totalVideos,sum(likeCount) as totalLikeCount, sum(commentCount) as totalCommentCount, sum(viewCount) as totalViewCount FROM `userVideos` where userId = $useid group by userId");
    return $sql->row_array();
  }
}
