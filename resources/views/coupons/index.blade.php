@extends('layouts.app')

@section('content')
<section class="coupons-list-wrapper">
    <!-- Coupons Table -->
    <div class="coupons-list-table">
        <div class="card">
            <div class="card-content">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Coupon List</h5>
                    <a href="{{ route('coupons.create') }}" class="btn btn-primary">
                        + New Coupon
                    </a>
                </div>

                <div class="card-body">
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
            var coupon_id = $(this).attr("data-coupon-id");
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
                            url: "{{route('coupons.updateStatus')}}",
                            data: {
                                _token: "{{csrf_token()}}",
                                coupon_id: coupon_id,
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
