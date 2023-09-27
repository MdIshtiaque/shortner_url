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

    /*.container {*/
    /*    max-width: 500px;*/
    /*    margin: 0 auto;*/
    /*    padding: 20px;*/
    /*}*/

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
