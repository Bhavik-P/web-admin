<?php 
$image="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";


$method=$_REQUEST['method'];
	if($method=='u_document_test'){
		$doc=$_REQUEST['file'];
		$exe=$_REQUEST['exe'];
		
		//$doc2 = str_replace(' ', '+', $doc);
		$decoded = base64_decode($doc);
		$doc_name = md5(rand()).".".$exe;
		if(file_put_contents(getcwd().'/dev_files/'.$doc_name, $decoded) ){
			$json = array("result" => "success", "response" =>"success ok");
			echo json_encode($json); 
		}
	}

	if($method=='u_document_test2'){
		//$img = $_REQUEST['answer'];
		$img = $image;
		$image = str_replace(' ', '+', $img);
		$decoded = base64_decode($image);
		$file_name = md5(microtime()).'.jpg';
		if(file_put_contents(getcwd().'/dev_files/'.$file_name, $decoded) ){
			echo "ok";
		}
	}
?>