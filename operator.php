<?php

# require_once('/home/matt/git/loggingModule/loggingClient.php');

# this will all have to be coded to pull credentials passed from DB and action
# passed from webserver
#
#
$action = "cash";

$pubkey = "PKOWHBTVHXBZXFDOY8YU";

$privkey = "sNoRCTp9cK6Y8k4jerXijbPeY15S3MkxcKE4sHGt";



switch ($action) {

		# this was my hacky way of getting php to pass the variables
	# correctly when its moved to a shell command (python)
	case 'cash': 
		$start = '/home/matt/git/DMZ/IT490/Deliverable_1_script_1.py ';
		$start .= $pubkey;
	        $start .= ' ' . $privkey;	
		$cmd = escapeshellcmd($start);
		$op = shell_exec($cmd);
		echo $op;
		break;

	case "positions":
		$start = '/home/matt/git/DMZ/IT490/Deliverable_1_script_2.py';
                $start .= $pubkey;
                $start .= ' ' . $privkey;
                $cmd = escapeshellcmd($start);
                $op = shell_exec($cmd);
                echo $op;
                break;

	
	default:
		$emsg = "no valid action for user account given";
		updateLog($emsg);

}

# $op = shell_exec($cmd);
# echo $op;

?>
