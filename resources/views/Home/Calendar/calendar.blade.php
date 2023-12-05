@extends('Layouts.Default')
@section('title', 'カレンダー')
@section('CSS')
    <style>
        .fc-daygrid-day-events {
            height: 80px;
        }
        .fc-prev-button {
            background: #007bff !important;
            border: none !important;
        }
        .fc-next-button {
            background: #007bff !important;
            border: none !important;
        }
        .fc-prev-button::after, .fc-next-button::before {
            content: attr(title);
        }
        .fc-col-header-cell-cushion {
            color: black;
            text-decoration: none;
        }
        .fc-daygrid-day-number {
            color: black;
            padding: 0;
            margin: 0 auto;
            text-decoration: none;
        }
    </style>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div id='calendar' class="mt-2 mx-2"></div>
    </div>
</div>
@endsection
@section('jQuery')
@endsection