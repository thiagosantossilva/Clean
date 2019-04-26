<div class="container col-md-12" style="margin-bottom: 15px;float: none;">
	<div class="row">
		<table class="table table-bordered table-striped">
			<thead>
			<tr>
				<th>@lang('abrigosoftware.clean-slots.fields.user')</th>
				<th>@lang('abrigosoftware.clean-slots.fields.value')</th>
					
				<th>Ações</th>
			</tr>
			</thead>
			<tbody id="vagas-em-faxinas">
				@if(count($clean->clean_slots) > 0)
					@foreach($clean->clean_slots as $item)
						@include('admin.cleans.clean_slots_config_row', [
							'index' => 'id-' . $item->id,
							'field' => $item
						])
					@endforeach
				@else
					<tr data-index="1">
						<td>{!! Form::select('clean_slots[1][user_id]', $assigned_tos, old('clean_slots[1][user_id]', isset($field) ? $field->user_id: ''), ['class' => 'form-control select']) !!}</td>
						<td>{!! Form::text('clean_slots[1][value]', old('clean_slots[1][value]', isset($field) ? $field->value: ''), ['class' => 'form-control']) !!}</td>
						<td>
						</td>
					</tr>
				@endif
				
				{{--@forelse(old('clean_slots', []) as $index => $data)
					<tr data-index="1">
						<td>{!! Form::select('clean_slots[1][user_id]', $assigned_tos, old('clean_slots[1][user_id]', isset($field) ? $field->user_id: ''), ['class' => 'form-control select']) !!}</td>
						<td>{!! Form::text('clean_slots[1][value]', old('clean_slots[1][value]', isset($field) ? $field->value: ''), ['class' => 'form-control']) !!}</td>
						<td>
						</td>
					</tr>
					@include('admin.cleans.clean_slots_config_row', [
						'index' => $index
					])
				@empty
					@foreach($clean->clean_slots as $item)
						@include('admin.cleans.clean_slots_config_row', [
							'index' => 'id-' . $item->id,
							'field' => $item
						])
					@endforeach
				@endforelse--}}
				
				{{--@foreach(old('clean_slots', []) as $index => $data)
					@include('admin.cleans.clean_slots_row', [
						'index' => $index
					])
				@endforeach--}}
			</tbody>
		</table>
		<a href="#" class="btn btn-success pull-right add-new"><i class="fa fa-plus"></i></a>
	</div>
</div>


<script type="text/html" id="vagas-em-faxinas-template">
	@include('admin.cleans.clean_slots_config_row',
			[
				'index' => '_INDEX_',
			])
</script > 

<script>
	$('.add-new').click(function () {
		var tableBody = $(this).parent().find('tbody');
		console.log(tableBody);
		var template = $('#' + tableBody.attr('id') + '-template').html();
		var lastIndex = parseInt(tableBody.find('tr').last().data('index'));
		if (isNaN(lastIndex)) {
			lastIndex = 0;
		}
		tableBody.append(template.replace(/_INDEX_/g, lastIndex + 1));
		return false;
	});
	$(document).on('click', '.remove', function () {
		var row = $(this).parentsUntil('tr').parent();
		row.remove();
		return false;
	});
</script>