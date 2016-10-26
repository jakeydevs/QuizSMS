@extends('master')

@section('body')

<div class="row">
	<div class="col-sm-4">

		<div class="card card-inverse card-primary text-xs-center">
			<div class="card-block card-entries">
				<blockquote class="card-blockquote">
					<h1>{{ $stats[0] }}</h1>
					<footer>Entries</footer>
				</blockquote>
			</div>
		</div>

	</div>

	<div class="col-sm-4">

		<div class="card card-inverse card-success text-xs-center">
			<div class="card-block card-correct">
				<blockquote class="card-blockquote">
					<h1>{{ $stats[1] }}</h1>
					<footer>Correct Answers</footer>
				</blockquote>
			</div>
		</div>

	</div>

	<div class="col-sm-4">

		<div class="card card-inverse card-danger text-xs-center">
			<div class="card-block card-bad">
				<blockquote class="card-blockquote">
					<h1>{{ $stats[2] }}</h1>
					<footer>Incorrect Answers</footer>
				</blockquote>
			</div>
		</div>

	</div>
</div>

<div class="row">
	<div class="col-sm-12">

		<div class="card">
			<div class="card-block">
				<h4 class="card-title">Live Responses</h4>
			</div>
			<table class="table table-striped">
				<thead>
					<tr>
						<th width="150">Created</th>
						<th width="150">Number</th>
						<th>Message</th>
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
		</div>

	</div>
</div>

@endsection

@section('js')
<script>
	var pusher = new Pusher('{{ env('PUSHER_KEY') }}', {
      encrypted: true
    });
	var channel = pusher.subscribe('main');
	channel.bind('new-sms', function(data) {
		$('.table tbody').prepend('<tr><td>' + data.date + "</td><td>" + data.from + "</td><td>" + data.message + "</td></tr>");
	});
	channel.bind('new-entry', function(data) {
		$('.card-entries h1').html(data.stats[0]);
		$('.card-correct h1').html(data.stats[1]);
		$('.card-bad h1').html(data.stats[2]);
	});
</script>
@endsection