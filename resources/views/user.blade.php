@extends('master')

@section('body')

<div class="row">
	<div class="col-sm-12">

		<div class="card">
			<div class="card-block">
				<h4 class="card-title">{{ $number }}</h4>

			</div>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Question</th>
						<th width="150">Answer</th>
						<th width="100" class="text-xs-right">Correct</th>
						<th width="250" class="text-xs-right">Created</th>
					</tr>
				</thead>
				<tbody>
					@foreach($out as $a)

					@if ($a->correct == 1)
					<tr class="table-success">
					@else
					<tr class="table-danger">
					@endif
						<td>{{ $a->question }}</td>
						<td>{{ $a->answer }}</td>
						<td class="text-xs-right">
							@if ($a->correct == 1)
							<i class="fa fa-check"></i>
							@else
							<i class="fa fa-remove"></i>
							@endif
						</td>
						<td class="text-xs-right">{{ $a->created_at }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>

	</div>
</div>

@endsection