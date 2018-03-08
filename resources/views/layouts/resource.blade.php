@if(Session :: has('update'))
<div class="col-md-4 alert alert-warning col-md-offset-4">
    <p class="flash label label-warning"><h5>{{Session :: get('update')}}</h5></p>
</div>
@endif
@if(Session :: has('create'))
<div class="col-md-4 alert alert-success col-md-offset-4">
    <p class="flash label label-success"><h5>{{Session :: get('create')}}</h5></p>
</div>
@endif
@if(Session :: has('delete'))
<div class="col-md-4 alert alert-danger col-md-offset-4">
    <p class="flash label label-danger"><h5>{{Session :: get('delete')}}</h5></p>
</div>
@endif
@if(Session :: has('register'))
<div class="col-md-4 alert alert-info col-md-offset-4">
    <p class="flash label label-info"><h5>{{Session :: get('register')}}</h5></p>
</div>
@endif
@if(Session :: has('feedback'))
<div class="col-md-4 alert alert-info col-md-offset-4">
    <p class="flash label label-info"><h5>{{Session :: get('feedback')}}</h5></p>
</div>  
@endif
</div>
<div class="row">
    @if( $errors->any() )
        <div class="col-md-ofsset-4 col-md-4">
            @foreach($errors->all() as $error)
                <div class="alert alert-danger col-md-12">
                    <ul>
                        <li>{{$error}}</li>
                    </ul>
                </div>
            @endforeach
        </div>
    @endif
</div>
<style>
    .charts{
        background-color: rgba(0,0,0,0.4) !important;
    }
    .change-password{
        color: red;
        background-color: white;
        padding: 5px;
        border-radius: 3px;
    }
    .change-password: hover{
        color: white;
    }
    .fa-trash{
        color: red;
    }
    .alert{
        margin: 1 !important;
    }
    .alert ul li{
        position: relative;
        --top:-10px;
    }
    .fa-pencil{
        color:orange;
    }
    .table-btn{
        margin-left:90%;
        background-color: #00C853 !important;
        border: 0;
    }
    .btn-danger{
        background-color: #E53935 !important;
    }
    .btn-warning{
        background-color: #EF6C00 !important;
    }
    textarea, input[type="text"], input[type="password"], input[type="email"],  select, input[type="date"]{
        border : 0px !important;
        border-radius: 3px !important;
    }
    .table-borderless > tbody > tr > td,
    .table-borderless > tbody > tr > th,
    .table-borderless > tfoot > tr > td,
    .table-borderless > tfoot > tr > th,
    .table-borderless > thead > tr > td,
    .table-borderless > thead > tr > th {
        border: none !important;
    }
    .banner{
        background-color: rgba(0,0,0,0.4);
        border-radius: 3px;
        margin: 10px;
        padding: 20px;
    }
    .button, .btn-info{
        position: relative;
        bottom: 10px;
        right: 10%;
    }
    .centered{
        text-align: center;
    }
    .btn{
        border-radius: 100px;
    }
    #myInput {
        width: 80%;
        height:100%;
        font-size: 14px;
        padding: 10px 10px 10px;
    }


    #myTable {
        border-collapse: collapse;
        width: 100%;
        border: 1px solid #ddd;
    }
    #myTable tr {
        border-bottom: 1px solid #ddd;
    }
    input[type=text] {
        font-weight: normal;
    }
    .search:focus {
        box-shadow:0 0 5px rgba(0, 183,0, 1);
    }
    .search{
        border-radius: 100px !important;
    }
</style>