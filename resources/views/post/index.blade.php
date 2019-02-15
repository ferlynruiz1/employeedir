@extends('layouts.main')
@section('content')
<div class="panel panel-default">
	<div class="panel panel-heading">
		Posts
		<a class="pull-right btn btn-primary" href="{{ url('posts/create') }}">Create New Post</a>
	</div>
	<div class="panel-body">
		<br>
		<table class="table">
			<thead>
				<tr>
					<td>ID</td>
					<td>Posted by</td>
					<td>Title</td>
					<td>Message</td>
					<td>Created at</td>
				</tr>
			</thead>
			<tbody>
				@foreach($posts as $post)
				<tr>
					<td>{{ $post->id }}</td>
					<td>{{ $post->posted_by }}</td>
					<td>{{ $post->title }}</td>
					<td>{{ $post->message }}</td>
					<td>{{ slashedDate($post->created_at) }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection