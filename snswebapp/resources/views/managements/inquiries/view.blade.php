@extends('app')
@section('content')

<div class="contents">
    <div class="subject">
        <span><a href="/managements/inquiries"><i class="fas fa-fw fa-tools"></i> @lang('strings.inquiry_list')</a></span>
        <span>&gt; @lang('strings.detail')</span>
    </div>

    <div class="vertical-contents">
        <div class="title">@lang('strings.inquiry_body')</div>
        <div class="input-label">@lang('strings.inquiry_type')</div>
        <div>{{$inquiry['type_name']}}</div>

        <div class="input-label">@lang('strings.email')</div>
        <div>{{$inquiry['email'] ?? '-'}}</div>

        <div class="input-label">@lang('strings.name')</div>
        @if (is_null($inquiry['user_id']))
        <div><span class="sq-gray">@lang('strings.non_member')</span> {{$inquiry['user_name']}}</div>
        @else
        <a href="/managements/users/{{$inquiry['user_id']}}">{{$inquiry['user_name']}}</a>
        @endif

        <div class="input-label">@lang('strings.inquiry_body')</div>
        <pre class="text-preview">{{$inquiry['text']}}</pre>

        <div class="input-label">@lang('strings.created_at')</div>
        <div>{{str_datetime_format($inquiry['created_at'])}}</div>

        <div class="input-label">@lang('strings.status')</div>
        <select name="status" class="w-25">
            <option value="0"></option>
            @foreach ($statuses as $key => $value)
            <option value="{{$key}}"
                @if ($key == $inquiry['status'])
                    selected
                @endif
            >{{$value}}</option>
            @endforeach
        </select>

        <div class="flex-contents">
            <input type="submit" class="post" value="@lang('strings.save')"></input>
        </div>

        <div class="title">返信履歴</div>
        <div class="input-label">2024/07/27 13:00 返信</div>
        <table class="table-managements">
            <tr style="border-color: #111111;">
                <th class="w-20 left">返信者</th>
                <td class="left"><a href="">ユーザー_０１</a></td>
            </tr>
            <tr>
                <th class="left">返信内容</th>
                <td class="left"><pre style="line-height: 20px;">渡部様
お問い合わせいただきありがとうございます。
それではさようなら。</pre></td>
            </tr>
        </table>

        <div class="title">返信する</div>
        <div class="input-label">返信内容</div>
        <textarea name="text" style="resize: vertical; padding: 5px;" rows="30"></textarea>

        <div class="flex-contents">
            <input type="submit" class="post" value="@lang('strings.confirm')"></input>
        </div>

    </div>


</div>

@endsection