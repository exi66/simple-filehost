<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Upload</title>
	</head>
	<body>
		<div>
			<form id="form" action="{{route('upload_file')}}" method="post" enctype="multipart/form-data">
				@csrf
				@if ($message = Session::get('success'))
				<div class="alert alert-success">
					<strong>{{ $message }}</strong>
				</div>
			  @endif
			  @if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						  <li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			  @endif
				<input name="file" type="file">
				<button type="submit" name="submit">Upload</button>
			</form>
		</div>
	</body>
	<script>
		const fileInput = document.getElementById("file");
		window.addEventListener('paste', e => {
			fileInput.files = e.clipboardData.files;
		});
	</script>
</html>