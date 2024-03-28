<?php 
	// defined('C5_EXECUTE') or die("Access Denied.");
		
	$json = Loader::helper('json');
	
	$bt = BlockType::getByHandle('planning_tool');	
	if (!is_object($bt))
		return false;

	$cnt = $bt->getController();
		
	switch ($_REQUEST['action'])
	{				
		case 'get_persons':		
			$r = $cnt->getPersons();
		break;
		
		case 'reset':
			$r = $cnt->reset();
		break;
			
	}
	
	if (!is_array($r)) {
		header('Content-type: text/html');
		echo $bt->display();
	} else {
		header('Content-type: application/json');
		echo $json->encode($r);	
	}
	
?>