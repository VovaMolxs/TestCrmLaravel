@extends('layouts.admin')
@section('modal')
    <!-- Modal -->
    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('employes.modal_title')</h5>
                </div>
                <div class="modal-body">
                    <form id="add_employee_form" >
                        <input type="hidden" id="id" name="id" value="">
                        <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                                <div class="form-group">
                                    <label for="first_name">@lang('employes.first_name')</label>
                                    <input type="text" id="first_name" name="first_name"  class="form-control" placeholder="First Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="last_name">@lang('employes.last_name')</label>
                                    <input type="text" id="last_name" name="last_name"  class="form-control" placeholder="Last Name" required>
                                </div>
                            <div class="form-group">
                                <label for="email">@lang('employes.email')</label>
                                <input type="email" id="email" name="email"  class="form-control" placeholder="E-mail" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">@lang('employes.phone')</label>
                                <input type="tel" id="phone" name="phone"  class="form-control" placeholder="Phone" required>
                            </div>
                            <div class="form-group">
                                <label for="Note">@lang('employes.note')</label>
                                <input type="text" id="note" name="note"  class="form-control" placeholder="note" >
                            </div>
                            <div class="form-group">
                                <label for="company_id">@lang('employes.companies')</label>
                                <select class="form-select" id="company_id">
                                    <option value="null">@lang('employes.no_company')</option>
                                    @foreach($companies as $company)
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="add_employee_btn"  class="btn btn-primary">@lang('employes.add_employee')</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('employes.close')</button>
                    <button type="submit" id="upd_employee_btn"  class="btn btn-primary">@lang('employes.update_employee')</button>
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
                                class="bi-plus-circle me-2"></i>@lang('employes.add_new_employee')</button>
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

        getAllEmployees()

        function getAllEmployees() {
            $('.card-body').empty()
            $('.card-body').append(`<table id="myTable" class="display">
                                <thead>
                                <tr>
                                    <th>@lang('employes.id')</th>
                                    <th>@lang('employes.first_name')</th>
                                    <th>@lang('employes.last_name')</th>
                                    <th>@lang('employes.email')</th>
                                    <th>@lang('employes.phone')</th>
                                    <th>@lang('employes.note')</th>
                                    <th>@lang('employes.companies')</th>
                                    <th style="width: 110px">@lang('employes.action')</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>`)
                $('tbody').remove()
                $('#myTable').dataTable({
                    processing : true,
                    serverSide: true,
                    ajax : "{{ route('employes.getall') }}",
                    columns : [
                        { data: 'id', name: 'id' },
                        { data: 'first_name', name: 'first_name'},
                        { data: 'last_name', name: '' },
                        { data: 'email', name: 'last_name'  },
                        { data: 'phone', name: 'phone'  },
                        { data: 'note', name: 'note'  },
                        { data: 'name', name: 'companies_id'  },
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
        e.preventDefault();

        let token      = $('#_token').val()
        let first_name = $('#first_name').val()
        let last_name  = $('#last_name').val()
        let email      = $('#email').val()
        let phone      = $('#phone').val()
        let note      = $('#note').val()
        let company_id =$('#company_id').val()

        $.post(
            '{{ route('employes.store') }}',
            {
                _token: token,
                first_name: first_name,
                last_name: last_name,
                email: email,
                phone: phone,
                note: note,
                company_id: company_id,
            },
            function () {
            }).done(function (response) {

            getAllEmployees()
            $("#add_employee_form")[0].reset();
            $("#formModal").modal('hide');

        })
    });

        $(document).on('click', '.edit', function(event) {
            event.preventDefault();
            var id = $(this).attr('id');

            $.ajax({
                url: "/admin/employes/"+id+"/edit",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: "json",
                success: function(data) {

                    $('#id').val(data.result.id);
                    $('#first_name').val(data.result.first_name);
                    $('#last_name').val(data.result.last_name);
                    $('#email').val(data.result.email);
                    $('#phone').val(data.result.phone);
                    $('#note').val(data.result.note);
                    $('#company_id').val(data.result.companies_id);

                    $('#formModal').modal('show');
                },
                error: function(data) {
                    let errors = data.responseJSON;
                }
            })
        })

        $("#upd_employee_btn").on('click', function(e) {
            e.preventDefault();
            let id         = $('#id').val();
            let token      = $('#_token').val()
            let first_name = $('#first_name').val()
            let last_name  = $('#last_name').val()
            let email      = $('#email').val()
            let phone      = $('#phone').val()
            let note      = $('#note').val()
            let company_id =$('#company_id').val()

            $.ajax({
                url : "employes/"+id,
                type: 'PUT',
                data: {
                    id: id,
                    _token: token,
                    first_name: first_name,
                    last_name: last_name,
                    email: email,
                    phone: phone,
                    note: note,
                    company_id: company_id
                },success: function (response) {
                    getAllEmployees()
                    $("#add_employee_form")[0].reset();
                    $("#formModal").modal('hide');
                }
            })
        });
        $(document).on('click', '.delete', function(event) {
            event.preventDefault();
            var id = $(this).attr('id');

            $.ajax({
                url: "/admin/employes/"+id,
                type: 'DELETE',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: { id:id },
                success: function() {
                    getAllEmployees()
                },
                error: function(data) {
                    let errors = data.responseJSON;
                }
            })
        })
    </script>
@endsection
