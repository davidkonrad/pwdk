<?php

include '../../lib/Gingalain.php';

if (isset($_FILES['file']['name'])) {
	$filename = $_FILES['file']['name'];
	$location = '../../bundles/tmp/'.$filename;
	$ext = pathinfo($location, PATHINFO_EXTENSION);

	if ($ext !== 'bundle') {
		echo json_encode( array('error' => 'File must be of type .bundle'));
		return;
	}

	if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
		$json = JSON::get($location);
		if (isset($json->error)) {
			echo json_encode( $json );
			return;
		}

		if (!isset($json->bundle)) {
			echo json_encode( array('error' => '"bundle" property missing'));
			return;
		}

		if (!isset($json->bundle->name) || empty($json->bundle->name)) {
			echo json_encode( array('error' => '"name" property required'));
			return;
		}

		$head = isset($json->bundle->head) && !empty($json->bundle->head);
		$last = isset($json->bundle->last) && !empty($json->bundle->last);
		if ($head == false && $last == false) {
			echo json_encode( array('error' => 'At least one not empty "head" or "last" section required', 'head' => $head, 'last' => $last));
			return;
		}

		echo json_encode( $json->bundle );
		return;

	} else {
		echo json_encode( array('error' => 'Failed to upload file to server'));
		return;
	}

	echo json_encode( array('error' => 'Something want wrong'));
}

?>
