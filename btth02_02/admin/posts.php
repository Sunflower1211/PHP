


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<section id="main">
<div class="container">
<div class="row">	
<?php include "left_menus.php"; ?>
<div class="col-md-9">
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Post Listing</h3>
</div>
<div class="panel-body">
<div class="panel-heading">
<div class="row">
<div class="col-md-10">
<h3 class="panel-title"></h3>
</div>
<div class="col-md-2">
<a href="compose_post.php" 
class="btn btn-default btn-xs">Add New</a>				
</div>
</div>
</div>
<table id="postsList" class="table table-bordered table-striped">
<thead>
<tr>
<th>Title</th>
<th>Category</th>
<th>User</th>
<th>Status</th>	
<th>Created</th>
<th>Updated</th>															
<th></th>
<th></th>	
</tr>
</thead>
</table>
</div>
</div>
</div>
</div>
</div>
</section>

<script
  src="https://code.jquery.com/jquery-2.2.4.js"
  integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
  crossorigin="anonymous"></script>

<script src="js/posts.js"></script>

</body>
</html>