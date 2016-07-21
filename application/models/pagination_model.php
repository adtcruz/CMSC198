

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagination_Model extends CI_Model {
function __construct() {
parent::__construct();
}
// Count all record of table "contact_info" in database.
public function record_count() {
return $this->db->count_all("job");
}

// Fetch data according to per_page limit.
public function fetch_data($limit, $jobID) {
$this->db->limit($limit);
$this->db->where('jobID', $jobID);
$query = $this->db->get("job");
if ($query->num_rows() > 0) {
foreach ($query->result() as $row) {
$data[] = $row;
}

return $data;
}
return false;
}
}
?>

