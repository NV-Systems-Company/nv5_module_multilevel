<!-- BEGIN: main -->
<script type="text/javascript" src="{script}"></script>
<link href="{NV_STATIC_URL}themes/{TEMPLATE}/css/select2.css" rel="stylesheet">
<link href="{NV_STATIC_URL}themes/{TEMPLATE}/css/select2.min.css" rel="stylesheet">
<!-- General Element -->
<div class="card mb-4">
<!-- BEGIN: error -->
<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
    - {ERROR}
</div>
			<div class="alert-danger">
				
			</div>
<!-- END: error -->
  <form action="" method="post" enctype="multipart/form-data"  >
	<input type="hidden" name ="{NV_NAME_VARIABLE}" value="{MODULE_NAME}" />
	<input type="hidden" name ="{NV_OP_VARIABLE}" value="{OP}" />
	<input name="savecat" type="hidden" value="1" />
	<input name="txtCheckss" type="hidden" value="{txtCheckss}" />
  <div class="table-responsive">
  <table class="table table-borderless">
   <thead>
    <tr>
      <th scope="col" colspan="3"><h2 class="text-center  m-0 font-weight-bold text-primary">ĐĂNG KÝ NHÀ PHÂN PHỐI</h2></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td colspan="2">
        <input type="text" required class="form-control" value="{DATA.fullname}" name="fullname" id="fullname" placeholder="{LANG.fullname}">                     
	  </td>
    </tr>
    <tr>
      <td><label class="btn btn-success mb-1" for="fileUpload_npp">
		  <i class="fa fa-file-image-o"></i>
		  <input id="fileUpload_npp" name="photo_npp" type="file" style="display:none;" />
			{LANG.image}
		  </label>
      </td>
      <td>
	        <span class="text-center" id="image-npp" >
				<!-- BEGIN: image_npp -->
				<img src="{NV_BASE_SITEURL}{NV_UPLOADS_DIR}/{MODULE_NAME}/{DATA.photo_npp}" class="photo-thumb" />
				<!-- END: image_npp -->
			</span>
			<input type="hidden" name="photo_npp" value="{DATA.photo_npp}" />
	  </td>
	</tr>
	<tr>
      <td colspan="2"><input required type="text" class="form-control" value="{DATA.address}" name="address" placeholder="{LANG.address}"></td>
	</tr>
	
    <tr>
      <td><input  required type="text" class="form-control" value="{DATA.phone}" name="phone" placeholder="{LANG.phone}"></td>
      <td><input  required type="text" class="form-control" value="{DATA.email}" name="email" placeholder="{LANG.email}"></td>
	</tr>
    <tr>
      <td><input  required type="text" class="form-control" value="{DATA.username}" name="username" placeholder="{LANG.username}"></td>
      <td><input  required type="text" class="form-control" value="{DATA.codename}" name="codename" placeholder="{LANG.code_name} của NPP"></td>
	</tr>
    <tr>
      <td><input  required type="password" class="form-control" value="{DATA.password}" name="password" placeholder="{LANG.password}"></td>
      <td><input  required type="password" class="form-control" value="{DATA.repassword}" name="repassword" placeholder="Nhập lại {LANG.password}"></td>
	</tr>
    <tr>
      <td><input  required type="text" class="form-control" value="{DATA.cccd}"  name="cccd" placeholder="{LANG.cmnd}"></td>
      <td><input  required type="text" class="form-control" value="{DATA.stknganhang}"  name="stknganhang" placeholder="{LANG.stknganhang}"></td>
	</tr>
    <tr>
      <td colspan="2">
	  <div class="form-group">
        <label for="select2Multiple">Danh sách tỉnh thành được độc quyền</label>
        <select class="select2-multiple form-control" name="list_provin[]" multiple="multiple" id="select2Multiple">
          <option value="">Lựa chọn</option>
		  <!-- BEGIN: select_province -->
		  <option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
		  <!-- END: select_province -->
        </select>
      </div>
	  </td>
	</tr>
	<tr>
      <td colspan="2" class="text-center">
	  <button type="submit" class="btn btn-success mb-1">{LANG.send_register}</button>
	  </td>
	</tr>
	
  </tbody>
  </table>
</div>
  </form>
</div>

<div class="modal" id="modalMain" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body"><span id="mess"></span></div>
      <div class="modal-footer">
	  <button type="button" class="close" data-dismiss="modal">
         <span aria-hidden="true">×</span><span class="sr-only">Close</span>
       </button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
	$('.select2-multiple').select2();
	$("#fileUpload_npp").on('change', function() {
            var imgPath = $(this)[0].value;
            var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            var image_holder = $("#image-npp");
            image_holder.empty();
            if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
                if (typeof(FileReader) != "undefined") {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $("<img />", {
                            "src": e.target.result,
                            "class": "photo-thumb"
                        }).appendTo(image_holder);
                    }
                    image_holder.show();
                    reader.readAsDataURL($(this)[0].files[0]);
                } else {
                    alert("This browser does not support FileReader.");
                }
            } else {
                alert("Pls select only images");
            }
        });
		});
	function showimage( id='' ){
		$('#mess').html('');
		$('#modalMain').modal('show');
    }
	function sendsunmit(){
        $('input[type=submit]').attr('disabled', true)
        return true;
    }
</script>
<!-- END: main -->
