<style>
#dialog-bundle {
	width: 430px;
	max-width: 430px !important;
}
dialog label {
	font-size: smaller;
}
td, th {
	text-align: left;
	padding-right: 20px;
}
hr {
	border: 0;
	border-top: 1px solid #ebebeb;
}
tr:nth-child(even) {
	 background-color: #fafafa;
}
tr.text-muted {
	color: #6c757d !important;
}
td.no-wrap {
	white-space: nowrap;
}
td.text-center {
	text-align: center;
}
td.align-top {
	vertical-align: top;
}
td.desc {
	max-width: 400px;
}
</style>

<div class="p-cnt">
<h2>Templates</h2>
<input type="file" name="file" id="file" hidden>
<button type="button" class="btn-sm btn-add" id="btn-import-file" title="Import template definition via .register-file">Import</button>
<hr>
</div>

<div class="p-cnt">
<table id="templates-table" class="display">
	<thead>
		<tr>
			<th>#</th>
			<th>Name</th>
			<th>Description</th>
			<th>Requires</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php
function get($bundle, $prop) {
	return isset($bundle->$prop) ? $bundle->$prop : '';
}

$index = 1;
if (isset($this->templates->templates)) foreach($this->templates->templates as $template) {
	$tr = '<tr>';
	$tr .= '<td>'.$index.'</td>';
	$index++;
	$tr.= '<td class="no-wrap align-top">'.$template->name.'</td>';
	$tr.= '<td class="desc">'.get($template, 'description').'</td>';
	$tr.= '<td>'.get($template, 'category').'</td>';
	$tr.= '<td><button type="button" class="btn-sm btn-remove btn-remove-bundle" data-bundle="'.$template->name.'"></button></td>';
	$tr.= '</tr>';
	echo $tr;
}
?>
	</tbody>
</table>
<?php echo '<script>const current_temlates = '.json_encode($this->templates).'</script>'; ?>
</div>

<script src="pages/admin/admin-templates.js"></script>

