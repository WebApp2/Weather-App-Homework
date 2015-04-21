

<?php

File::requireOnce('C:\xampp\htdocs\laravel\laravel\app\views\weather_app\style.css');


?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>



<!--Form gets sent to chart, php in ampchart will call ChartData.php function -->
<form class="form-horizontal" action="showChart">
<fieldset>
<table>
	<tr>
		<td>
<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="graphName"><span id="graphTitle_span">Provide Graph Title:</span></label></td><td>
  <div class="controls">
     <div class="form-group">
      
      <input type="text" class="form-control" id="graphName" name="graphName" placeholder="Ex. Prof Oij's Weather Data">

      </div>
    </td>
  </div>
</div></tr>

<!-- Multiple Checkboxes --><tr><td>
<div class="control-group">
  <label class="control-label" for="">Select Month:</label></td><td>
  <div class="controls">

     <label class="radio">
    <input type='radio' name='monthData' value='jan' /> January
  </label>

  <label class="radio">
      <input type='radio' name='monthData' value='feb' /> February
      </label>

      <label class="radio">
      <input type='radio' name='monthData' value='march' /> March
      </label>

      <label class="radio">
      <input type='radio' name='monthData' value='april' /> April
      </label>
<!-- Multiple Checkboxes --><tr><td>
<div class="control-group">
  <label class="control-label" for="">Select Option(s):</label></td><td>
  <div class="controls">
    <label class="checkbox" for="showWhat-0">
      <input name="ShowAverage" id="showWhat-0" value="Show Average?" type="checkbox">
      Show Average?
    </label>
    <label class="checkbox" for="showWhat-1">
      <input name="ShowLow" id="showWhat-1" value="Show Low?" type="checkbox">
      Show Low?
    </label>
    <label class="checkbox" for="showWhat-2">
      <input name="ShowHigh" id="showWhat-2" value="Show High?" type="checkbox">
      Show High?
    </label>
  </div></td></td></tr>
</div>
  </div></td></td></tr>
 
</div>

<tr>
	<td colspan="2">
<!-- Button -->
<div class="control-group">
  <label class="control-label" for="showGraphs"></label>
  <div class="controls">
    <button id="showGraphs" name="showGraphs" class="btn btn-default">Show Graph</button>
  </div>
</div>
</td></tr>
</table>

</fieldset>
</form>
</body></html>