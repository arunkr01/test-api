<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body class="bg-dark">
        
        <div class="container text-center">
            <div class="row">
                <div class="col-8 justify-content-center" style="margin: 15% 0px 0 29%;">
                  <div class="card" style="width: 500px;padding: 40px;">
                    <form method="get" action="api">                
                      <div class="mb-3">
                        <label for="searchTerm" class="form-label">*Keyword or Website URL</label>
                        <input type="text" class="form-control" value="{{ old('searchTerm') }}" name="searchTerm" id="searchTerm">
                        @if($errors->has('searchTerm'))
                  <span class="text-danger">{{ $errors->first('searchTerm') }}</span>
                @endif
                      </div>
                      <div class="mb-3">
                        <label for="country" class="form-label">State or Country</label>
                        <input type="text" class="form-control" value="{{ old('country') }}" name="country" id="country">
                        @if($errors->has('country'))
                  <span class="text-danger">{{ $errors->first('country') }}</span>
                @endif
                      </div>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                  </div>
                </div>
            </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>