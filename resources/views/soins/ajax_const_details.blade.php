<div class="row "><div class="col-sm-1"></div>
  <div class="col-sm-5">
    <label for="cnst"><b>{{ $const->nom}} :</b></label>
    <input type="number" step="{{ $const->step }}" id="cnst" class="input input-sm " value="{{ $const->normale }}" min="{{ $const->min}}" max="{{ $const->max}}">     
    <button type="buton" class ="btn btn-sm btn-primary" id="addCste"><i class="fa fa-plus-circle bigger-120"></i></button>
      <button class="btn btn-sm btn-danger" id="btnRemovePoints"><i class="fa fa-trash-o fa-lg"></i></button> 
  </div><div class="col-sm-1"></div>
  <div class="col-sm-5">
  <label id="min">Min:{{ $const->min }}</label>&nbsp;<label id="mxn">Max:{{ $const->max }}</label>
  </div>
</div>
<div class="row"><div class="form-group">  
  <canvas id="{{ $const->nom }}" width="400" height="100"></canvas>
</div></div>
<script>
  $(function(){
    var  days = [], constValues= [],chart;
    constValues = getConstDatas('{{ $hosp_id }}','{{ $const->nom}}');
    days = getConstDatas('{{ $hosp_id }}','{{ $const->nom}}',1);//date
    var ctx = document.getElementById('{{ $const->nom}}').getContext('2d');
      chart =  new Chart(ctx, {
          type: 'line',
          data: {
              labels: days,
              datasets: [{
                  label: '{{ $const->nom}}' + "("+ '{{ $const->unite}}' + ")",
                  data: constValues,
                  backgroundColor:'{{ $const->color}}',
                  borderColor:'{{ $const->color}}',
                  borderWidth: 4,
              }]
          },
          options: {
              onClick: (e) => {
                const canvasPosition = Chart.helpers.getRelativePosition(e, chart);
              },
              interaction: {
                mode: 'nearest'
              },
              scales: {
                  xAxes: [{
                    gridLines: {
                        display: true,
                        drawBorder:true,

                    },
                    ticks: {
                      display: true,
                      fontFamily: "Montserrat",
                      fontColor: "#2c405a",
                      fontSize: 14,
                      
                    }
                  }],
                  y: {
                     beginAtZero: true, //min: '{{-- number_format((float)($const->min),2) --}}',
                     max: '{{ number_format((float)($const->max),2) }}',
                  },
              }//scales
          }
    });
    if(constValues.length == 0 )
      $("#btnRemovePoints").addClass('hidden'); 
    $("#addCste").click(function(e){
      var url = '{{ route('const.store')}}';
      var formData = {
        hospitalisation_id  : '{{ $hosp_id }}',
        '{{ $const->nom }}' : $('#cnst').val()
      };
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
      });
       $.ajax({
          type : 'POST',
          url :url,
          data:formData,
          success:function(data){   
            addData(chart,data.date,data['{{ $const->nom }}']);
            if($("#btnRemovePoints").hasClass( "hidden" ))
              $("#btnRemovePoints").removeClass('hidden');
          }
      })
    });
    $("#btnRemovePoints").click(function()
    {//ajax to remove laste
      var url = '{{ route('const.destroy',":slug") }}';//dataArray = chart.data.datasets[0].data;
      chart.data.labels.pop();
      var value = chart.data.datasets[0].data.pop();
      url = url.replace(':slug',value);
      var formData = {
        hosp_id  : '{{ $hosp_id }}',
        constename : '{{ $const->nom }}',
        constevalue : value,
      };  
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: url,
        type: "DELETE",
        data: formData,
        success: function (data) {
          if(chart.data.datasets[0].data.length == 0 )
            $("#btnRemovePoints").addClass('hidden');//chart.data.datasets[0].data = chart.data.datasets[0].data;
          chart.update();
        }
      });
    });
  })
</script>