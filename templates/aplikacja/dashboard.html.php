<!DOCTYPE HTML>
<html lang="pl">
<head>

	<meta charset="utf-8" />
	<!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<title>Dashboard</title>

  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


<link rel="stylesheet" href="css/aristo/jquery-ui-1.8.5.custom.css" type="text/css" media="screen" title="no title" charset="utf-8">

<link rel="stylesheet" href="js/timeglider/Timeglider.css" type="text/css" media="screen" title="no title" charset="utf-8">

<style type='text/css'>
        /* timeline div style */
		#placement {
			width:750px;
			margin:32px auto 32px auto;
			height:400px;
		}
</style>
<!-- <style type='text/css'>
		#placement {
			/* margin:32px; */
			height:500px;
		}
</style> -->
  
</head>

<body>

	<!-- 3rd party libs -->
  <script src="js/jquery-1.4.4.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/jquery-ui-1.8.9.custom.min.js" type="text/javascript" charset="utf-8"></script>

    
		<!-- 3rd party libs -->
		<script src="js/jquery.tmpl.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/underscore-min.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/backbone-min.js" type="text/javascript" charset="utf-8"></script>

		<script src="js/ba-debug.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/jquery.mousewheel.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/jquery.ui.ipad.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/raphael-min.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/jquery.global.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/ba-tinyPubSub.js" type="text/javascript" charset="utf-8"></script>

		<!-- TIMEGLIDER -->
		<script src="js/timeglider/TG_Date.js" type="text/javascript" charset="utf-8"></script>
	    <script src="js/timeglider/TG_Org.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/timeglider/TG_Timeline.js" type="text/javascript" charset="utf-8"></script> 
		<script src="js/timeglider/TG_TimelineView.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/timeglider/TG_Mediator.js" type="text/javascript" charset="utf-8"></script> 


		<script src="js/timeglider/timeglider.timeline.widget.js" type="text/javascript" charset="utf-8"></script>
    <script src="source.js" type="text/javascript" charset="utf-8"></script>
    <script>
      var source = [
    {
    "id":"jshist",
    "title":"A little history of or Company",
    "description":"Mainly, showing the important events",
    "focus_date":"2000-07-01 12:00:00",
    "initial_zoom":"46",
    "events":[

    ]
    }
  ]
    </script>

<div>
{include file='includes/komunikaty.html' info=$info error=$error}
</div>

<div class="container" style="width: 30%; position: absolute; left: 0px;"  class="center">
{include file='includes/menuUzytkownik.html'}
{include file='includes/uzytkownikWspolnoty.html'}
</div>

<div class="container" style="width: 70%; position: absolute; left: 500px;">
  <script>
    var editButton = ''
  </script>
  


  {foreach $wydarzenia as $wydarzenie}  
    {if $rolaUzytkownika == 1}
      <script>
        var editButton = '<form action="?task=wydarzenia&action=edytujWydarzenie&idWydarzenia={$wydarzenie->getId()}" method="post"><input type="submit" class="btn btn-success" value="Edytuj" /></form>'
      </script>
    {/if}
    <script>
      
      element =       {
        "id":"{$wydarzenie->getId()}",
        "title": "{$wydarzenie->getName()}",
        "description": "{$wydarzenie->getShortDescription()} <p><b>Long description:</b> {$wydarzenie->getLongDescription()}</p>" +editButton,
        "startdate": "{$wydarzenie->getStartDate()}",
        "enddate": "{$wydarzenie->getEndDate()}",
        "date_limit":"mo",
        // "link":"http://en.wikipedia.org/wiki/JavaScript",
        "importance":"55",
        "icon":"{$wydarzenie->getType()->getIcon()}",
        "image":"{$wydarzenie->getImgUrl()}"
        }
        source[0].events.push(element)
    </script>
  {/foreach}
  <!-- <img src="images/wspolnota.jpg" alt="Italian Trulli"> -->
  


</div>

<div id='placement'></div>

<script>
console.log('source', source)
$(document).ready(function () { 

  var tg1 = $("#placement").timeline({
      "min_zoom":15, 
      "max_zoom":70,
      "data_source":source
      // "data_source": tg_data_source
  });
  
  }); // end document-ready

</script>
</body>
</html>

<style>
.container img {
   width: 80%;
} 
.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
}
</style>