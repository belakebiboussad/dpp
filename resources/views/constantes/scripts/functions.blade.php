<script  type="text/javascript" charset="utf-8" async defer>
function getConstDatas(hospId,constName)
{
  var constValues1 = [];
  url = "{{ route('getConstData') }}";
  $.ajax({
      url: url,
      data: {    
          "hosp_id":hospId,
          "const_name":constName,
      },
      async: false,
      success: function(result) {
        var finalArray = result.map(function (obj) {
          return obj[constName];
        });
        Array.prototype.push.apply(constValues1, finalArray); //return constValues1;
      },
  });
  return constValues1;
}
</script>