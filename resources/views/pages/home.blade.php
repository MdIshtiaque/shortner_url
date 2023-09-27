@extends('welcome')

@section('content')
    <div class="card">
        <div class="card-header">
            URL Shortener
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="originalUrl">Enter your URL:</label>
                <input type="url" class="form-control" id="originalUrl" placeholder="https://example.com" required>
            </div>
            <button class="btn btn-primary btn-block" id="shortenBtn">Shorten URL</button>
            <div id="shortenedUrl" data-route="">
                <p><strong>Shortened URL:</strong></p>
                <a href="#" target="_blank" id="shortUrlLink"></a>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('#shortenBtn').click(function () {

                var originalUrl = $('#originalUrl').val();
                var userId = @json(auth()->check() ? auth()->user()->id : null);
                var baseUrl = "{{ url('/') }}";

                $.ajax({
                    url: '/api/getShorteningLink',
                    method: 'GET',
                    data: {
                        originalUrl: originalUrl,
                        userId: userId
                    },
                    success: function (response) {
                        console.log(response);
                        var shortenedUrl = response.data;
                        var redirectUrl = baseUrl + '/' + shortenedUrl;
                        $('#shortUrlLink').attr('href', redirectUrl).text("{{ env('APP_URL') }}" + "/" + shortenedUrl);


                        document.getElementById("shortenedUrl").style.display = "block";
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endpush
