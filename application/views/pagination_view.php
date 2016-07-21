

<html>
<head>
<title>Codelgniter pagination</title>
</head>
<body>
<div class="main">
<div id="content">
<h3 id='form_head'>Codelgniter Pagination Example </h3><br/>
<hr>
<div id="form_input">
<?php

// Show data
foreach ($results as $data) {
echo "<label> Job ID </label>" . "<div class='input_id'>" . $data->jobID . "</div>"
. "<label> Job Description</label> " . "<div class='input_desc'>" . $data->jobDescription . "</div>"
. "<label> Start Date </label>" . "<div class='input_sdate'>" . $data->startDate . "</div>"
. "<label> Finish Date </label>" . "<div class='input_fdate'>" . $data->finishDate . "</div>"
. "<label> Job Status </label> " . "<div class='input_country'>" . $data->jobStatus . "</div>";
}
?>
</div>
<div id="pagination">
<ul class="tsc_pagination">

<!-- Show pagination links -->
<?php foreach ($links as $link) {
echo "<li>". $link."</li>";
} ?>
</div>
</div>
</div>
</body>
</html>

