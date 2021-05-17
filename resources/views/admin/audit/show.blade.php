@extends('admin.layouts.main')
@section('title',trans('audit.detail'))
@section('content')
<div class="animated fadeIn">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">{{trans('audit.detail')}} </strong>
        </div>
        <div class="card-body">
          <table  class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>{{trans('audit.action')}}</th>
                <th>{{trans('audit.id-admin')}}</th>
                <th>{{trans('audit.time')}}</th>
                <th>{{trans('audit.url')}}</th>
                <th>{{trans('audit.old-value')}}</th>
                <th>{{trans('audit.new-value')}}</th>
              </tr>
            </thead>
            <tbody id="audits">
              @foreach($audits as $key => $audit)
              <tr>
                <td>
                   @if($audit->event == 'created')
                    <span class="badge badge-success">{{trans('audit.create')}}</span>
                  @elseif($audit->event == 'updated')
                    <span class="badge badge-info">{{trans('audit.update')}}</span>
                  @else
                    <span class="badge badge-danger">{{trans('audit.delete')}}</span>
                  @endif
                </td>
                <td>{{ $audit->user->name }}</td>
                <td>{{ $audit->created_at->format('H:i | d/m/Y') }}
                </td>
                <td><a href="{{$audit->url}}"><i class="fa fa-external-link" aria-hidden="true"></i></a></td>
                <td>
                  <table class="table">
                    @foreach($audit->old_values as $attribute => $value)
                      <tr>
                        <td><b>{{ $attribute }}</b></td>
                        <td>{{ $value }}</td>
                      </tr>
                    @endforeach
                  </table>
                </td>
                <td>
                  <table class="table">
                    @foreach($audit->new_values as $attribute => $value)
                      <tr>
                        <td><b>{{ $attribute }}</b></td>
                        <td>{{ $value }}</td>
                      </tr>
                    @endforeach
                  </table>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="card-footer">
            <a class="btn btn-outline-secondary border-left-primary" href="{{route('audit')}}"><i class="fa fa-undo" aria-hidden="true"></i></a>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
@endsection
