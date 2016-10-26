@extends('master')

@section('body')

<div class="row">
	<div class="col-sm-12">

		<div class="card">
			<div class="card-block">
				<h4 class="card-title">All Users</h4>

			</div>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Number</th>
						<th width="150">Entries</th>
						<th width="150">Correct</th>
					</tr>
				</thead>
				<tbody>
					@foreach($out as $n => $r)
					<tr>
						<td><a href='{{ action('DisplayController@showUser', [$n]) }}'>{{ $n }}</a></td>
						<td>{{ @$r['e'] }}</td>
						<td>{{ @$r['c'] }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>

	</div>
</div>

@endsection