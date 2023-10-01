@extends('master')
@push('css')
    <style>
        .result-card {
            background: linear-gradient(to left, #a1c4fd, #c2e9fb);
            color: white;
            border-radius: 10px;
            }
    </style>
@endpush
@section('content')
    <div class="container">
        <h1>Welcome to Link Shortener</h1>
        <p>Shorten your long URLs for easier sharing.</p>
        <form id="shortenForm">
            <div class="form-group">
                <input type="url" id="urlInput" class="form-control" placeholder="Enter URL with http">
                <span class="text-warning" id="errorSpan"></span>
            </div>
            <button type="submit" class="btn btn-primary" id="shortenBtn">Shorten</button>
        </form>
        <div id="result" class="mt-3"></div>
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/validator/13.6.0/validator.min.js"></script>
    <script>
        // Prevent the default form submission behavior
        document.getElementById('shortenForm').addEventListener('submit', function(event) {
            event.preventDefault();

            // Simulate a shortened URL
            var originalUrl = document.getElementById('urlInput').value;
            var userId = @json(auth()->check() ? auth()->user()->id : null);
            var baseUrl = "{{ url('/') }}";

            if (!validator.isURL(originalUrl, {require_protocol: true})) {
                $('#errorSpan').text("Please enter a valid URL.");
                document.getElementById("result").style.display = "none";
                return;
            } else {
                $('#errorSpan').text("");
                document.getElementById("result").style.display = "block";
            }

            $.ajax({
                url: '/api/getShorteningLink',
                method: 'GET',
                data: {
                    originalUrl: originalUrl,
                    userId: userId
                },
                success: function(response) {
                    var shortenedURL = response.data;
                    var redirectUrl = baseUrl + '/' + shortenedURL;
                    const resultDiv = document.getElementById('result');
                    resultDiv.innerHTML = `
                            <div class="card result-card">
                            <div class="card-body">
                                <h5 class="card-title">Your Shortened URL</h5>
                                <p class="card-text" style><a href="${redirectUrl}" class="text-white" target="_blank">{{ env('APP_URL') }}/${shortenedURL}</a></p>
                                <button class="btn btn-light" onclick="copyToClipboard('{{ env('APP_URL') }}/${shortenedURL}')">Copy to Clipboard</button>
                            </div>
                            </div>
                        `;
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });


        });

        // Copy text to clipboard
        function copyToClipboard(text) {
            var tempInput = document.createElement("input");
            tempInput.style = "position: absolute; left: -1000px; top: -1000px";
            tempInput.value = text;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);
        }
    </script>
@endpush
