<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Short Link</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('custom.url') }}" method="post">
                @csrf
                <div class="modal-body">
                    <!-- Input field or hidden input to store the ID -->
                    <input id="linkId" name="url_id" hidden>
                    <!-- Other form fields for editing -->
                    <!-- For example: -->
                    <label for="newLink">Old Short Link</label>
                        <input type="text" class="form-control mb-4" id="oldLink" readonly>
                    <label for="newLink">New Short Link</label>
                    <div class="form-group row">
                        <div class="col-8">
                            <input type="text" class="form-control" id="newLink1" value="{{ env('APP_URL') }}/" readonly>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="new_url" class="form-control" id="newLink2">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveChanges">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
