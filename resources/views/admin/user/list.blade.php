@extends('admin.layout.master')
@section('title', '')
@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">
                                    User List
                                </h2>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <h4 class="text-success">
                                Total Account : {{ $accountData->total() }}
                            </h4>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        @if (session('updated'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('updated') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if (session('created'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('created') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if (session('deleted'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('deleted') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        {{-- @dd($accountData) --}}
                        @if ($accountData->total())
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Gender</th>
                                        <th>Address</th>
                                        <th class="text-center px-0">Change Role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($accountData as $p)
                                        <tr class="tr-shadow @if (Auth::user()->id == $p->id) bg-secondary @endif">
                                            <input type="hidden" value="{{ $p->id }}" id="userId">
                                            <td><img src="{{ asset('storage/' . $p->image) }}" class=" img-thumbnail"
                                                    style="width: 75px" alt="not found"></td>
                                            <td>{{ $p->name }}</td>
                                            <td>{{ $p->email }}</td>
                                            <td>{{ $p->phone }}</td>
                                            <td>{{ $p->gender }}</td>
                                            <td>{{ $p->address }}</td>
                                            <td>{{-- <i class="fa fa-arrow-up-from-bracket text-warning"></i> --}}
                                                <select class="btn btn-sm btn-primary rounded roleUpdate">
                                                    <option value="">Role</option>
                                                    <option value="admin" title="update to admin role">Admin</option>
                                                    <option value="remove" title="remove from user list">Remove</option>
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class=" float-right mt-2">
                                {{-- {{$accountData->links()}} --}}
                                {{ $accountData->appends(request()->query())->links() }}
                            </div>
                            <!-- END DATA TABLE -->
                        @else
                            <hr>
                            <h3 class=" mt-5 text-secondary text-center">No accountData Found!</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('coustmizeJs')
    <script>
        $(document).ready(function() {
            $('.roleUpdate').change(function() {
                $parentNode = $(this).parents('tbody tr');
                $userId = $parentNode.find('#userId').val();
                $changeData = $(this).val();
                $data = {
                    'userId': $userId,
                    'changeData': $changeData,
                }
                console.log($data);
                $.ajax({
                    'type': 'get',
                    'url': '/user/changeRole',
                    'data': $data,
                    'dataType': 'json',
                    'success': function(response) {
                        console.log(response['status']);
                    },
                });
                location.reload();
            })
        });
    </script>
@endsection
