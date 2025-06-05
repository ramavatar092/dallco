@extends('layouts.app')

@section('content')
<section class="users-list-wrapper">
    <!-- Users Table -->
    <div class="users-table">
        <div class="card">
            <div class="card-content">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">User Export Details</h5>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <input type="date" id="start_date" class="form-control" placeholder="Start Date">
                        </div>
                        <div class="col-md-3">
                            <input type="date" id="end_date" class="form-control" placeholder="End Date">
                        </div>
                        <div class="col-md-3">
                            <button id="filter" class="btn btn-primary">Filter</button>
                            <button id="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </div>

                    <div class="table table-striped table-fixed table-responsive">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
    <script>
        // Add date filter to Yajra DataTable
        $.fn.dataTable.ext.errMode = 'throw';

        // Extend the ajax call to include date range
        $('#scan-log-table').on('preXhr.dt', function (e, settings, data) {
            data.start_date = $('#start_date').val();
            data.end_date = $('#end_date').val();
        });

        // Trigger redraw on filter button click
        $('#filter').on('click', function () {
            $('#scan-log-table').DataTable().draw();
        });

        // Reset filter and redraw
        $('#reset').on('click', function () {
            $('#start_date').val('');
            $('#end_date').val('');
            $('#scan-log-table').DataTable().draw();
        });

        $(document).on('change click', '#deleteBtn', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var url = $(this).data('url');
            Swal.fire({
                title: "{{ trans('global.areYouSure') }}",
                text: "Do you want to delete this record?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: `Delete`,
            })
            .then((result) => {
                $('#pageloader').css('display', 'flex');
                if (!result.isDismissed) {
                    $.ajax({
                        type: "delete",
                        url: url,
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id
                        },
                        success: function(response) {
                            toastr.success(response.message, 'Success!');
                            $('table').DataTable().ajax.reload(null, false);
                        },
                        error: function(response) {
                            let errorMessages = '';
                            $.each(response.responseJSON.errors, function(key, value) {
                                $.each(value, function(i, message) {
                                errorMessages += '<li>' + message + '</li>';
                                });
                            });
                            toastr.error(errorMessages);
                        },
                        complete: function() {
                            $('table').DataTable().ajax.reload(null, false);
                        }
                    });
                } else {
                    $('table').DataTable().ajax.reload(null, false);
                    return false;
                }
            });
        });

        $(document).on('change click', '#updateStatus', function(e) {
            e.preventDefault();
            var user_id = $(this).attr("data-user-id");
            Swal.fire({
                title: "{{ trans('global.areYouSure') }}",
                text: "Do you want to update status of this record?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: `Update`,
            })
            .then((result) => {
                if (!result.isDismissed) {
                    $.ajax({
                        type: "POST",
                        url: "{{route('users.updateStatus')}}",
                        data: {
                            _token: "{{csrf_token()}}",
                            user_id: user_id,
                        },
                        success: function(response) {
                            toastr.success(response.message, 'Success!');
                            $('table').DataTable().ajax.reload(null, false);
                        },
                        error: function(response) {
                            let errorMessages = '';
                            $.each(response.responseJSON.errors, function(key, value) {
                            $.each(value, function(i, message) {
                                errorMessages += '<li>' + message + '</li>';
                            });
                            });
                            toastr.error(errorMessages);
                        },
                        complete: function() {
                            $('table').DataTable().ajax.reload(null, false);
                            return false;
                        }
                    });
                } else {
                    $('table').DataTable().ajax.reload(null, false);
                    return false;
                }
            });
        });
    </script>
@endpush
