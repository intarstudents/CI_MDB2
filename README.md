CI_MDB2
===================

Library for (nicely) loading PEAR MDB2 in CodeIgniter framework.

**Installation instructions:**

0. Grab CI_MDB2 package (`git clone https://intarstudents@github.com/intarstudents/CI_MDB2.git` or https://github.com/intarstudents/CI_MDB2/archives/master).
1. Merge two folder content (`config` and `libraries`) inside your CodeIgniter `application` folder.
2. You are done.
3. ???
4. Profit!

Configuration
--------------------

CI_MDB2 isn't your regular CI library. It's more like "loader" for your MDB2 instance, so it better blends into CI hierarchy. 
When you load new CI_MDB2:

    $this->load->library('mdb2', array(
	  	"dsn" => "mysql://user:password@host/yourdb"
	  ));

It will by default create two new objects in super CI object:

* $CI->mdb2 // Loader instance
* $CI->db // MDB2 instance

From here now you don't have to load new "Loader instance" for adding new MDB2 instance (that for example connected to other database). You will just write:

    $this->mdb2->add_instance(array(
    	"dsn" => "mysql://otheruser:andpassword@differenthost/anddatabase?charset=utf8"
	  	"object_name" => "db2"
	  ));

This will create new MDB2 object `$CI->db2` that is connected to `differenthost`.