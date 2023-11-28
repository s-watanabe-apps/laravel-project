@extends('layouts.app')
@section('content')
<!-- Page Heading -->
<div class="row">
    <nav aria-label="breadcrumb" class="col-md-12 h6 font-weight-bold">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw fa-edit"></i> {{$freePages->title}}</li>
        </ol>
    </nav>
</div>

<!-- Content Row -->
<div class="row mx-1">
    <div class="col-md-10">
    {!!$freePages->body!!}
    </div>
    <div class="col-md-2">
    AD
    </div>
</div>
@endsection