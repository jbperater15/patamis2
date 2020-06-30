<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once (APPPATH.'libraries/google-api-php-client/src/Google_Client.php');
require_once (APPPATH.'libraries/google-api-php-client/src/contrib/Google_DriveService.php');
require_once (APPPATH.'libraries/google-api-php-client/src/contrib/Google_Oauth2Service.php');
class Gdrive extends CI_Controller {

	public function __construct() {
        Parent::__construct();
        //$this->load->model("main_model");
        date_default_timezone_set('asia/manila');
    }
	
	public function index()
	{
		session_start();
		$url_array = explode('?', 'http://'.$_SERVER ['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		$url = $url_array[0];
		

		$client = new Google_Client();
		$client->setClientId('863284018800-kt6vu2rsmolcgri8a8f6fsjaj3a0tq68.apps.googleusercontent.com');
		$client->setClientSecret('8sJoFcVoDyEDKjm0P8H8Jq9s');
		$client->setRedirectUri($url);
		$client->setScopes(array('https://www.googleapis.com/auth/drive','https://www.googleapis.com/auth/drive.file','https://www.googleapis.com/auth/drive.appdata','https://docs.google.com/feeds','https://spreadsheets.google.com/feeds'));
		if (isset($_GET['code'])) {
		    $_SESSION['accessToken'] = $client->authenticate($_GET['code']);
		    header('location:'.$url);exit;
		} elseif (!isset($_SESSION['accessToken'])) {
		    $client->authenticate();
		}

		$client->setAccessToken($_SESSION['accessToken']);
    	$service = new Google_DriveService($client);
    	$parameters['q'] = "trashed=false and parents='1_j-tnQY_7rFGVuv4QvlLu9-VzktuM7sC'";
    	$files['data'] = $service->files->listFiles($parameters);
    	/*foreach ($files['items'] as $item) {
        //echo $item['alternateLink'].'<br>';
        echo '<tr><td><img src="'. $item['iconLink'] .'"/><a href="'. $item['alternateLink'] .'"> '. $item['title'] .' id = '. $item['id'] .'.</a></td></tr><button>try</button><br>';

        }*/
        $this->load->view('gdrive2/gdrive', $files);
	}
	function try()
	{
		$this->load->view('google_drive/try');
	}

	function insert()
	{
		session_start();
		$url_array = explode('?', 'http://'.$_SERVER ['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		$url = $url_array[0];
		

		$client = new Google_Client();
		$client->setClientId('863284018800-kt6vu2rsmolcgri8a8f6fsjaj3a0tq68.apps.googleusercontent.com');
		$client->setClientSecret('8sJoFcVoDyEDKjm0P8H8Jq9s');
		$client->setRedirectUri($url);
		$client->setScopes(array('https://www.googleapis.com/auth/drive','https://www.googleapis.com/auth/drive.file','https://www.googleapis.com/auth/drive.appdata','https://docs.google.com/feeds','https://spreadsheets.google.com/feeds'));
		if (isset($_GET['code'])) {
		    $_SESSION['accessToken'] = $client->authenticate($_GET['code']);
		    header('location:'.$url);exit;
		} elseif (!isset($_SESSION['accessToken'])) {
		    $client->authenticate();
		}

		//echo $this->input->post('file');
		//$file_name = echo $this->input->post('file');

		$client->setAccessToken($_SESSION['accessToken']);
	    $service = new Google_DriveService($client);
	    //$service = new Google_DriveService($client);
	    
	    $file = new Google_DriveFile();
	    
	    $file_name = (string) $this->input->post('file');

	    $temp_file = tempnam(sys_get_temp_dir(), 'Tux');  
		file_put_contents($temp_file , $this->input->post('file'));

		$finfo = finfo_open(FILEINFO_MIME_TYPE);
	    $file_path = $this->input->post('file');
	    $mime_type = finfo_file($finfo, $temp_file);
	    //$mime_type = mime_content_type($file_path);
	    $file->setTitle($file_name);
	    $file->setDescription('This is a '.$mime_type.' document');
	    $file->setMimeType($mime_type);
	    //$file->setMimeType('application/vnd.google-apps.folder');
	    $parent = new Google_ParentReference();
	    $parent->setId('1_j-tnQY_7rFGVuv4QvlLu9-VzktuM7sC');
	    $file->setParents(array($parent));
	    $service->files->insert(
	    $file,
	        array(
	        'data' => $file_path,
	            'mimeType' => $mime_type //'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
	        )
	    );
	    
	    //finfo_close($finfo);
	}
}
