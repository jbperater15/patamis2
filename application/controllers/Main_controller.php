<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Main_controller extends CI_Controller
{

     public function __construct() {
        Parent::__construct();
        $this->load->model("main_model");
        date_default_timezone_set('asia/manila');
    }

     public function index()
     {
          $this->load->view('calendar/calendar_index_view');
     }

     public function evaluation_schedule_insert() {
     	$evaluation_title=$this->input->post('evaluation_title');
	    $date=$this->input->post('date');
	    $time_start=$this->input->post('time_start');
	    $time_end=$this->input->post('time_end');
	    $creation_date = date('Y-m-d H-i-s');
	    $data = array(
	    	'eval_sched_id'=>NUll,
	        'evaluation_title'=>$evaluation_title,
	        'project_id'=> '0',
	        'date'=>$date,
	        'time_start'=>$time_start,
	        'time_end'=>$time_end,
	        'created_by'=> '0',
	        'creation_date'=> $creation_date,
	        'updated_by'=> '0',
	        'update_date'=> '0'
	    );
	    $this->main_model->evaluation_schedule_insert($data);
	    redirect('main_controller/calendar_view');
	}

	function calendar_view(){
		$this->load->view('calendar/calendar_index_view');
	}

	function load_event()
	{
	  $event_data = $this->main_model->fetch_all_schedule_event();
	  foreach($event_data->result_array() as $row)
	  {
	   $data[] = array(
	    'id' => $row['eval_sched_id'],
	    'title' => $row['evaluation_title'],
	    'start' => $row['date'].'T'.$row['time_start'],
	    'end' =>  $row['date'].'T'.$row['time_end']
	   );
	  }
	  echo json_encode($data);
	}

	function update_event(){
		$evaluation_id=$this->input->post('evaluation_id');
		$evaluation_title=$this->input->post('evaluation_title');
	    $date=$this->input->post('date');
	    $time_start=$this->input->post('time_start');
	    $time_end=$this->input->post('time_end');
	    $update_date = date('Y-m-d H-i-s');
	    $data = array(
	    	//'eval_sched_id'=>NUll,
	        'evaluation_title'=>$evaluation_title,
	        //'project_id'=> '0',
	        'date'=>$date,
	        'time_start'=>$time_start,
	        'time_end'=>$time_end,
	        //'created_by'=> '0',
	        //'creation_date'=> $creation_date,
	        //'updated_by'=> '0',
	        'update_date'=> $update_date
	    );
	    $this->main_model->update_event($evaluation_id,$data);
	    redirect('main_controller/calendar_view');
	}

	function delete_event(){
		$id=$this->input->get('id');
		$this->main_model->delete_event($id);
		redirect('main_controller/calendar_view');
	}

}

?>