@extends('layout')

@section('content')
    
      <div class="row">
       
       <div class="col-sm-2 col-md-2 back border" >
           <div class="h4 mb-5">登録ジャンル</div>
           ・{{$mygenre1}}<br>
           ・{{$mygenre2}}<br>
           ・{{$mygenre3}}<br>
       </div>
       
        <div class="col-sm-10 col-md-10">
            <div class="content">

                <div>
                    <a href="?ym={{ $prev }}" class="h6 text-primary">先月&lt;</a>
                    <span class="month h3">{{ $month }}</span>
                    <a href="?ym={{ $next }}" class="h6 text-primary">&gt;来月</a>
                </div>

                <table class="table table-bordered">
                    <tr>
                        <th>日</th>
                        <th>月</th>
                        <th>火</th>
                        <th>水</th>
                        <th>木</th>
                        <th>金</th>
                        <th>土</th>
                    </tr>
                    @foreach ($weeks as $week)
                        {!! $week !!}
                    @endforeach
                </table>

            </div>
            {{-- .content --}}
        </div>
        {{-- .flex-center .position-ref .full-height --}}
        </div>
        
@endsection