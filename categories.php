<?php include('db_connect.php');?>

<div class="container-fluid">

<div class="col-lg-12">
<div class="row">
<!-- FORM Panel -->
<div class="col-md-6">
<form action="" id="manage-category">
<div class="card">
<div class="card-header">
Category Form
</div>
<div class="card-body">
<input type="hidden" name="id">
<div class="form-group">
<label class="control-label">Category</label>
<input type="text" class="form-control" name="category">
</div>
</div>
<div class="card-footer">
<div class="row">
<div class="col-md-12">
<button class="btn btn-sm btn-primary col-sm-2"> Save</button>
<button class="btn btn-sm btn-default col-sm-2" type="button" onclick="$('#manage-category').get(0).reset()"> Cancel</button>
</div>
</div>
</div>
</div>
</form>
</div>
<!-- FORM Panel -->

<!-- Table Panel -->
<div class="col-md-6">
<div class="card">
<div class="card-body">
<table class="table table-bordered table-hover">
<thead>
<tr>
<th class="text-center">#</th>
<th class="text-center">Category</th>
<th class="text-center">Action</th>
</tr>
</thead>
<tbody>
<?php 
$i = 1;
$cats = $conn->query("SELECT * FROM category_list order by id asc");
while($row=$cats->fetch_assoc()):
?>
<tr>
<td class="text-center"><?php echo $i++ ?></td>
<td class="text-center"><?php echo $row['category'] ?></td>
<td class="text-center">
<button class="btn btn-sm btn-primary edit_cat" type="button" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['category'] ?>">Edit</button>
<button class="btn btn-sm btn-danger delete_cat" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
</div>
</div>
<!-- Table Panel -->
</div>
</div>	

</div>
<script>
$('#manage-category').submit(function(e){
e.preventDefault()
start_load()
$.ajax({
url:'ajax.php?action=save_category',
method:'POST',
data:$(this).serialize(),
success:function(resp){
if(resp==1){
alert_toast("Data successfully added",'success')
setTimeout(function(){
location.reload()
},1500)

}
else if(resp==2){
alert_toast("Data successfully updated",'success')
setTimeout(function(){
location.reload()
},1500)

}
}
})
})
$('.edit_cat').click(function(){
start_load()
var cat = $('#manage-category')
cat.get(0).reset()
cat.find("[name='id']").val($(this).attr('data-id'))
cat.find("[name='category']").val($(this).attr('data-name'))
end_load()
})
$('.delete_cat').click(function(){
_conf("Are you sure to delete this category?","delete_cat",[$(this).attr('data-id')])
})
function delete_cat($id){
start_load()
$.ajax({
url:'ajax.php?action=delete_category',
method:'POST',
data:{id:$id},
success:function(resp){
if(resp==1){
alert_toast("Data successfully deleted",'success')
setTimeout(function(){
location.reload()
},1500)

}
}
})
}
</script>