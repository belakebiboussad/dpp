<script  type="text/javascript" charset="utf-8" async defer>
function getConstDatas(hospId, constName, isDate = 0)
{
  var constValues1 = [];
  url = "{{ route('getConstData') }}";
  var formData ={    
          "hosp_id": hospId,
          "const_name": constName,
          "isDate" : isDate
  };

  $.ajax({
      url: url,
      data: formData, 
      async: false,
      success: function(result) {
        if(isDate)
          constName ='date';
          var finalArray = result.map(function (obj) {
             return obj[constName];
          });
        Array.prototype.push.apply(constValues1, finalArray);
      },
  });
  return constValues1;
}
function addData(chart, label, data) {
    chart.data.labels.push(label);
    chart.data.datasets.forEach((dataset) => {
        dataset.data.push(data);
    });
    chart.update();
  }
</script>