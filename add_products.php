<?php session_start(); 

?>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<div class="container-fluid">
	<form action="" id="add-product-frm">
		

        <div class="form-group">
            <label class="control-label">Product Name</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="form-group">
            <label class="control-label">Product Description</label>
            <textarea cols="30" rows="3" class="form-control" name="description"></textarea>
        </div>
        <div class="form-group">
            <label class="control-label">Price</label>
            <input type="number" class="form-control text-right" name="price" step="any">
        </div>
        <div class="form-group">
            <label for="" class="control-label">Image</label>
            <input type="file" class="form-control" name="img" onchange="displayImg(this,$(this))">
        </div>
        <div class="form-group">
            <img src="<?php echo isset($image_path) ? './assets/img/'.$cover_img :'' ?>" alt="" id="cimg">
        </div>	
		
		<button class="button btn btn-info btn-sm">Create</button>
	</form>
</div>

<style>
	#uni_modal .modal-footer{
		display:none;
	}

	img#cimg,.cimg{
		max-height: 10vh;
		max-width: 6vw;
	}
	td{
		vertical-align: middle !important;
	}
	td p{
		margin: unset !important;
	}
	.custom-switch,.custom-control-input,.custom-control-label{
		cursor:pointer;
	}
	b.truncate {
		 overflow: hidden;
   text-overflow: ellipsis;
   display: -webkit-box;
   -webkit-line-clamp: 3; 
   -webkit-box-orient: vertical;	
    font-size: small;
    color: #000000cf;
    font-style: italic;
}
</style>


<script>
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	/*$('#add-product-frm').submit(function(e){
		e.preventDefault()
		start_load()
		$('#add-product-frm button[type="submit"]').attr('disabled',true).html('Logging in...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'admin/ajax.php?action=save_menu',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#add-product-frm button[type="submit"]').removeAttr('disabled').html('Login');

			},
			success:function(resp){
				if(resp == 1){
					//location.href ='<?php //echo isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php?page=home' ?>';
					alert_toast("Data successfully added",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}
			}
		})
	})*/

	$('#add-product-frm').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'admin/ajax.php?action=save_menu',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					/*alert_toast("Data successfully added",'success')
					setTimeout(function(){
						location.reload()
					},1500)*/
					console.log("1 presseds")
					location.href = 'index.php?page=home' ;
					//window.location.replace('index.php?page=home');


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
	
</script>