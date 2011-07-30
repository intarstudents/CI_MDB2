<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Configuration file for CI_MDB2 library
 */

//$config["connect_method"] = "connect"; // factory or connect or singleton
//$config["object_name"] = "db"; // $CI->db

/**
 * Read more about how to set DSN (Data Source Name)
 * http://pear.php.net/manual/en/package.database.mdb2.intro-dsn.php
 */

// Set DSN as array
//$config["phptype"] 		= "mysql";
//$config["protocol"] 		= "";
//$config["hostspec"] 		= "localhost";
//$config["username"] 		= "user";
//$config["password"] 		= "pass";
//$config["database"] 		= "mdb2";
//$config["proto_opts"] 	= "";
//$config["option"] 			= "charset=utf8";

// Set DSN as string (if set will overwrite DSN array set)
//$config["dsn"] = "mysql://user:pass@localhost/mdb2?charset=utf8";

/**
 * Read more about available MDB2 options
 * http://pear.php.net/manual/en/package.database.mdb2.intro-connect.php
 */

//$config["ssl"] = false;
//$config["field_case"] = CASE_LOWER; /* CASE_LOWER or CASE_UPPER */
//$config["disable_query"] = false;
//$config["result_class"] = "";
//$config["buffered_result_class"] = "MDB2_Result_Common";
//$config["result_wrap_class"] = "MDB2_Result_Common";
//$config["result_buffering"] = false;
//$config["fetch_class"] = "";
//$config["persistent"] = true;
//$config["debug"] = 0;
//$config["debug_handler"] = "";
//$config["debug_expanded_output"] = false;
//$config["default_text_field_length"] = 0;
//$config["lob_buffer_length"] = 0;
//$config["log_line_break"] = "\n";
//$config["idxname_format"] = "";
//$config["seqname_format"] = "";
//$config["savepoint_format"] = "";
//$config["seqcol_name"] = "";
//$config["quote_identifier"] = false;
//$config["use_transactions"] = false;
//$config["decimal_places"] = false;
//$config["portability"] = MDB2_PORTABILITY_ALL ^ MDB2_PORTABILITY_EMPTY_TO_NULL; /* http://pear.php.net/manual/en/package.database.mdb2.intro-portability.php */
//$config["modules"] = array();
//$config["emulate_prepared"] = false;
//$config["datatype_map"] = array();
//$config["datatype_map_callback"] = array();
//$config["fetch_mode"] = MDB2_FETCHMODE_ASSOC; /* MDB2_FETCHMODE_ORDERED or MDB2_FETCHMODE_ASSOC or MDB2_FETCHMODE_OBJECT */