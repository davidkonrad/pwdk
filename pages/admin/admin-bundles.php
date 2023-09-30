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
<h2>Bundles</h2>
<input type="file" name="file" id="file" hidden>
<button type="button" class="btn-sm btn-add" id="btn-import-file" title="Import Bundle definition via .register-file">Import</button>
<hr>
</div>

<div class="p-cnt">
<table id="bundles-table" class="display">
	<thead>
		<tr>
			<th>#</th>
			<th>Enabled</th>
			<th>Name</th>
			<th>Description</th>
			<th>Category</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php
function get($bundle, $prop) {
	return isset($bundle->$prop) ? $bundle->$prop : '';
}

$index = 1;
if (isset($this->bundles->bundles)) foreach($this->bundles->bundles as $bundle) {
	$tr = $bundle->enabled == 'true' ? '<tr data-bundle="'.$bundle->name.'">' : '<tr class="text-muted" data-bundle="'.$bundle->name.'">';
	$tr .= '<td>'.$index.'</td>';
	$index++;
	$tr.= '<td class="text-center">';
	$tr.= $bundle->enabled == 'true' 
		? '<input type="checkbox" class="checkbox-enabled check-enable-bundle" checked>'
		: '<input type="checkbox" class="checkbox-enabled check-enable-bundle">';
	$tr.= '</td>';
	$tr.= '<td class="no-wrap align-top">'.$bundle->name.'</td>';
	$tr.= '<td class="desc">'.get($bundle, 'description').'</td>';
	$tr.= '<td>'.get($bundle, 'category').'</td>';
	$tr.= '<td><button type="button" class="btn-sm btn-remove btn-remove-bundle" data-bundle="'.$bundle->name.'"></button></td>';
	$tr.= '</tr>';
	echo $tr;
}
?>
	</tbody>
</table>
<?php echo '<script>const current_bundles = '.json_encode($this->bundles).'</script>'; ?>
</div>

<script src="pages/admin/admin-bundles.js"></script>


