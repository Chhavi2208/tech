<?php
$address=$_POST['post_address'];
?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Wikipedia JSONP article summary / leading paragraphs / section 0 extraction(GET) - jsFiddle demo by gautamadude</title>
  
  <script type='text/javascript' src='//code.jquery.com/jquery-1.9.1.js'></script>
  
  
  
  
  <link rel="stylesheet" type="text/css" href="/css/result-light.css">
  
  <style type='text/css'>
    h2 {
    font-weight: bold;
}
textarea {
    width: 100%;
    height: 300px;
}
  </style>
  


<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){
//An approch to getting the summary / leading paragraphs / section 0 out of Wikipedia articlies within the browser using JSONP with the Wikipedia API: http://en.wikipedia.org/w/api.php
var title= "<?php echo $address; ?>";
var url = "http://en.wikipedia.org/wiki/" + title;
//Get Leading paragraphs (section 0)
$.getJSON("http://en.wikipedia.org/w/api.php?action=parse&page=" + title + "&prop=text&section=0&format=json&callback=?", function (data) {

    for (text in data.parse.text) {
        var text = data.parse.text[text].split("<p>");
        var pText = "";

        for (p in text) {
            //Remove html comment
            text[p] = text[p].split("<!--");
            if (text[p].length > 1) {
                text[p][0] = text[p][0].split(/\r\n|\r|\n/);
                text[p][0] = text[p][0][0];
                text[p][0] += "</p> ";
            }
            text[p] = text[p][0];

            //Construct a string from paragraphs
            if (text[p].indexOf("</p>") == text[p].length - 5) {
                var htmlStrip = text[p].replace(/<(?:.|\n)*?>/gm, '') //Remove HTML
                var splitNewline = htmlStrip.split(/\r\n|\r|\n/); //Split on newlines
                for (newline in splitNewline) {
                    if (splitNewline[newline].substring(0, 11) != "Cite error:") {
                        pText += splitNewline[newline];
                        pText += "\n";
                    }
                }
            }
        }
        pText = pText.substring(0, pText.length - 2); //Remove extra newline
        pText = pText.replace(/\[\d+\]/g, ""); //Remove reference tags (e.x. [1], [4], etc)
      // document.getElementById('textarea').value = pText
     //   document.getElementById('div_text').innerHTML = pText
	 }
var ctext=pText.replace(/ *\([^)]*\) */g, "");
	 alert("splitted");
	 var sample=ctext.split(" ");
	//	alert("checking");
		for (xyz in sample) {
                  
				  document.getElementById('textarea').value = sample[xyz];
			      alert(sample[xyz]);
				  }
});
});//]]>  
/*function myfunc()
{
document.getElementById("textarea").submit();
alert("HEY");
}*/

</script>


</head>
<body>


<h2>Insert into textarea</h2>
<form action="cc.php" method="POST">
<textarea id="textarea" name="abc" ></textarea>
<input type="submit" value="submitt">
</form>
<br>
<h2>Insert into div</h2>
<div id="div_text"></div>
 
</body>


</html>