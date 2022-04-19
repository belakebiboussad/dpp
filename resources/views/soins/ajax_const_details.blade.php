<div class="row ">
  <label for="{{ $const->nom}}"><b>{{ $const->nom}} :</b></label>
  <input type="number" step="0.01" name="{{ $const->nom}}" class="input input-sm " value="{{ $const->normale }}" min="{{ $const->min}}" max="{{ $const->max}}">     
  <button type="buton" class ="btn btn-sm btn-primary" id="addCste"><i class="fa fa-plus-circle bigger-120" style="color:black"></i></button>
</div>

<div class="row">
 <div class="form-group">  
  <canvas id="{{ $const->nom }}" width="400" height="100"></canvas>
  </div>
</div>
<script>
  $(function(){
    var days = []; var constValues= [];
    constValues = getConstDatas('{{ $hosp_id }}','{{ $const->nom}}');
    if(constValues.length > 0 )
    {
      days = getConstDatas('{{ $hosp_id }}','date');
      var ctx = document.getElementById('{{ $const->nom}}').getContext('2d');
      new Chart(ctx, {
            type: 'line',
            data: {
                labels: days,
                datasets: [{
                    label: '{{ $const->nom}}' + "("+ '{{ $const->unite}}' + ")",
                    data: constValues,
                    backgroundColor: [
                      'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                      'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    },
                }//scales
            }
      });
      $("#addCste").click(function(e){
        
      })
    }
  });
</script>