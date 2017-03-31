<?php
header("Access-Control-Allow-Origin: *");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $editor     = $_POST['editor'];
    $customtext = $_POST['customtext'];
    $filename   = $_POST['filename'];
    $mode       = $_POST['mode'];
    $withoutExt = pathinfo($filename, PATHINFO_FILENAME);
    #echo $withoutExt;

    $filecreate = "/tmp/".$filename ;
    #echo $filecreate;
    if ($mode == "python") {
        
        $myfile = fopen($filecreate, "w") or die("Unable to open file!");
        fwrite($myfile, base64_decode($editor));
        fclose($myfile);
        $code   = "python $filecreate 2>&1";
        $output = shell_exec($code);
        $output = base64_encode($output);
        echo $output;
        
        
    }
    if ($mode == "java") {
        #echo "java";        
        $myfile = fopen($filecreate, "w") or die("Unable to open file!");
        fwrite($myfile, base64_decode($editor));
        fclose($myfile);
        $code   = "javac $filecreate 2>&1";
        $output = shell_exec($code);
        $code   = "java -classpath /tmp ".$withoutExt." 2>&1";
        #echo $code;
        $output = shell_exec($code);
        $output = base64_encode($output);
        echo $output;
        
        
    }

    if ($mode == "php") {
        
        $myfile = fopen($filecreate, "w") or die("Unable to open file!");
        fwrite($myfile, base64_decode($editor));
        fclose($myfile);
        $code   = "php $filecreate 2>&1";
        $output = shell_exec($code);
        $output = base64_encode($output);
        echo $output;
        
        
    }
    
    
}

?>