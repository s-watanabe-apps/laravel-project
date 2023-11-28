@extends('layouts.app')
@section('content')
<!-- Page Heading -->
<div class="row">
    <nav aria-label="breadcrumb" class="col-md-12 h6 font-weight-bold">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw fa-tools"></i> @lang('strings.user_management')</li>
        </ol>
    </nav>
</div>

<!-- Content Row -->
<div class="row mx-1">

    <!-- Tab Control -->
    <?php $tabIndex = 2;?>
    @include('managements.users.tabControl', ['index' => 2])

    <div class="col-lg-10 px-0 px-lg-2">
        {{Form::open(['name' => 'managementsUsers', 'url' => '/managements/users/register', 'method' => 'post', 'files' => true])}}
        @csrf

        <table class="table table-bordered responsive-table">
            <tbody>
                <tr>
                    <th>
                        @lang('strings.email')
                    </th>
                    <td>
                        {{$request->email}}
                        {{Form::hidden('email', $request->email)}}
                    </td>
                </tr>
                <tr>
                    <th>
                        @lang('strings.name')
                    </th>
                    <td>
                        {{$request->name}}
                        {{Form::hidden('name', $request->name)}}
                    </td>
                </tr>
            </tbody>
        </table>

        <a href="javascript:managementsUsers.submit()" class="btn btn-success shadow-sm btn-edit-cancel-save">
            <i class="fas fa-check fa-sm"></i> TEST
        </a>
        {{Form::close()}}
    </div>
</div>
@endsection