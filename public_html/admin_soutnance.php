<?php
require 'init.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Soutnance</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" type="text/css" href="admin.css">
  <link rel="stylesheet" type="text/css" href="css1/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
  <script src="js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/0c03620f7c.js" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {
      var calendar = $('#calendar').fullCalendar({
        editable:true,
        header:{
          left:'prev,next today',
          center:'title',
          right:'month,agendaWeek,agendaDay'
        },
        events:'soutnance/load.php',
        selectable:true,
        selectHelper:true,
        select: function(start, end, allDay) {
          var title = prompt("Enter Event Title");
          if(title) {
            var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
            $.ajax({
              url:"soutnance/insert.php",
              type:"POST",
              data:{title:title, start:start, end:end},
              success:function() {
                calendar.fullCalendar('refetchEvents');
                alert("Added Successfully");
              }
            })
          }
        },
        editable:true,
        eventResize:function(event) {
          var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
          var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
          var title = event.title;
          var id = event.id;
          $.ajax({
            url:"soutnance/update.php",
            type:"POST",
            data:{title:title, start:start, end:end, id:id},
            success:function(){
              calendar.fullCalendar('refetchEvents');
              alert('Event Update');
            }
          })
        },
        eventDrop:function(event) {
          var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
          var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
          var title = event.title;
          var id = event.id;
          $.ajax({
            url:"soutnance/update.php",
            type:"POST",
            data:{title:title, start:start, end:end, id:id},
            success:function() {
              calendar.fullCalendar('refetchEvents');
              alert("Event Updated");
            }
          });
        },
        eventClick:function(event) {
          if(confirm("Are you sure you want to remove it?")) {
            var id = event.id;
            $.ajax({
              url:"soutnance/delete.php",
              type:"POST",
              data:{id:id},
              success:function() {
                calendar.fullCalendar('refetchEvents');
                alert("Event Removed");
              }
            })
          }
        }
      });
    });
  </script>
</head>
<body>
  <?php include("admin_navbar.php"); ?>
  <br />
  <h2 align="center"><a href="Soutnance/liste.php">Calendrier</a></h2>
  <br />
  <div class="container">
    <div id="calendar"></div>
  </div>
</body>
</html>
