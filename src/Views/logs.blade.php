<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Logs - Laravel</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="https://dev4born.pro/pub/css/bootstrap.old.css" rel="stylesheet">
	
    <style type="text/css">
        body {
            padding-top: 54px;
			color: #434343;
        }
	    .bg-color {
		    background-color: #434343!important;  
	    }
		.pre-logs {
			text-align: left; 
			height: 500px;	
		}
    </style>
	
	<script type="text/javascript">
	    function scroll_pre() {
            var scrolled = document.getElementById('pre');
            scrolled.scrollTop = scrolled.scrollHeight;
        }
    </script>
  </head>
  <body onload="scroll_pre();">
    <nav class="navbar-expand-lg navbar-dark bg-color fixed-top">
      <div class="container">
        <a class="navbar-brand" href="{{ url('laravel/'.$request->route('secret').'/logs') }}">Logs - Laravel</a>
      </div>
    </nav>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="mt-5">List of files</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
						<th>Modified</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
	        @foreach($list as $file)
                    <tr>
                        <td>{{ basename($file) }}</td>
						<td>{{ date('Y-m-d H:i:s', filemtime($file)) }}</td>
                        <td>
		                    <a href="{{ url('laravel/'.$request->route('secret').'/logs?file='.basename($file)) }}" class="btn btn-default btn-sm">
                                <i class="fa fa-eye"></i> Show
                            </a>			
		                    <a href="{{ url('laravel/logs/'.sha1(date('Y-m-d H:i')).'_'.basename($file)) }}" class="btn btn-default btn-sm">
                                <i class="fa fa-download"></i> Download
                            </a>
		                    <a href="{{ url('laravel/logs/remove/'.sha1(date('Y-m-d H:i')).'_'.basename($file)) }}" class="btn btn-default btn-sm">
                                <i class="fa fa-remove"></i> Remove
                            </a>		
		                </td>
                    </tr>
	        @endforeach
                </tbody>
            </table> 		
            <h1 class="mt-5">All events - @if($request['file']) {{ $request['file'] }} @else laravel.log @endif</h1>    
		@if($logs)
			<pre class="pre-logs" id="pre">	
			    {{ $logs }}
			</pre> 
		@else
			<div class="alert alert-warning">
                <strong>Info!</strong> Unfortunately, no logs/events were found.
            </div>
		@endif
            </pre> 
            <div class="list-unstyled">
                <p>Powered by <strong>Dev4Born.pro</strong></p>
            </div>
        </div>
      </div>
    </div>
  </body>
</html>
