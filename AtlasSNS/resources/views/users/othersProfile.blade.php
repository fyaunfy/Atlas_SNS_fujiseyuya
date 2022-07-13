@extends('layouts.login')

@section('content')

<p>他のユーザーのプロフィール</p>

@foreach ($images as $images)
@if ($images->id)
<figure><img class="logo" src="{{ \Storage::url($images->images) }}"></figure>
@endif
@endforeach

@foreach ($list as $list)
<table>
@if ($list->user_id)
<tr>
<td><figure><img class="logo" src="{{ \Storage::url($list->images) }}"></figure></td>
<td><p>{{ $list->username }}：</p></td> 
<td><p>{{ $list->post }}：</p></td> 
</tr>
@endif
</table>
@endforeach

@endsection