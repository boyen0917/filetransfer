<?php 

if(@$_POST['opt'] == "update"){

 $filename = "../files/file_list.json";
 
 $fp=fopen($filename,"w");
 fputs($fp,$_POST["json_string"]);
 fclose($fp);
 exit;
}


if(isset($_GET['files']))
{

  $myfile = fopen("post123.log", "w") or die("Unable to open file!");
  fwrite($myfile, json_encode($_FILES,JSON_PRETTY_PRINT));
  fclose($myfile);
  
 $error = false;
 $files = array();
 
 $file_path='../files/';
  
 foreach($_FILES as $file)
 {
  $tmp = explode('.', $file['name']);
  $ext = end($tmp);
  if($ext == 'ipa')
  {
   $new_filename = 'ios.ipa';
//    $log_file_type = 'ios';
  }
  elseif($ext == 'plist')
  {
   $new_filename = 'ios.plist';
  }
  else
  {
   $new_filename = 'android.apk';
  }

  if(move_uploaded_file($file['tmp_name'], $file_path.$new_filename))
  {
   $files[] = $file_path .$new_filename;
   
    echo  $file_path .$new_filename;
  }
  else
  {
   $error = true;
echo "There was an error uploading your files";
  }
 }
 $data = ($error) ? array('error' => 'There was an error uploading your files') : array('files' => $files);
}

//echo json_encode($data);

?>
