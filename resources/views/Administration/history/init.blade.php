@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist" id='myTabs'>
            <li role="presentation" class="active" id="tabList"><a href="#list" aria-controls="home" role="tab" data-toggle="tab">List</a></li>
            
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="list">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @include('Administration.history.list')
                    </div>
                </div>

            </div>
            

        </div>
    </div>
</div>

{!!Html::script('js/Administration/history.js')!!}
@endsection