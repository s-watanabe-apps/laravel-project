<table class="table table-bordered responsive-table">
    <tbody>
        <tr>
            <th>
                @lang('strings.mark')
            </th>
            <td>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    @foreach ($informationMarks as $informationMark)
                    <label class="btn btn-light active">
                        <input type="radio" value="{{$informationMark->id}}" name="mark_id" id="mark_id" autocomplete="off"
                            @if(isset($informations))
                                @if($informations->mark_id == $informationMark->id) checked @endif
                            @else
                                @if($informationMark->id == 1) checked @endif
                            @endif
                        >
                        <i class="fas {{$informationMark->mark}} text-primary-50"></i>
                    </label>
                    @endforeach
                </div>
                <div class="text-danger">{{$errors->first('mark') ?? ''}}</div>
            </td>
        </tr>
        <tr>
            <th>
                @lang('strings.title')
            </th>
            <td>
                {{Form::text(
                    'title',
                    $informations->title ?? old('title'),
                    ['id' => 'title', 'class' => 'form-control',]
                )}}
                <div class="text-danger">{{$errors->first('title') ?? ''}}</div>
            </td>
        </tr>
        <tr>
            <th>
                @lang('strings.body')
            </th>
            <td>
                <textarea class="form-control" name="body" id="summernote">{{$informations->body ?? old('body')}}</textarea>
                <div class="text-danger">{{$errors->first('body') ?? ''}}</div>
            </td>
        </tr>
        <tr>
            <th>
                @lang('strings.start_time')
            </th>
            <td>
                {{Form::text(
                    'start_time',
                    $informations->start_time ?? (old('start_time') ?? carbon()->format(\DateFormat::getDateTimeFullFormat())),
                    ['id' => 'start_time', 'class' => 'form-control',]
                )}}
                <div class="text-danger">{{$errors->first('start_time') ?? ''}}</div>
            </td>
        </tr>
        <tr>
            <th>
                @lang('strings.end_time')
            </th>
            <td>
                {{Form::text(
                    'end_time',
                    $informations->end_time ?? (old('end_time') ?? ''),
                    ['id' => 'end_time', 'class' => 'form-control',]
                )}}
                <div class="text-danger">{{$errors->first('end_time') ?? ''}}</div>
            </td>
        </tr>
        <tr>
            <th>
                @lang('strings.status')
            </th>
            <td>
                <input type="checkbox"
                    @if (!isset($informations) || $informations->status == \Status::ENABLED)
                        checked
                    @endif
                    name="status"
                    value="1"
                    data-onstyle="success" data-offstyle="secondary"
                    data-toggle="toggle"
                    data-size="sm"
                    data-on="@lang('strings.enable')"
                    data-off="@lang('strings.disable')" />
                <div class="text-danger">{{$errors->first('status') ?? ''}}</div>
            </td>
        </tr>
    </tbody>
</table>
