@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush


@section('content')
  @include('includes.messages')

  <nav class="page-breadcrumb">
    <div class="mb-2 d-flex justify-content-between">
      <h4>Listing of Roles</h4>
      @can('create role')
        <a href="{{ route('roles.create') }}" class="btn btn-sm text-white px-4 py-2"
          style="background: linear-gradient(135deg, #667eea 0%, #764ba2 33%, #f093fb 66%, #f5576c 100%); border-radius: 50px;">
          <i class="fas fa-user-shield me-1"></i> Role
        </a>
      @endcan
    </div>
  </nav>

  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($roles as $role)
                  <tr>
                    <td class="py-1">{{ $role->id }}</td>
                    <td class="py-1">{{ $role->name}}</td>
                    <td class="py-1">
                      <div class="d-flex justify-content-center align-items-center gap-1">

                        @can('show role')
                          <a href="{{ route('assign.role', $role->id) }}" class="action-btn  view-btn-gradient"
                            title="Assign Role">
                            <i class="fas fa-user-shield"></i>
                          </a>
                        @endcan

                        @can('edit role')
                          <a href="{{ route('roles.edit', $role->id) }}" class="action-btn  edit-btn-gradient"
                            title="Edit Role">
                            <i class="fas fa-edit"></i>
                          </a>
                        @endcan

                        @can('delete role')
                          <form id="delete-form-{{ $role->id }}" action="{{ route('roles.destroy', $role->id) }}"
                            method="POST" class="d-inline m-0 p-0">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="confirmDelete({{ $role->id }})"
                              class="action-btn delete-btn-gradient" title="Delete Role">
                              <i class="fas fa-trash"></i>
                            </button>
                          </form>
                        @endcan

                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

<script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>

@endpush

@push('plugin-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>

  <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>

@endpush