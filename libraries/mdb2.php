<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CI_MDB2
 * Library for (nicely) loading PEAR MDB2 in CodeIgniter framework
 *
 * @author Intars Students
 * @copyright Copyright (c) 2011 - NOW(), Intars Students
 * @license MIT License
 * @link https://github.com/intarstudents/CI_MDB2
 * @version 1.0
 *
 */

// Load PEAR MDB2 library
if (!@include("MDB2.php"))
	if (!@include(APPPATH."third_party/MDB2.php"))
		show_error("Couldn't load PEAR MDB2 library!");

class CI_MDB2 {

	private $CI = null;
	private $default_object_name = "db";

	private $default_connect_method = "connect";
	private $connect_methods = array(
						"factory", "connect", "singleton"
					);

	private $dsn = null;
	private $dsn_keys = array(
						"phptype", "dbsyntax", "username", "password", "protocol", "hostspec", "port",
						"socket", "database", "new_link", "service", "proto_opts", "option"
					);

	private $options = array();
	private $option_keys = array(
						"ssl", "field_case", "disable_query", "result_class", "buffered_result_class", 
						"result_wrap_class", "result_buffering", "fetch_class", "persistent", "debug", 
						"debug_handler", "debug_expanded_output", "default_text_field_length", 
						"lob_buffer_length", "log_line_break", "idxname_format", "seqname_format", 
						"savepoint_format", "seqcol_name", "quote_identifier", "use_transactions", 
						"decimal_places", "portability", "modules", "emulate_prepared", "datatype_map", 
						"datatype_map_callback", "fetch_mode", "object_name", "connect_method"
					);

	public function __construct($params = array()){

		// Store CodeIgniter super global instance
		$this->CI =& get_instance();

		// Load settings from configuration file
		$this->CI->config->load("mdb2", TRUE, TRUE);
		$config = $this->CI->config->item("mdb2");

		if (!is_bool($config) && count($config)){

			if (isset($config["dsn"]) && is_string($config["dsn"]) && @parse_url($config["dsn"]) !== FALSE)
				$this->dsn = $config["dsn"];
			else
				$this->dsn = array();

			foreach($config as $n => $v){
				if (in_array($n, $this->option_keys))
					$this->options[$n] = $v;
				
				if (is_array($this->dsn) && in_array($n, $this->dsn_keys))
					$this->dsn[$n] = $v;
			}
		}

		if (isset($params["connect_method"]) && !in_array($params["connect_method"], $this->connect_methods))
			unset($params["connect_method"]);

		if (!isset($params["connect_method"]))
			$params["connect_method"] = isset($this->options["connect_method"]) && in_array($this->options["connect_method"], $this->conenct_methods) ? 
				$this->options["connect_method"] : $this->default_connect_method;

		if (isset($params["object_name"]) && !is_string($params["object_name"]))
			unset($params["object_name"]);

		if (!isset($params["object_name"]))
			$params["object_name"] = isset($this->options["object_name"]) && is_string($this->options["object_name"]) ? 
				$this->options["object_name"] : $this->default_object_name;
		
		$this->add_instance($params);
		
	}

	public function add_instance($params = array()){

		// Check if object_name isn't already taken or isn't string
		if (!isset($params["object_name"]) || (isset($params["object_name"]) && !is_string($params["object_name"])))
			show_error(get_class().": when adding new instance, you must provide 'object_name' parameter as string");
		
		if (isset($this->CI->$params["object_name"]))
			show_error(get_class().": provided 'object_name' parameter is already taken in CI global instance");

		//Set default configuration and then overwrite with instance specific
		$options = $this->options;

		if (count($params)){

			if (isset($params["dsn"]) && is_string($params["dsn"]) && !empty($params["dsn"]) && parse_url($params["dsn"]) !== FALSE)
				$dsn = $params["dsn"];
			else
				$dsn = array();

			foreach($params as $n => $v){
				if (in_array($n, $this->option_keys))
					$options[$n] = $v;
				
				if (is_array($dsn) && in_array($n, $this->dsn_keys))
					$dsn[$n] = $v;
			}

		}

		// If no DSN provided in instance specific parameters use DSN from configuration file
		if (!isset($dsn) || (isset($dsn) && !count($dsn))) $dsn = $this->dsn;

		// Set connect method
		if (!isset($options["connect_method"]) || (isset($options["connect_method"]) && !in_array($options["connect_method"], $this->connect_methods)))
			$options["connect_method"] = isset($this->options["connect_method"]) && in_array($this->options["connect_method"], $this->connect_methods) ? 
				$this->options["connect_method"] : $this->default_connect_method;
		
		$MDB2 = MDB2::$options["connect_method"]($dsn, $options);

		// Gives error message for failed connection if connect_method isn't 'factory'
		if (PEAR::isError($MDB2)){
			log_message("error", $MDB2->getMessage()." - ".$MDB2->getUserinfo());
			show_error(ENVIRONMENT != "development" ? "Couldn't connect to database!" : $MDB2->getMessage()."<br />".$MDB2->getUserinfo());
		}

		// Set MDB2 default fetch mode
		if (isset($options["fetch_mode"]))
			$MDB2->setFetchMode($options["fetch_mode"]);
		
		// Add reference for newly created MDB2 instance
		$this->CI->$params["object_name"] =& $MDB2;

	}
}