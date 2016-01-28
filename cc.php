<?php
$text=$_POST['abc'];
//$text = "Delhi also known as the National Capital Territory of India is the capital of India. Such is the nature of urban expansion in Delhi.";
    $text = urlencode($text);
    $lang = urldecode("en");
    $file  = "audio/" . md5($text) .".mp3";
       if (!file_exists($file) || filesize($file) == 0) {
         $mp3 = file_get_contents('http://translate.google.com/translate_tts?ie=UTF-8&q='.$text.'&tl='.$lang.'&total=2&idx=0&textlen='.strlen($text).'&prev=input');
         if(file_put_contents($file, $mp3)){
            echo "Saved<br>";
         }else{
            echo "Wasn't able to save it !<br>";
         }
       } else {
         echo "Already exist<br>";
       }
	   ?>
	   <audio controls="controls" autoplay="autoplay">
<source src="<?php echo $file; ?>" type="audio/mp3" />

  
</audio>