@extends('welcome')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <style>
        /* Prevent text from wrapping */
        .btn-edit-link {
            white-space: nowrap;
        }
    </style>
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            Shortening Link Statistics
        </div>
        <div class="card-body">
            <table id="example" class="hover" style="width:100%">
                <thead>
                <tr>
                    <th>Original Link</th>
                    <th>Shorten Link</th>
                    <th>Clicked</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $index => $item)
                    <tr>
                        <td>{{ $item->original_link }}</td>
                        <td id="shortLink">{{ env('APP_URL')."/".$item->shortening_link }}</td>
                        <td>{{ $item->click[0]->count }}</td>
                        <td>
                                <button type="button" class="btn btn-primary edit-link btn-edit-link" data-toggle="modal" data-target="#exampleModalCenter" data-id="{{ $item->id }}">
                                    Edit Short Link
                                </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Original Link</th>
                    <th>Shorten Link</th>
                    <th>Clicked</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            </table>
            @include('pages.modals.edit')
        </div>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        new DataTable('#example');
    </script>
    <script>
        $(document).ready(function() {
            $('.edit-link').click(function() {
                let linkId = $(this).data('id');
                let oldLink = $('#shortLink').text();
                $('#oldLink').val(oldLink);
                $('#linkId').val(linkId);
            });

            $('#exampleModalCenter').on('hidden.bs.modal', function () {
                $('#linkId').val('');
            });
        });
    </script>

@endpush
