<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar bg-dark bg-gradient">
  <div class="container-fluid">
    <span class="navbar-brand mb-0 h1"><a class="navbar-brand text-light" href="/">Navbar</a></span>
    <div class="text-end">
      <form method="get" action="download"> 
        @if(isset($data['search_parameters']))
        <input type="hidden" name="searchTerm" value="{{ $data['search_parameters']['q'] }}">
        <input type="hidden" name="location" value="{{ $data['search_parameters']['location'] }}">
        @endif
        <button type="submit" class="btn btn-primary">Download CSV</button>
        
      </form>
            
        </div>
  </div>
</nav>

<div class="container">
	<div class="row">
		<div class="col-8 m-3">
			@if(isset($data['search_parameters']))
			<h3>Search query</h3>
			<table class="table">
          <tr>
                <th scope="col">Keyword or Website URL</th>
                <th scope="col">State or Country</th>
              </tr>
                @if(isset($data['search_parameters']))
                <tr>
                <td>{{ $data['search_parameters']['q'] }}</td>
                <td>{{ $data['search_parameters']['location'] }}</td>
              </tr>
                @endif
        </table>
    @else
        <p>No data available</p>
    @endif
		</div>
				
	</div>
</div>
<div class="continer-flud">
  <div class="row">
    <div class="col-12 mt-3">
       @if(isset($data['organic_results']))
       <h3>Search result</h3>
        <table class="table">
          <tr>
                <th scope="col">SNO.</th>
                <th >title</th>
                <th >link</th>
                <th >domain</th>
                <th >displayed_link</th>
                <th >snippet</th>
                
              </tr>
            @foreach($data['organic_results'] as $item)
                @if(isset($item['title']))
                <tr>
                    <td>{{ $item['position'] }}</td>
                    <td>{{ $item['title'] }}</td>
                    <td>{{ $item['link'] }}</td>
                    <td>{{ $item['domain'] }}</td>
                    <td>{{ $item['displayed_link'] }}</td>
                    @if(isset($item['snippet']))
                    <td>{{ $item['snippet'] }}</td>
                    @else
                    <td></td>
                    @endif

                </tr>
                @endif
            @endforeach
        </table>
    @else
        <p>No data available</p>
    @endif
    </div>
  </div>
</div>

  

     
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>