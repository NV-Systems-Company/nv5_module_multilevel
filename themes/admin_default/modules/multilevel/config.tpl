<!-- BEGIN: main -->

<form class="form-inline" role="form" action="{NV_BASE_ADMINURL}index.php" method="post">

    <input type="hidden" name ="{NV_NAME_VARIABLE}" value="{MODULE_NAME}" />
	<input type="hidden" name ="{NV_OP_VARIABLE}" value="{OP}" />
	
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover">
			<caption><em class="fa fa-file-text-o">&nbsp;</em>{LANG.setting_view}</caption>
			<tbody>
			
				<tr>
					<th>{LANG.f0}</th>
					<td><div class="col-sm-6" ><input class= "form-control " type="text" value="{DATA.f0}" name="f0" /></div><span class="text-middle">{LANG.phan_tram}</span></td>
				</tr>
				<tr>
					<th>{LANG.f1}</th>
					<td><div class="col-sm-6" ><input class= "form-control " type="text" value="{DATA.f1}" name="f1" /></div><span class="text-middle">{LANG.phan_tram}</span></td>
				</tr>
				<tr>
					<th>{LANG.f2}</th>
					<td><div class="col-sm-6" ><input class= "form-control " type="text" value="{DATA.f1}" name="f2" /></div><span class="text-middle">{LANG.phan_tram}</span></td>
				</tr>
				
			</tbody>	
			<tfoot>
				<tr>
					<td class="text-center" colspan="2">
						<input class="btn btn-primary" type="submit" value="{LANG.save}" name="Submit1" />
						<input type="hidden" value="1" name="saveconfig" />
					</td>
				</tr>
			</tfoot>
		</table>
		
</form>

<!-- END: main -->

