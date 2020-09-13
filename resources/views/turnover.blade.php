@extends('layouts.app')
@section('header')
@parent
@stop
@section('content')
<div class="container">
    <h1>
        Weekly turnover from : {{$from}} to {{$to}}
    </h1>
    <a class="btn btn-primary" href="{{url('/downolad-to-csv')}}">Download</a>
    <br>
    <br>
    <div class="row">
        <table class="table table-responsive table-bordered table-striped">
            @foreach($dataset as $key => $val)
            <thead>
            <tr>
                <td colspan="3">
                    brand : <strong>{{$key}}</strong>
                </td>
            </tr>
            </thead>
            <tbody>
            @foreach($val['data'] as $week)
            <tr>
                <td>
                    {{$week['date']}}
                </td>
                <td>
                    {{number_format($week['turnover'], 2)}}
                </td>
                <td></td>
            </tr>
            @endforeach
            <tr>
                <td colspan="2">Weekly <strong>{{$key}}</strong> Total Turnover</td>
                <td>
                    {{@number_format($val['weeklySum'], 2)}}
                </td>
            </tr>
            <tr>
                <td colspan="2">Excluded VAt 21%</strong></td>
                <td>
                    {{number_format($val['excVat'], 2)}}
                </td>
            </tr>
        </tbody>
            @endforeach
        </table>
    </div>
</div>
@stop

@section('footer')
@parent
@stop