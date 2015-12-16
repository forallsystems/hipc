<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery UI Datepicker - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#start_date" ).datepicker();
  });
  </script>
</head>
<body>


<form action = "event.php" method="post" />
<p>Event Name: <input type="text" name="event_name"/></p>
<p>Single or Multi Day: <select name="day_type">
  <option value="single">Single Day</option>
  <option value="multi">Multi Day</option>
</select>
<p>Start Date: <input type="text" id="start_date" name="start_date"/></p>
<p>Start Time: <input type="text" id="start_time" name="start_time"/></p>
<p>End Time: <input type="text" id="end_time" name="end_time"/></p>
<p>Event Description: <textarea type="text" name="event_description"/></textarea></p>
<p>Cost: <input type="text" name="event_cost"/></p>
<p>Location: <textarea type="text" name="event_location"/></textarea></p>
<p>Notes: <textarea type="text" name="event_notes"/></textarea></p>


<p>
<input type="submit" value="Submit" />
</form>

</body>
</html>