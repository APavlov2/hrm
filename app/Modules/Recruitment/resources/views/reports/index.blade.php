@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.filter')}}</div>
            {{Form::model($inputs, ['method' => 'get'])}}
            <div class="row">
                <div class="col-md-4">
                    {!! Form::label('first_name', trans('app.recruitment.reports.first_name').':') !!}
                    {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => trans('app.recruitment.reports.first_name')]) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('last_name', trans('app.recruitment.reports.last_name').':') !!}
                    {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => trans('app.recruitment.reports.last_name')]) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('email', trans('app.recruitment.reports.email').':') !!}
                    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => trans('app.recruitment.reports.email')]) !!}
                </div>
                <div class="col-md-12">
                    {!! Form::label('skills', trans('app.recruitment.reports.skills').':') !!}
                    {!! Form::select('skills[]', $allSkills, null, ['id' => 'skills', 'class' => 'form-control', 'multiple' => 'multiple']) !!}
                </div>
                <div class="col-md-6">
                    {!! Form::label('salary_from', trans('app.recruitment.reports.salary_range').':') !!}
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::text('salary_from', null, ['class' => 'form-control', 'placeholder' => trans('app.recruitment.reports.min_salary')]) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::text('salary_to', null, ['class' => 'form-control', 'placeholder' => trans('app.recruitment.reports.max_salary')]) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    {!! Form::label('contract_type_id', trans('app.recruitment.reports.contract_type').':') !!}
                    {!! Form::select('contract_type_id', $contractTypes, null, ['class' => 'form-control', 'placeholder' => trans('app.recruitment.reports.contract_type')]) !!}
                </div>
                <div class="col-md-3">
                    {!! Form::label('location', trans('app.recruitment.reports.location').':') !!}
                    {!! Form::select('location', locations(), null, ['class' => 'form-control', 'placeholder' => trans('app.recruitment.reports.location')]) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    {!! Form::submit(trans('app.filter'), ['class' => 'btn btn-primary pull-right']) !!}
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.recruitment.reports.main')}}</div>
            <table class="table table-bordered table-hover" id="recruitmentTable">
                <thead>
                    <th>{{trans('app.recruitment.reports.first_name')}}</th>
                    <th>{{trans('app.recruitment.reports.last_name')}}</th>
                    <th>{{trans('app.recruitment.reports.email')}}</th>
                    <th>{{trans('app.recruitment.reports.phone')}}</th>
                    <th>{{trans('app.recruitment.reports.skills')}}</th>
                    <th>{{trans('app.recruitment.reports.salary')}}</th>
                    <th>{{trans('app.recruitment.reports.contract_type')}}</th>
                    <th>{{trans('app.recruitment.reports.location')}}</th>
                    <th>{{trans('app.recruitment.reports.comments')}}</th>
                    <th></th>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@section('additionalCSS')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection
@section('additionalJS')
<script src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
    $(document).ready(function(){

        $('#skills').select2({
            tags: true
        });

        var table = $('#recruitmentTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("recruitment.reports.datatable")}}?{!!$filter!!}',
            columns: [
                {data: 0, name: 'first_name'},
                {data: 1, name: 'last_name'},
                {data: 2, name: 'email'},
                {data: 3, name: 'phone', sortable: false, searchable: false},
                {data: 4, name: 'skills', sortable: false, searchable: false},
                {data: 5, name: 'salary', sortable: false, searchable: false},
                {data: 6, name: 'contract_type', sortable: false, searchable: false},
                {data: 7, name: 'location', sortable: false, searchable: false},
                {data: 8, name: 'comments', sortable: false, searchable: false},
                {data: 9, name: 'actions', sortable: false, searchable: false}
            ]
        });
    });
</script>
@endsection