<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Shortener</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .header {
            background-color: #343a40;
            color: #fff;
            padding: 20px;
            text-align: right;
            position: relative;

        }

        /*.header {*/
        /*    display: flex;*/
        /*    justify-content: end;*/
        /*}*/

        /*.login-btn,*/
        /*.signup-btn {*/
        /*    margin-right: 10px; !* Add spacing between the buttons if needed *!*/
        /*}*/
        /*.login-btn {*/
        /*    position: absolute;*/
        /*    top: 10px;*/
        /*    right: 20px;*/
        /*    background-color: #007bff;*/
        /*    color: #fff;*/
        /*    padding: 8px 12px;*/
        /*    border: none;*/
        /*    border-radius: 4px;*/
        /*    cursor: pointer;*/
        /*    transition: background-color 0.3s ease-in-out, transform 0.3s ease-in-out;*/
        /*}*/
        /*.login-btn a {*/
        /*    text-decoration: none;*/
        /*    color: #fff;*/
        /*    font-weight: bold;*/
        /*    transition: color 0.3s ease-in-out;*/
        /*}*/
        /*.login-btn:hover {*/
        /*    background-color: #0056b3;*/
        /*    transform: translateY(-3px);*/
        /*}*/
        /*.login-btn a:hover {*/
        /*    color: #fff;*/
        /*}*/
        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
        }

        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: box-shadow 0.3s ease-in-out;
        }

        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            font-size: 24px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        #shortenBtn {
            background-color: #007bff;
            color: #fff;
            transition: background-color 0.3s ease-in-out;
        }

        #shortenBtn:hover {
            background-color: #0056b3;
        }

        #shortenedUrl {
            display: none;
            margin-top: 20px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        #shortenedUrl a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease-in-out;
        }

        #shortenedUrl a:hover {
            color: #0056b3;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
<div class="header">
    @if(auth()->user())
        <div class="d-flex justify-content-end">
            <div class="login-btn pr-2 mt-2">
                <span style="font-weight: bold">Hi, {{ auth()->user()->name }}</span>
            </div>
            <div class="signup-btn">
                <form action="{{ route('logoutUser') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Log out</button>
                </form>
            </div>
        </div>
    @else
        <div class="d-flex justify-content-end">
            <div class="login-btn pr-2">
                <a href="{{ route('login') }}" type="button" class="btn btn-primary">Login</a>
            </div>
            <div class="signup-btn">
                <a href="{{ route('register') }}" type="button" class="btn btn-primary">Sign up</a>
            </div>
        </div>
    @endif
</div>

<div class="container mt-3">
    <div class="card">
        <div class="card-header">
            URL Shortener
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="originalUrl">Enter your URL:</label>
                <input type="url" class="form-control" id="originalUrl" placeholder="https://example.com">
            </div>
            <button class="btn btn-primary btn-block" id="shortenBtn">Shorten URL</button>
            <div id="shortenedUrl" data-route="">
                <p><strong>Shortened URL:</strong></p>
                <a href="#" target="_blank" id="shortUrlLink"></a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and jQuery CDN (required for Bootstrap) -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $('#shortenBtn').click(function () {
            // Get the URL from the input field
            var originalUrl = $('#originalUrl').val();
            var userId = @json(auth()->check() ? auth()->user()->id : null);
            var baseUrl = "{{ url('/') }}";
            // Make an AJAX request to the API
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

                    // Show the shortened URL with a fade-in animation
                    document.getElementById("shortenedUrl").style.display = "block";
                },
                error: function (xhr, status, error) {
                    // Handle errors if necessary
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

</body>
</html>
