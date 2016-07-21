<?php
class MovieModel extends Model {

 function Pagination_Model(){
  parent::Model();
 }

 function getJR($limit=null,$offset=NULL){
  $this->db->select("jobID,jobDescription,startDate,finishDate");
  $this->db->from('job');
  $this->db->limit($limit, $offset);
  $query = $this->db->get();
  return $query->result();
 }

 function totalJR(){
  return $this->db->count_all_results('job');
 }
}
?>