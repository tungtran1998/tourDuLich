@extends('admin.layouts.main')
@section('title',trans('audit.list'))
@section('content')
<div class="animated fadeIn">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">{{trans('audit.list')}}</strong>
        </div>
        <div class="card-body">
          <table id="bootstrap-data-table" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th class="text-center">{{trans('audit.stt')}}</th>
                <th class="text-center">{{trans('audit.action')}}</th>
                <th>{{trans('audit.id-admin')}}</th>
                <th>Model</th>
                <th>{{trans('audit.time')}}</th>
                <th class="text-center">{{trans('audit.actions')}}</th>
              </tr>
            </thead>
            <tbody id="audits">
              @foreach($audits as $key => $audit)
              <tr>
                <td class="text-center">{{++$key}}</td>
                <td class="text-center">
                  @if($audit->event == 'created')
                  <span class="badge badge-success">{{trans('audit.create')}}</span>
                  @elseif($audit->event == 'updated')
                  <span class="badge badge-info">{{trans('audit.update')}}</span>
                  @else
                  <span class="badge badge-danger">{{trans('audit.delete')}}</span>
                  @endif
                </td>
                <td>{{ $audit->user->name }}</td>
                <td>{{substr($audit->auditable_type, 11)}}
                </td>
                <td>{{ $audit->created_at->format('H-i : d/m/Y') }}
                </td>
                <td class="text-center" >
                  @can('audit-show')
                  <a href="{{route('audit.show',$audit->id)}}" class="ml-2"><i class="fa fa-tripadvisor"></i></a> 
                  @endcan
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
@endsection
