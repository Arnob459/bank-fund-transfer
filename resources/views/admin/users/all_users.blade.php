@extends('admin.layouts.master')

@section('content')

                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            {{ $page_title }}
                        </div>
                        <div class="card-body" >
                            <div class="table-responsive">
                            <table class="table table-hover" id="table1">
                                <thead>
                                    <tr style="white-space: nowrap">
                                        <th>Avatar</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Account No.</th>
                                        <th>Email</th>
                                        <th>Balance</th>
                                        <th>Status</th>
                                        <th>Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach ($users as $user)
                                        <td>
                                             @if ($user->avatar !=null)
                                             <div class="avatar  ">
                                            <img class="avatar-img rounded-circle" src="{{asset('assets/images/users/'.$user->avatar)}}" >
                                            </div>
                                            @else
                                            <div class="avatar avatar-xl">
                                            <span class="avatar-text rounded-circle border border-dark">{{\Illuminate\Support\Str::limit($user->name, 1 ,'')}}</span>
                                        </div>

                                            @endif
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td><a href="{{route('admin.user.edit', $user->id)}}"> {{ $user->username }} </a></td>
                                        <td> {{ $user->account_number }}</td>
                                        <td >{{ $user->email }}</td>
                                        <td>{{$gnl->cur_sym}} {{formatter_money($user->balance)}}</td>
                                        <td>
                                        @if ($user->status == 1)
                                        <span class="badge bg-success">Active</span>
                                        @elseif ($user->status == 0)
                                        <span class="badge bg-danger">Block</span>
                                        @else
                                        <span class="badge bg-warning">Pending</span>
                                        @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.user.edit',$user->id) }}" class="btn icon btn-primary"><i class="bi bi-pencil"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        @if (count($users) == 0)
                                            <td colspan="10" class="text-center">No users found</td>
                                        @endif
                                    </tr>

                                </tbody>
                            </table>
                            <ul class="pagination-overfollow">
                                <p>{{ $users->appends(array_filter(Request::all()))->links( "pagination::bootstrap-5")}}</p>
                            </ul>

                        </div>
                        </div>
                    </div>

                </section>
            </div>


@endsection
