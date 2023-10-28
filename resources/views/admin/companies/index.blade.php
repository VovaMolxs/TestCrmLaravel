@extends('layouts.admin')
@section('modal')
    <!-- Modal -->
    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('companies.modal_title')</h5>
                </div>
                <div class="modal-body">
                    <form id="add_employee_form" >
                        @csrf
                        <input type="hidden" id="id" name="id" value="">
                        <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label for="first_name">@lang('companies.name')</label>
                            <input type="text" id="name" name="name"  class="form-control" placeholder="Name" required>
                        </div>
                        <div class="input-upload">
                            <label for="email">@lang('companies.logo')</label>
                            <input class="form-control" type="file" name="logo">
                        </div>
                        <div class="form-group">
                            <label for="email">@lang('companies.email')</label>
                            <input type="email" id="email" name="email"  class="form-control" placeholder="E-mail" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">@lang('companies.phone')</label>
                            <input type="tel" id="phone" name="phone"  class="form-control" placeholder="Phone" required>
                        </div>
                        <div class="form-group">
                            <label for="Note">@lang('companies.website')</label>
                            <input type="text" id="website" name="website"  class="form-control" placeholder="website" >
                        </div>
                        <div class="form-group">
                            <label for="Note">@lang('companies.note')</label>
                            <input type="text" id="note" name="note"  class="form-control" placeholder="note" >
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="submit" id="add_employee_btn"  class="btn btn-primary">@lang('companies.add_company')</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('companies.close')</button>
                        <button type="submit" id="upd_employee_btn"  class="btn btn-primary">@lang('companies.update_company')</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Modal -->

@endsection
@section('content')

    <div class="col-lg-12">
        <div class="card shadow">
            <div class="card-header bg-danger d-flex justify-content-between align-items-center">
                <button class="btn btn-light" id="addEmployeeModal"><i
                        class="bi-plus-circle me-2"></i>@lang('companies.add_new_company')</button>
            </div>
            <div class="card-body" id="show_all_employees">
                <div class="card-body">

                </div>

            </div>
        </div>
    </div>

@endsection

@section('script')

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function getImg(data, type, full, meta) {
            return '<img style="width: 30px; height: 30px" src="{{asset('')}}storage/'+data+'" />';
        }

        getAllCompanies()

        function getAllCompanies() {
            $('.card-body').empty()
            $('.card-body').append(`<table id="myTable" class="display">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>@lang('companies.name')</th>
                                    <th>@lang('companies.logo')</th>
                                    <th>@lang('companies.email')</th>
                                    <th>@lang('companies.phone')</th>
                                    <th>@lang('companies.website')</th>
                                    <th>@lang('companies.note')</th>
                                    <th style="width: 110px">@lang('companies.action')</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>`)
            $('tbody').remove()
            $('#myTable').dataTable({
                processing : true,
                serverSide: true,
                ajax : "{{ route('companies.getall') }}",
                columns : [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name'},
                    { data: 'logo', render: getImg},
                    { data: 'email', name: 'email'  },
                    { data: 'phone', name: 'phone'  },
                    { data: 'website', name: 'website'  },
                    { data: 'note', name: 'note'  },
                    { data: 'action', name: 'action', orderable: false, searchable: false  },
                ],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

        }

        $('#addEmployeeModal').on('click', function() {
            $('#formModal').modal('show');
        })


        $("#add_employee_btn").on('click', function(e) {
            let form = document.getElementById('add_employee_form')

            var form_data = new FormData(form);

            $.ajax({
                url: "{{ route('companies.store') }}",
                type: 'POST',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                dataType : 'json',
                success: function() {
                    getAllCompanies()
                    $("#add_employee_form")[0].reset();
                    $("#formModal").modal('hide');
                },
                error: function(data) {
                    let errors = data.responseJSON;
                }
            })
        });

        $(document).on('click', '.edit', function(event) {
            event.preventDefault();
            var id = $(this).attr('id');

            $.ajax({
                url: "/admin/companies/"+id+"/edit",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: "json",
                success: function(data) {

                    $('#id').val(data.result.id);
                    $('#name').val(data.result.name);
                    $('#logo').val(data.result.logo);
                    $('#email').val(data.result.email);
                    $('#phone').val(data.result.phone);
                    $('#note').val(data.result.note);
                    $('#website').val(data.result.website);
                    $('#formModal').modal('show');
                },
                error: function(data) {
                    let errors = data.responseJSON;
                }
            })
        })

        $("#upd_employee_btn").on('click', function(e) {
            let id         = $('#id').val();

            let form = document.getElementById('add_employee_form');

            var form_data = new FormData(form);

            for (var key of form_data.entries()) {
                console.log(key[0] + ', ' + key[1]);
            }
            $.ajax({
                url : "companies/update2/"+id,
                type: 'post',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                dataType : 'json',
                success: function () {
                    getAllCompanies()
                    $("#add_employee_form")[0].reset();
                    $("#addEmployeeModal").modal('hide');
                },
                error: function(data) {
                    let errors = data.responseJSON;
                }
            })
        });
        $(document).on('click', '.delete', function(event) {
            event.preventDefault();
            var id = $(this).attr('id');

            $.ajax({
                url: "/admin/companies/"+id,
                type: 'DELETE',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: { id:id },
                success: function() {
                    getAllCompanies()
                },
                error: function(data) {
                    let errors = data.responseJSON;
                }
            })
        })
    </script>
@endsection
