@extends('layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    {{Form::open(['name' => 'profiles', 'url' => '/profiles/register', 'method' => 'put', 'files' => true])}}
    @csrf
    <!-- Page Heading -->
    <div class="row">
        <nav aria-label="breadcrumb" class="col-md-12 h5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="/profiles/{{$profileUser->id}}"><i class="fas fa-fw fa-user"></i>@lang('strings.profile')</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="/profiles/{{$profileUser->id}}">{{$profileUser->name}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('strings.edit')</li>
            </ol>
        </nav>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-2 mb-4 text-center">
            <img id="preview" class="img-fluid" src="/show/image?file={{user()->image_file}}" />

            <div class="col-lg-12 mt-2 text-center">
                <label>
                    <span class="d-sm-inline-block btn btn-primary shadow-sm text-nowrap">
                        <i class="fas fa-upload fa-sm text-white-50"></i><small>@lang('strings.choose_file')</small>
                        <input type="file" name="choose_profile_image" class="form-control" style="display:none" />
                    </span>
                </label>
                <label>
                    <span class="d-sm-inline-block btn btn-secondary shadow-sm text-nowrap">
                        <i class="fas fa-window-close fa-sm text-white-50"></i><small>@lang('strings.file_delete')</small>
                        <input type="file" name="profile_image_delete" class="form-control" style="display:none" />
                    </span>
                </label>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <table class="table table-bordered responsive-table">
                <tbody>
                    <tr>
                        <th class="bg-th text-secondary text-nowrap w-25">
                            @lang('strings.email')
                        </th>
                        <td class="bg-light text-dark view-box">
                            {{$profileUser->email}}
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-th text-secondary text-nowrap">
                            @lang('strings.name')
                        </th>
                        <td class="bg-light text-dark">
                            {{Form::text(
                                'name',
                                old('name') ?? $profileUser->name,
                                ['id' => 'name', 'class' => 'form-control',]
                            )}}
                            <div class="text-danger">{{$errors->first('name') ?? ''}}</div>
                        </td>
                    </tr>
                    @if(__('strings.name_kana') != 'strings.name_kana')
                    <tr>
                        <th class="bg-th text-secondary text-nowrap">
                            @lang('strings.name_kana')
                        </th>
                        <td class="bg-light text-dark">
                            {{Form::text(
                                'name_kana',
                                old('name_kana') ?? $profileUser->name_kana,
                                ['id' => 'name_kana', 'class' => 'form-control',]
                            )}}
                            <div class="text-danger">{{$errors->first('name_kana') ?? ''}}</div>
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <th class="bg-th text-secondary text-nowrap">
                            @lang('strings.birth_date')
                        </th>
                        <td class="bg-light text-dark">
                            {{Form::text(
                                'birth_date',
                                old('birth_date') ?? carbon($profileUser->birthdate)->format(\DateFormat::getDateFormat()),
                                ['id' => 'birth_date', 'class' => 'form-control',]
                            )}}
                            <div class="text-danger">{{$errors->first('birth_date') ?? ''}}</div>
                        </td>
                    </tr>

                    @foreach($userProfiles as $userProfile)
                    <tr>
                        <th class="bg-th text-secondary text-nowrap">
                            {{$userProfile->name}}
                        </th>
                        <td class="bg-light text-dark">
                            @if($userProfile->type == App\Libs\ProfileInputType::FILLIN)
                                {{Form::text('dynamic_values[$userProfile->id]', $userProfile->value, [
                                    'class' => 'form-control',
                                ])}}
                            @elseif($userProfile->type == App\Libs\ProfileInputType::DESCRIPTION)
                                <textarea
                                    name="dynamic_values[{{$userProfile->id}}]"
                                    rows="8"
                                    class="form-control">{{old('dynamic_values.' . $userProfile->id) ?? $userProfile->value}}</textarea>
                            @elseif($userProfile->type == App\Libs\ProfileInputType::CHOICE)
                                <select class="form-control" name="dynamic_values[{{$userProfile->id}}]">
                                    <optgroup label="{{$userProfile->name}}">
                                        @foreach($choices[$userProfile->id] as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            @endif
                            <div class="text-danger">{{$errors->first('dynamic_values.' . $userProfile->id) ?? ''}}</div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-lg-4 mb-4 d-none d-sm-inline-block">
            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                            src="/img/undraw_portfolio_feedback_6r17.svg" alt="..."
                            onselectstart="return false;" onmousedown="return false;">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8 mb-5 text-center">
            <a href="javascript:profiles.submit()" class="btn btn-success shadow-sm btn-edit-cancel-save">
                <i class="fas fa-check fa-sm"></i> @lang('strings.save')
            </a>
            <a href="/profiles/{{user()->id}}" class="btn btn-secondary shadow-sm btn-edit-cancel-save">
                <i class="fas fa-window-close fa-sm"></i> @lang('strings.cancel')
            </a>
        </div>

    </div>
    {{Form::close()}}

</div>
<!-- /.container-fluid -->

<script type="text/javascript">
    window.addEventListener("load", function() {
        $('#birth_date').datetimepicker({
            timepicker: false,
            format: 'Y/m/d',
        });
        $.datetimepicker.setLocale('ja');
    });

    $(function(){
        $("[name='choose_profile_image']").on('change', function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#preview").attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);   
        });
    });
</script>

@endsection