<?php
$place=$_POST['post_address'];
?>
<html>
<head>

</head>
<body>


<p><img src="logog.jpg" width="500" height="300" name="slide"></p>
<script src="jquery-2.1.1.min.js"></script>
<script type="text/javascript">
//alert("Hey");
/*var image1 = new Image()
image1.src = "images/a.jpg"
var image2 = new Image()
image2.src = "images/b.jpg"*/
var imgArray = new Array();
i=1;
var pl= "<?php echo $place; ?>";
$(document).ready(function(){
$.getJSON("http://en.wikipedia.org/w/api.php?action=query&titles=" + pl + "&generator=images&gimlimit=10&prop=imageinfo&iiprop=url|dimensions|mime&format=json&callback=?",function (data){

//var ctext=data;
//var data=ctext.split("/**/");

	for(var start=-1;start>-7;start--)
   {var imagess= (data['query']['pages'][start]["imageinfo"][0]['url']);

//var imgArray = new Array();
//alert("Hey");
imgArray[start+i] = new Image();
imgArray[start+i].src = imagess;
//alert(imgArray[start+i].src);
i=i+2;
}

//})
        var step=0;
        function slideit()
        {
		// alert(imgArray[step].src);
		//alert(step);
		console.log(step);
            document.images.slide.src = eval("imgArray["+step+"].src");
            //if(step<2)
               step++;
            //else
              //  step=1;
            //setTimeout(slideit(),2500);
		//for(var k=0;k<100000000;k++);
        }
		setInterval(function(){
		document.images.slide.src = eval("imgArray["+step+"].src");
            //if(step<2)
               step++;
		
		},2500);
		//for(step;step<4;step++)
        slideit();
		
		});
		});
		
</script>
<form>
<a href="http://localhost/excal/hotel.html">
<input type="button"  value="hotel">
</a>
</form>
<form >
<a href="http://localhost/excal/streetview.html">
<input type="button"  value="placedetails">
</a>
</form>
<form>
<a href="http://localhost/excal/last5.html">
<input type="button"  value="weather">
</a>
</form>
</body>
</html>

