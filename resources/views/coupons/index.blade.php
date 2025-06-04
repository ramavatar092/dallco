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

<!-- Import Modal -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('coupons.import') }}" method="POST" enctype="multipart/form-data" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="importModalLabel">Import Coupons</h5>
      </div>
      <div class="modal-body">
        <input type="file" name="file" class="form-control" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Import</button>
      </div>
    </form>
  </div>
</div>

<div class="modal fade" id="cancelCouponsModal" tabindex="-1" aria-labelledby="cancelCouponsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('coupons.cancel') }}" method="POST" enctype="multipart/form-data" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="cancelCouponsModalLabel">Import Bulk Cancel Coupons</h5>
      </div>
      <div class="modal-body">
        <input type="file" name="file" class="form-control" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Import</button>
      </div>
    </form>
  </div>
</div>

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
