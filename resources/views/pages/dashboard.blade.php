@extends('master')

@push('css')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <style>
        body {
            background: linear-gradient(to right, #8e9eab, #eef2f3);
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 100%;
            margin-top: 50px;
            background: rgba(255, 255, 255, 0.8);
            padding: 40px;
            border-radius: 15px;
        }

        .stat-card {
            background: linear-gradient(to left, #a1c4fd, #c2e9fb);
            color: white;
            border-radius: 10px;
            text-align: center;
        }

        .stat-title {
            font-size: 20px;
            margin: 20px 0;
        }

        .stat-number {
            font-size: 36px;
            font-weight: bold;
        }

        td {
            word-wrap: break-word;
            max-width: 150px;
            /* or whatever maximum width you want to set */
        }
    </style>
@endpush

@section('content')
    <div class="container mt-5">
        <h1>Dashboard</h1>

        <!-- Statistics -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="stat-title">Shortened Links</div>
                        <div class="stat-number" id="shortenedCount">{{ $totalGeneratedLink }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="stat-title">Total Clicks</div>
                        <div class="stat-number" id="clickCount">{{ $totalClick }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <h3 class="mt-5">Links</h3>
        <table id="dataTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Original Link</th>
                    <th>Shortened Link</th>
                    <th>Clicks</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <!-- Data will go here -->
                @foreach ($datas as $index => $item)
                    <tr>
                        <td>{{ $item->original_link }}</td>
                        <td id="shortLink">{{ env('APP_URL') . '/' . $item->shortening_link }}</td>
                        <td>{{ $item->click[0]->count }}</td>
                        <td>
                            <button type="button" class="btn btn-primary edit-link btn-edit-link" data-toggle="modal"
                                data-target="#exampleModalCenter" data-id="{{ $item->id }}">
                                Edit Short Link
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @include('pages.modals.edit')
    </div>
@endsection

@push('js')

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#dataTable').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.edit-link').click(function() {
                let linkId = $(this).data('id');
                let oldLink = $('#shortLink').text();
                $('#oldLink').val(oldLink);
                $('#linkId').val(linkId);
            });

            $('#exampleModalCenter').on('hidden.bs.modal', function() {
                $('#linkId').val('');
            });
        });
    </script>
@endpush
