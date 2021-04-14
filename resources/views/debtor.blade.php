<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Dłużnicy</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.js"></script>
    
    <?php
            $dataPoints = array();
      for($i=0;$i<count($whos);$i++)
      {
          array_push($dataPoints, array("label"=> $whos[$i]->name, "y"=> str_replace(array('{"Suma":"', '"}'), '', $grupy[$i])));
      }

	
?>
    <script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	title:{
		text: "Dłużnicy"
	},
	subtitles: [{
		text: "w złotych polskich"
	}],
	data: [{
		type: "pie",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - #percent%",
		yValueFormatString: "###.## zł",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
    <style>
        body{

                background-color: bisque;

        }
        .title{
            text-align: center;
            background-color: transparent
        }
        .table-container{
            background-color: white;
            max-width: 900px;
            margin: 0 auto;
            margin-top: 2%;
        }   
        .footer-button{
            background-color: transparent;
            float: right;
            margin-top: 4%;
            margin-bottom: 2%;
        }
        table{
            max-width: 800px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    @include('layouts.navbar')
    <div class="table-container">
        <div class="title">
            <h3>Dłużnicy</h3>
        </div>
        @auth
        <table data-toggle="table">
            <thead style="background-color: #629755">
                <tr>
                    <th>#</th>
                    <th>Dłużnik</th>
                    <th>Data dodania</th>
                    <th>Adres e-mail</th>
                    <th>Dług</th>
                </tr>
            </thead>
            <tbody>
                @foreach($debtor as $debtor1)
                    @auth
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$debtor1->name}}</td>
                        <td>{{$debtor1->created_at}}</td>
                        <td>{{$debtor1->email}}</td>
                         <td>{{$debtor1->money}}
                        <br />
                        <a href="{{ route('edit', $debtor1) }}" class="btn btn-success btn-xs"
                        title="Edytuj"> Edytuj </a>
                        <a href="{{ route('delete', $debtor1->id) }}" 
                        class="btn btn-danger btn-xs bg-dark" 
                        onclick="return confirm('Jesteś pewien?')"
                        title="Skasuj"> Usuń</a>
                        </td>
                    </tr> 
                    @endauth
                    
                    
                @endforeach

                      
                 
             </tbody>
        </table>
        <br>
        <table data-toggle="table">
            <thead style="background-color: #629755">
                <tr>
                    <th>Dłużnik</th>
                    <th>Dług</th>
                    
                </tr>
            </thead>
            <tbody>

                   @for($i=0; $i<(count($whos));$i++)
                
                        @auth
                           
                         <tr>
                             <td>{{$whos[$i]->name}}</td>
                         <td>{{str_replace(array('{"Suma":"', '"}'), '', $grupy[$i])}}</td>
                         
                         </tr> 
                         
                         @endauth
                        
                         @endfor   
                         
             </tbody>
        </table>
           <div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> 
        
        <div class="footer-button">
<a href="{{ route('create') }}" class="btn btn-secondary">Dodaj</a>
</div>
        <br>       
        @endauth
    </div>     
  
    @guest
    <div class="table-container">
        <b>Zaloguj się, aby dodać dłużnika</b>
    </div>    
    @endguest       
</body>
</html>