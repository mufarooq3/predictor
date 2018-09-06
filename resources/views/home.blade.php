<!DOCTYPE html>
<html lang="en">
<head>
    <title>Car Price Prediction</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{env('APP_URL')}}assets/dist/img/ico/favicon.png" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ['Alegreya+Sans:100,100i,300,300i,400,400i,500,500i,700,700i,800,800i,900,900i', 'Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i', 'Open Sans']
            }
        });
    </script>
    <!-- START GLOBAL MANDATORY STYLE -->
    <link href="{{env('APP_URL')}}assets/dist/css/base.css" rel="stylesheet" type="text/css"/>
    <!-- START THEME LAYOUT STYLE -->
    <link href="{{env('APP_URL')}}assets/dist/css/component_ui.min.css" rel="stylesheet" type="text/css"/>
    <link id="defaultTheme" href="{{env('APP_URL')}}assets/dist/css/skins/skin-dark-1.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{env('APP_URL')}}assets/dist/css/custom.css" rel="stylesheet" type="text/css"/>

</head>
<body>

<div class="container">
    <h2>Car Price Prediction</h2>
    <form action="{{route('predict')}}" method="post" class="form-group">
        {{csrf_field()}}
        <div class="row">
            <div class="col-md-3">
                <label for="make" class="col-form-label">Select Make</label>
                <input class="form-control" list="make" placeholder="Select car make" name="make">
            </div>

            <div class="col-md-3">
                <label for="model" class="col-form-label">Select Model</label>
                <input class="form-control" list="model" placeholder="Select car model" name="model">
            </div>

            <div class="col-md-3">
                <label for="fuel" class="col-form-label">Select Fuel</label>
                <input class="form-control" list="fuel" placeholder="Select car fuel" name="fuel">
            </div>

            <div class="col-md-3">
                <label for="body_type" class="col-form-label">Select Body Type</label>
                <input class="form-control" list="body_type" placeholder="Select car body_type" name="bodytype">
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-md-3">
                <label for="state" class="col-form-label">Select State</label>
                <input class="form-control" list="state" placeholder="Select car state" name="state">
            </div>

            <div class="col-md-3">
                <label for="badge" class="col-form-label">Select Badge</label>
                <input class="form-control" list="badge" placeholder="Select car badge" name="badge">
            </div>

            <div class="col-md-3">
                <label for="year" class="col-form-label">Select Year</label>
                <input class="form-control" list="year" placeholder="Select car Year" name="year">
            </div>

            <div class="col-md-3">
                <label for="km" class="col-form-label">Select Km_Driven</label>
                <input type="number" class="form-control" id="km" placeholder="Enter driven kilometer" name="km">
            </div>

            <div class="col-md-12">
                <button id="checkPrice" style="margin-top: 5%;" class="form-control btn btn-primary">Evaluate</button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-6">
                <br><br>
                <h2><label class="text text-success pull-right" >Evaluated Price: </label></h2>
            </div>
            <div class="col-md-6 col-sm-6">
                <br><br>
                <h2><label id="price" class="text text-info" >$0</label></h2>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6 col-sm-6">
                <br><br>
                <h2><label class="text text-success pull-right">Normal Price: </label></h2>
            </div>
            <div class="col-md-6 col-sm-6">
                <br><br>
                <h2><label id="normalPrice" class="text text-info">$0</label></h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-6">
                <br><br>
                <h2><label class="text text-success pull-right">Cheap Price: </label></h2>
            </div>
            <div class="col-md-6 col-sm-6">
                <br><br>
                <h2><label id="cheapPrice" class="text text-info">$0</label></h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-6">
                <br><br>
                <h2><label class="text text-success pull-right">Super Cheap Price: </label></h2>
            </div>
            <div class="col-md-6 col-sm-6">
                <br><br>
                <h2><label id="superCheapPrice" class="text text-info">$0</label></h2>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <br><br>
                <h2><label class="text text-success pull-right">Super Cheap Price: </label></h2>
            </div>
            <div class="col-md-6 col-sm-6">
                <br><br>
                <h2><label id="hyperCheapPrice" class="text text-info">$0</label></h2>
            </div>
        </div>
    </form>

    <datalist id="make">
        @foreach($makes as $make)
            <option value="{{$make->make}}">
        @endforeach
    </datalist>

    <datalist id="model">
        @foreach($models as $model)
            <option value="{{$model->model}}">
        @endforeach
    </datalist>

    <datalist id="body_type">
        @foreach($bodyTypes as $body_type)
            <option value="{{$body_type->body_type}}">
        @endforeach
    </datalist>

    <datalist id="fuel">
        @foreach($fuels as $fule)
            <option value="{{$fule->fuel_type}}">
        @endforeach
    </datalist>

    <datalist id="badge">
        @foreach($badges as $badge)
            <option value="{{$badge->name}}">
        @endforeach
    </datalist>

    <datalist id="year">
        @foreach($years as $year)
            <option value="{{$year->name}}">
        @endforeach
    </datalist>

    <datalist id="state">
        @foreach($states as $state)
            <option value="{{$state->state}}">
        @endforeach
    </datalist>

</div>
<script src="{{env('APP_URL')}}assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
<script src="{{env('APP_URL')}}assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
<script src="{{env('APP_URL')}}assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>


<script>
    $("#checkPrice").click(function(){
        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var url="{{env('APP_URL')}}predict";
        var data={
            make:$("input[name=make]").val(),
            model:$("input[name=model]").val(),
            fuel:$("input[name=fuel]").val(),
            bodyType:$("input[name=bodytype]").val(),
            state:$("input[name=state]").val(),
            badge:$("input[name=badge]").val(),
            year:$("input[name=year]").val(),
            km:$("input[name=km]").val()
        };

        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType:'JSON',
            success: success
        });
    });

    data=0;
    function success(data1) {
        console.log(data1);
        data=parseFloat(data1);
        $('#price').text("$"+data);
        $('#normalPrice').text("$"+(data-(data*0.1))+" - "+"$"+data);
        $('#cheapPrice').text("$"+(data-(data*0.35))+" - "+"$"+(data-(data*0.1)));
        $('#superCheapPrice').text("$"+(data-(data*0.5))+" - "+"$"+(data-(data*0.35)));
        $('#hyperCheapPrice').text("< $"+(data-(data*0.5)))
    }
</script>

</body>
</html>
