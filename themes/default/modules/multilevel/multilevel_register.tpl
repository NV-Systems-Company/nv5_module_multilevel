<!-- BEGIN: registerok -->
	
<!-- END: registerok -->
<!-- BEGIN: main -->
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />

<div id="register" class="bg1">
			<ol class="steps">
                <li class="step {DATA.act1}" data-step="1">Đăng ký</li>
                <li class="step {DATA.act3}" data-step="2">Hoàn thành</li>
            </ol>
			
			<!-- BEGIN: error -->
			<div class="alert-danger">
				- {ERROR}
			</div>
			<!-- END: error -->
			
            <div class="container">
			
			<form class="well form-horizontal" enctype="multipart/form-data" onsubmit="return sendsunmit();" action="{NV_BASE_SITEURL}" method="post">
			<input type="hidden" name ="{NV_NAME_VARIABLE}" value="{MODULE_NAME}" />
			<input type="hidden" name ="{NV_OP_VARIABLE}" value="{OP}" />
			<input type="hidden" name ="userid" value="{DATA.userid}" />
			<input name="savecat" type="hidden" value="1" />
			
				<input type="hidden" name="txtCheckss" value="{checkss}">
                        <!-- Form Name -->
                        <legend>
                            <center>
                                <h2><b>{DATA.title}</b></h2>
                            </center>
                        </legend>
                        <br />
				<!-- BEGIN: step1 -->
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-8 control-label">{LANG.fullname}: </label>
                            <div class="col-md-16 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon">*</span>
                                    <input
                                        name="fullname"
                                        placeholder="{LANG.fullname}"
                                        class="form-control"
                                        type="text" value="{DATA.fullname}"
                                    />
                                </div>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label class="col-md-8 control-label">CMNN/CCCD: </label>
                            <div class="col-md-16 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon">*</span>
                                    <input
                                        name="cccd"
                                        placeholder="Nhập số CMND/CCCD"
                                        class="form-control"
                                        type="text" value="{DATA.cccd}"
                                    />
                                </div>
                            </div>
                        </div>
						<div class="form-group">
							<label class="col-md-8 control-label">Giới tính</label>
                            <div class="col-md-16 selectContainer">
                                <div class="input-group">
                                    <span class="input-group-addon">*</span>
									<select class="form-control chosen-select" name="gender">
										<!-- BEGIN: gender -->
										<option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
										<!-- END: gender -->
									</select>
                                </div>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-md-8 control-label">Số điện thoại</label>

                            <div class="col-md-16 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon">*</span>
                                    <input name="contact" placeholder="(+84)" class="form-control" type="text" value="{DATA.contact}"/>
                                </div>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-md-8 control-label">Tài Khoản </label>
                            <div class="col-md-16 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon">*</span>
                                    <input
                                        name="username_ctv"
                                        placeholder="Nhập tên tài khoản"
                                        class="form-control"
                                        type="text" value="{DATA.username_ctv}"
                                    />
                                </div>
                            </div>
                        </div>
						<div class="form-group">
							<label class="col-md-8 control-label">Email</label>
							<div class="col-md-16 inputGroupContainer">
								<div class="input-group">
                                    <span class="input-group-addon">*</span>
									<input type="email" class="required form-control" placeholder="{LANG.email}" value="{DATA.email}" name="email" maxlength="100" onkeypress="validErrorHidden(this);" data-mess="{GLANG.email_empty}">
							</div></div>
						</div>

						<div class="form-group">
							<label class="col-md-8 control-label">Mật khẩu</label>
							<div class="col-md-16 inputGroupContainer">
								<div class="input-group">
                                    <span class="input-group-addon">*</span>
								<input type="password" autocomplete="off" value="{DATA.password}" class="password form-control"  name="password" >
							</div></div>
						</div>

						<div class="form-group">
							<label class="col-md-8 control-label">Nhập lại mật khẩu</label>
							<div class="col-md-16 inputGroupContainer">
								<div class="input-group">
                                    <span class="input-group-addon">*</span>
								<input type="password" value="{DATA.re_password}" autocomplete="off" class="re-password form-control" name="re_password">
							</div></div>
						</div>
                        

                        <div class="form-group">
                            <label class="col-md-8 control-label">Mã giới thiệu</label>
                            <div class="col-md-16 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon">*</span>
                                    <input name="nguoigioithieu" placeholder="" class="form-control" type="text" value="{DATA.nguoigioithieu}"/>
                                </div>
                            </div>
                        </div>
						<!-- Success message -->
                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-8 control-label"></label>
                            <div class="col-md-8">
                                <button type="submit" class="btn-register">Đăng ký</button>
                            </div>
                        </div>
				<!-- END: step1 -->
				
				<!-- BEGIN: step2 -->
						<!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-8 control-label">Ngày cấp CMND/CCCD: </label>
                            <div class="col-md-16 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon">*</span>
                                    <input
                                        name="ngaycap" id="ngaycap" 
                                        placeholder="dd/mm/yyyy"
                                        class="form-control"
                                        type="text"
										value="{DATA.ngaycap}"
                                    />
                                </div>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-md-8 control-label">Nơi cấp: </label>
                            <div class="col-md-16 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon">*</span>
                                    <input
                                        name="noicap"
                                        placeholder="Nơi cấp CMND/CCCD"
                                        class="form-control"
                                        type="text" value="{DATA.noicap}"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-8 control-label">{LANG.address}:</label>
                            <div class="col-md-16 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon">*</span>
                                    <input name="address" placeholder="{LANG.address}" class="form-control" type="text" value="{DATA.address}"/>
                                </div>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-md-8 control-label">{LANG.province_select}:</label>
                            <div class="col-md-16 inputGroupContainer">
                                <div class="input-group">
                                    <select onchange="nv_load_district('districtid', 0)" class="form-control chosen-select" name="provinceid">
										<option value=""> --- </option>
										<!-- BEGIN: select_province -->
										<option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
										<!-- END: select_province -->
									</select>
                                </div>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-md-8 control-label">{LANG.district_select}:</label>
                            <div class="col-md-16 inputGroupContainer">
                                <div class="input-group">
                                    <div id="load_district">
										<select  class="form-control" name="districtid" id="district" style="width:100%;" tabindex="2">
											<option value="0"> --- </option>
										</select>
									</div>
                                </div>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label class="col-md-8 control-label">{LANG.cmnd_1}:</label>
                            <div class="col-md-16 inputGroupContainer">
                                <div class="input-group">
								<label class="btn btn-success fileinput-button" for="fileUpload_befor">
									<i class="fa fa-file-image-o"></i>
									<input id="fileUpload_befor" name="photo_befor" type="file" style="display:none;" />
									{LANG.select_file}
								</label>
								<div id="image-befor">
									<!-- BEGIN: image_befor -->
									<img src="{NV_BASE_SITEURL}{NV_UPLOADS_DIR}/{MODULE_NAME}/{DATA.photo_befor}" class="photo-thumb" />
									<!-- END: image_befor -->
								</div>
								<input type="hidden" name="photo_befor" value="{DATA.photo_befor}" />
								</div>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-md-8 control-label">{LANG.cmnd_2}:</label>
								<div class="col-md-16 inputGroupContainer">
									<div class="input-group">
									<label class="btn btn-success fileinput-button" for="fileUpload_after">
								<i class="fa fa-file-image-o"></i>
								<input id="fileUpload_after" name="photo_after" type="file" style="display:none;" />
								{LANG.select_file}
							</label>
							<div id="image-after">
								<!-- BEGIN: image_after -->
								<img src="{NV_BASE_SITEURL}{NV_UPLOADS_DIR}/{MODULE_NAME}/{DATA.photo_after}" class="photo-thumb" />
								<!-- END: image_after -->
							</div>
							<input type="hidden" name="photo_after" value="{DATA.photo_after}" />
								</div>
                            </div>
                        </div>
                        <!-- Text input-->
						<!-- Success message -->
                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-8 control-label"></label>
                            <div class="col-md-8">
                                <button type="submit" class="btn-register">Đăng ký</button>
                            </div>
                        </div>
						<!-- END: step2 -->
						<!-- BEGIN: step3 -->
						
			<div class="alert-success" style="padding: 15px;margin-bottom: 18px;">
				<p>{LANG.reg1}</p>
			</div>
			<div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <tr>
                    <td>{LANG.username}:</td><td><strong>{DATA.username}</strong></td>
                </tr> 
				<tr>
                    <td>{LANG.fullname}:</td><td>{DATA.fullname}</td>
                </tr>
				
				<tr>
                    <td>{LANG.cmnd}:</td><td>{DATA.numbercard}</td>
                </tr>
				<tr>
                    <td>{LANG.gender}</td><td>{DATA.gender}</td>
                    
                </tr>
                <tr>
                    <td>{LANG.phone}</td><td>{DATA.mobile}</td>
                </tr>
				<tr>
                    <td>{LANG.email}</td><td>{DATA.email}</td>
                </tr>
				<tr>
                    <td>{LANG.refer_name}</td><td>{DATA.usernameparent}</td>
                </tr>
                <tr>
                    <td>{LANG.ngaycap}</td><td>{DATA.daterange}</td>
                </tr>
				<tr>
                    <td>Nơi cấp</td><td>{DATA.issuedby}</td>
                </tr>
                </tbody>
            </table>
        </div>
		<!-- END: step3 -->
		<!-- BEGIN: step4 -->
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-8 control-label">{LANG.product_device_code}: </label>
                            <div class="col-md-16 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon">*</span>
                                    <input
                                        name="affiliate_code"
                                        placeholder="{LANG.product_device_code}"
                                        class="form-control"
                                        type="text" value="{DATA.affiliate_code}"
                                    />
                                </div>
                            </div>
                        </div>
						
						<div class="form-group">
							<label class="col-md-8 control-label">Giới tính</label>
                            <div class="col-md-16 selectContainer">
                                <div class="input-group">
                                    <span class="input-group-addon">*</span>
									<select class="form-control chosen-select" name="gender">
										<!-- BEGIN: gender -->
										<option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
										<!-- END: gender -->
									</select>
                                </div>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-md-8 control-label">Số điện thoại</label>

                            <div class="col-md-16 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon">*</span>
                                    <input name="contact" placeholder="(+84)" class="form-control" type="text" value="{DATA.contact}"/>
                                </div>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label class="col-md-8 control-label">CMNN/CCCD: </label>
                            <div class="col-md-16 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon">*</span>
                                    <input
                                        name="cccd"
                                        placeholder="Nhập số CMND/CCCD"
                                        class="form-control"
                                        type="text" value="{DATA.cccd}"
                                    />
                                </div>
                            </div>
                        </div>
						<!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-8 control-label">Ngày cấp CMND/CCCD: </label>
                            <div class="col-md-16 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon">*</span>
                                    <input
                                        name="ngaycap" id="ngaycap" 
                                        placeholder="dd/mm/yyyy"
                                        class="form-control"
                                        type="text"
										value="{DATA.ngaycap}"
                                    />
                                </div>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-md-8 control-label">Nơi cấp: </label>
                            <div class="col-md-16 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon">*</span>
                                    <input
                                        name="noicap"
                                        placeholder="Nơi cấp CMND/CCCD"
                                        class="form-control"
                                        type="text" value="{DATA.noicap}"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-8 control-label">{LANG.address}:</label>
                            <div class="col-md-16 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon">*</span>
                                    <input name="address" placeholder="{LANG.address}" class="form-control" type="text" value="{DATA.address}"/>
                                </div>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-md-8 control-label">{LANG.province_select}:</label>
                            <div class="col-md-16 inputGroupContainer">
                                <div class="input-group">
                                    <select onchange="nv_load_district('districtid', 0)" class="form-control chosen-select" name="provinceid">
										<option value=""> --- </option>
										<!-- BEGIN: select_province -->
										<option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
										<!-- END: select_province -->
									</select>
                                </div>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-md-8 control-label">{LANG.district_select}:</label>
                            <div class="col-md-16 inputGroupContainer">
                                <div class="input-group">
                                    <div id="load_district">
										<select  class="form-control" name="districtid" id="district" style="width:100%;" tabindex="2">
											<option value="0"> --- </option>
										</select>
									</div>
                                </div>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label class="col-md-8 control-label">{LANG.cmnd_1}:</label>
                            <div class="col-md-16 inputGroupContainer">
                                <div class="input-group">
								<label class="btn btn-success fileinput-button" for="fileUpload_befor">
									<i class="fa fa-file-image-o"></i>
									<input id="fileUpload_befor" name="photo_befor" type="file" style="display:none;" />
									{LANG.select_file}
								</label>
								<div id="image-befor">
									<!-- BEGIN: image_befor -->
									<img src="{NV_BASE_SITEURL}{NV_UPLOADS_DIR}/{MODULE_NAME}/{DATA.photo_befor}" class="photo-thumb" />
									<!-- END: image_befor -->
								</div>
								<input type="hidden" name="photo_befor" value="{DATA.photo_befor}" />
								</div>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-md-8 control-label">{LANG.cmnd_2}:</label>
								<div class="col-md-16 inputGroupContainer">
									<div class="input-group">
									<label class="btn btn-success fileinput-button" for="fileUpload_after">
								<i class="fa fa-file-image-o"></i>
								<input id="fileUpload_after" name="photo_after" type="file" style="display:none;" />
								{LANG.select_file}
							</label>
							<div id="image-after">
								<!-- BEGIN: image_after -->
								<img src="{NV_BASE_SITEURL}{NV_UPLOADS_DIR}/{MODULE_NAME}/{DATA.photo_after}" class="photo-thumb" />
								<!-- END: image_after -->
							</div>
							<input type="hidden" name="photo_after" value="{DATA.photo_after}" />
								</div>
                            </div>
                        </div>
                        <!-- Text input-->
						<!-- Success message -->
                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-8 control-label"></label>
                            <div class="col-md-8">
                                <button type="submit" class="btn-register">Đăng ký</button>
                            </div>
                        </div>
				<!-- END: step4 -->
				<!-- BEGIN: step5 -->
						
			<div class="alert-success" style="padding: 15px;margin-bottom: 18px;">
				<p>{LANG.reg2}</p>
			</div>
			<div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
				<tr>
                    <td>{LANG.affiliate_code}:</td><td><strong>{DATA.affiliate_code}</strong></td>
                </tr> 
                <tr>
                    <td>{LANG.username}:</td><td><strong>{DATA.username}</strong></td>
                </tr> 
				<tr>
                    <td>{LANG.fullname}:</td><td>{DATA.fullname}</td>
                </tr>
				
				<tr>
                    <td>{LANG.cmnd}:</td><td>{DATA.numbercard}</td>
                </tr>
				<tr>
                    <td>{LANG.gender}</td><td>{DATA.gender}</td>
                    
                </tr>
                <tr>
                    <td>{LANG.phone}</td><td>{DATA.mobile}</td>
                </tr>
				<tr>
                    <td>{LANG.email}</td><td>{DATA.email}</td>
                </tr>
				<tr>
                    <td>{LANG.refer_name}</td><td>{DATA.usernameparent}</td>
                </tr>
                <tr>
                    <td>{LANG.ngaycap}</td><td>{DATA.daterange}</td>
                </tr>
				<tr>
                    <td>Nơi cấp</td><td>{DATA.issuedby}</td>
                </tr>
                </tbody>
            </table>
        </div>
		<!-- END: step5 -->
                </form>
            </div>
        </div>
<div class="modal fade" id="modalMain" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Thông Báo</h5>
      </div>
      <div class="modal-body"><span id="mess"></span></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
        $("#fileUpload_befor").on('change', function() {
            var imgPath = $(this)[0].value;
            var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            var image_holder = $("#image-befor");
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

        $("#fileUpload_after").on('change', function() {
            var imgPath = $(this)[0].value;
            var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            var image_holder = $("#image-after");
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
    $("#ngaycap").datepicker({
        showOn : "focus",
        dateFormat : "dd/mm/yy",
        changeMonth : true,
        changeYear : true,
        showOtherMonths : true,
        buttonImage : nv_base_siteurl + "assets/images/calendar.gif",
        buttonImageOnly : true
    });
	
	 function nv_load_district( select_name, selected_id ){
        var province = $('select[name=provinceid]').val();
		if( province == 0 )$('#load_district').html('');
        else{
            $.post(nv_base_siteurl + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=main&nocache=' + new Date().getTime(), 'act=district&province=' + province + '&select_name=' + select_name + '&selected_id=' + selected_id, function(res) {
                $('#load_district').html(res)
            });
        }
    }

    <!-- BEGIN: load_district -->
    nv_load_district( 'districtid', '{DATA.districtid}' );
    <!-- END: load_district -->
</script>

<!-- END: main -->

<!-- BEGIN: main2 -->

<!-- END: main2 -->