@extends('layouts.site')
@section('content')
    <empresa></empresa>
@endsection
@push('scripts')
    <script src="{{mix('js/p/empresa/app.js')}}"></script>
@endpush
