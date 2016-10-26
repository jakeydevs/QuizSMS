@extends('master')

@section('body')

<div class="row">
	<div class="col-sm-12">


		<div class="card card-block">
			<h3 class="card-title">Pick a random winner</h3>
			<p class="card-text">Will pick a random table row from the table below</p>
			<a href="#" class="btn btn-primary btn-pcik">Pick a winner</a>
			<div class="winning-row" style="margin: 30px -20px -20px;display:none">
				<table class="table" style="margin-bottom: 0">
					<thead>
						<tr>
							<th>Number</th>
							<th width="150">Question</th>
							<th width="150">Answer</th>
							<th width="250">SMS Created</th>
						</tr>
					</thead>
					<tbody>
						<tr class="inject-winner table-success">
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<div class="card">
			<div class="card-block">
				<h4 class="card-title">All Correct Answers</h4>

			</div>
			<table class="table table-striped table-correct" style="margin-bottom: 0">
				<thead>
					<tr>
						<th>Number</th>
						<th width="150">Question</th>
						<th width="150">Answer</th>
						<th width="250">SMS Created</th>
					</tr>
				</thead>
				<tbody>
					@foreach($correct as $r)
					<tr>
						<td><a href='{{ action('DisplayController@showUser', [$r->number]) }}'>{{ $r->number }}</a></td>
						<td>{{ $r->question }}</td>
						<td>{{ $r->answer }}</td>
						<td>{{ $r->created_at }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>

	</div>
</div>

@endsection

@section('js')
<script>
	$('.btn-pcik').on('click', function() {
		var correct = $('.table-correct tbody tr');
	//-- Pick random amount
	var winner = Math.floor(Math.random() * correct.length) + 1;
	var wr = $('.table-correct tbody tr:nth-child(' + winner + ')');
	$('.winning-row').show();
	$('.inject-winner').html(wr.html());
});
</script>
@endsection