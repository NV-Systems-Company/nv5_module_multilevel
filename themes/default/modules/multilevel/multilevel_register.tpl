<!-- BEGIN: main -->
Form Đăng ký cộng tác viên

<div class="bg">
            <ol class="steps">
                <li class="step is-active" data-step="1">Đăng kí thông tin</li>
                <li class="step" data-step="2">Review và upload ảnh thẻ</li>
                <li class="step" data-step="3">Thành công</li>
            </ol>
            <div class="container">
                <form style="text-align: left" class="well form-horizontal" action=" " method="post" id="contact_form">
                    <fieldset>
                        <!-- Form Name -->
                        <legend>
                            <center>
                                <h2><b>Nhập thông tin đăng kí</b></h2>
                            </center>
                        </legend>
                        <br />

                        <!-- Text input-->

                        <div class="form-group">
                            <label class="col-md-8 control-label">Họ và Tên</label>
                            <div class="col-md-16 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon">*</span>
                                    <input
                                        name="name"
                                        placeholder="Nhập họ tên chính xác"
                                        class="form-control"
                                        type="text"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-8 control-label">Giới tính</label>
                            <div class="col-md-16 selectContainer">
                                <div class="input-group">
                                    <span class="input-group-addon">*</span>
                                    <select class="form-control selectpicker" name="" id="gender">
                                        <option value="male">Nam</option>
                                        <option value="female">Nữ</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-8 control-label">Hộ khẩu thường trú</label>
                            <div class="col-md-16 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon">*</span>
                                    <input
                                        name="address"
                                        placeholder="Địa chỉ đăng kí thường trú"
                                        class="form-control"
                                        type="text"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-8 control-label">Nơi cư trú</label>
                            <div class="col-md-16 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon">*</span>
                                    <input
                                        name="addressmain"
                                        placeholder="Địa chỉ thường trú"
                                        class="form-control"
                                        type="text"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-8 control-label">Ngày sinh</label>
                            <div class="col-md-16 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon">*</span>
                                    <input name="birthday" placeholder="First Name" class="form-control" type="date" />
                                </div>
                            </div>
                        </div>

                        <!-- Text input-->

                        <div class="form-group">
                            <label class="col-md-8 control-label">Quốc tịch</label>
                            <div class="col-md-16 selectContainer">
                                <div class="input-group">
                                    <span class="input-group-addon">*</span>
                                    <select name="quoctich" class="form-control selectpicker">
                                        <option selected>Việt Nam</option>
                                        <option>Nước ngoài</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-8 control-label">CMMD/CCCD</label>
                            <div class="col-md-16 inputGroupContainer">
                                <div style="display: flex" class="input-group">
                                    <span class="input-group-addon" style="width: 30px">*</span>
                                    <input
                                        name="cmndnumber"
                                        placeholder="Số CMND/CCCD"
                                        class="form-control"
                                        type="text"
                                    />
                                    <input name="cmndaddress" placeholder="Nơi cấp" class="form-control" type="text" />
                                    <input
                                        name="cmnddate"
                                        style="padding: 10px"
                                        placeholder="Ngày cấp"
                                        class="form-control"
                                        type="date"
                                    />
                                </div>
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="col-md-8 control-label">Số điện thoại</label>

                            <div class="col-md-16 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon">*</span>
                                    <input name="contact" placeholder="(+84)" class="form-control" type="text" />
                                </div>
                            </div>
                        </div>

                        <!-- Text input-->
                        

                        <!-- Success message -->
                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-8 control-label"></label>
                            <div class="col-md-8">
                                <br />
                                <button type="submit" class="btn-register">Đăng ký</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#contact_form')
                .bootstrapValidator({
                    // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh',
                    },
                    fields: {
                        name: {
                            validators: {
                                stringLength: {
                                    min: 6,
                                    message: 'Vui lòng nhập chính xác',
                                },
                                notEmpty: {
                                    message: 'Vui lòng nhập họ và tên',
                                },
                            },
                        },
                        address: {
                            validators: {
                                notEmpty: {
                                    message: 'Vui lòng nhập địa chỉ',
                                },
                            },
                        },
                        addressmain: {
                            validators: {
                                notEmpty: {
                                    message: 'Vui lòng nhập địa chỉ',
                                },
                            },
                        },
                        contact: {
                            validators: {
                                stringLength: {
                                    min: 8,
                                    message: 'Vui lòng số điện thoại chính xác',
                                },
                                notEmpty: {
                                    message: 'Vui lòng nhập số điện thoại',
                                },
                            },
                        },
                        example: {
                            validators: {
                                notEmpty: {
                                    message: 'Vui lòng chọn trường này',
                                },
                            },
                        },

                        cmnddate: {
                            validators: {
                                notEmpty: {
                                    message: 'Vui lòng nhập đầy đủ thông tin này',
                                },
                            },
                        },
                    },
                })
                .on('success.form.bv', function (e) {
                    $('#success_message').slideDown({ opacity: 'show' }, 'slow'); // Do something ...
                    $('#contact_form').data('bootstrapValidator').resetForm();

                    // Prevent form submission
                    e.preventDefault();

                    // Get the form instance
                    var $form = $(e.target);

                    // Get the BootstrapValidator instance
                    var bv = $form.data('bootstrapValidator');

                    // Use Ajax to submit form data
                    $.post(
                        $form.attr('action'),
                        $form.serialize(),
                        function (result) {
                            console.log(result);
                        },
                        'json'
                    );
                });
        });
    </script>


<!-- END: main -->