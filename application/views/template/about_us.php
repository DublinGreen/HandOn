
<!DOCTYPE html>
<html>
<title>About Us</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style type="text/css">
	#about{
	  text-align: justify;
	  text-justify: inter-word;
	}
</style>
<body>
<!-- Page content -->
<div class="w3-content w3-padding" style="max-width:1564px;margin-top: -40px;">
  <!-- About Section -->
  <div class="w3-container w3-padding-32" id="about">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16"><?php echo $datas['name'];?></h3>
    <p><?php echo $datas['description'];?>
    </p>
  </div>
</body>
</html>
