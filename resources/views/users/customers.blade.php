@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Customers') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <a href="{{ route('export') }}" class="bit btn-primary">Export to XLSX</a>
                        <br/><br/>
                        <hr/>

                            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <input type="file" name="import_file">
                                <br/>
                                <input type="submit" value="Import" class="bth btn-info">

                            </form>
                        <hr/>

                       <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Email Verified On</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}
                                        <td>{{ $user->email_verified_at }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center">No users found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                       </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
