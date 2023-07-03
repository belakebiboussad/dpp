<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title','Dossier patient')</title>
  @include('partials.head')
  @yield('style')
</head>
<body class="no-skin">
  @include('partials.navbar')
  @include('partials.scripts')
   <div class="main-container" id="main-container">
  <script type="text/javascript">
    try{ace.settings.check('main-container' , 'fixed')}catch(e){}
    function getProducts(id_gamme, id_spec=0,med_id = 0)
    {
      var html = '<option value="" selected disabled>Sélectionner...</option>';
      $.ajax({
          url : '/getproduits/'+id_gamme+'/'+id_spec,
          type : 'GET',
          dataType : 'json',
          success : function(data){
              $.each(data, function(){
                html += "<option value='"+this.id+"'>"+this.nom+"</option>";
              });
              $('#med_id').html(html);
              if(med_id != 0)
                $('#med_id').val(med_id);
          }
      });
    }
    function addDays()
    {
      var datefin = new Date($('.date').val());
      datefin.setDate(datefin.getDate() + parseInt($('.numberDays').val(), 10));
      $(".date_end").val(moment(datefin).format("YYYY-MM-DD"));        
    }
    function updateDureePrevue()//a fusionner updateDureePrevue
    { 
      var iDaysDelta = 0;
      var dEntree = $('.date').datepicker('getDate');
      var dSortie = $('.date_end').datepicker('getDate');
      if (dEntree && dSortie && (dSortie >= dEntree)) 
      {
        iDaysDelta = Math.floor((dSortie.getTime() - dEntree.getTime()) / 86400000);
        if(iDaysDelta < 0)            
          $(".date_end").datepicker("setDate", dEntree); 
      }else
        $(".date_end").datepicker("setDate", $('.date').datepicker('getDate'));
      $('.numberDays').val(iDaysDelta ); 
    }
   $(function(){
     $('#gamme').change(function(){
        switch($(this).val())
        {
          case "1":
            if($("#specialiteDiv").is(":hidden"))
              $("#specialiteDiv").show();
              break;
          case "2":
              if(!$("#specialiteDiv").is(":hidden"))
                $("#specialiteDiv").hide();
                if($("#med_id").prop('disabled') == true)
                  $("#med_id").prop('disabled',false);
                getProducts(2);
              break;
          case "3":
            if(!$("#specialiteDiv").is(":hidden"))
              $("#specialiteDiv").hide();
              getProducts(3);
              break;
          case "4":
            $("#specialiteDiv").hide();
            if($("#med_id").prop('disabled') == true)
                  $("#med_id").prop('disabled',false);
            getProducts(4);
            break;
          default:
            break; 
        }
      });
     $('#specPrd').change(function(){
        getProducts($('#gamme').val(),$(this).val());
      });
      $('#med_id').change(function(){
         $("#ajoutercmd").removeAttr("disabled");
      });
   });
    $(function(){
      $("select.groupeSanguin").change(function(){//var gs = 
      if($(this).children("option:selected").val() !=="")
      {
       if($(this).attr('name') === "gs")
              $("#rh" ).attr("disabled", false);
        else
        $("#rhf" ).attr("disabled", false);  
    }else
    {
      if($(this).attr('name') === "gs")
      {
        $("#rh" ).attr("disabled", true);
        $("select#rh").val(''); 
      }
      else
      {
        $("#rhf" ).attr("disabled", true);
        $("select#rhf").val(''); 
      }
    }
  });
  $("select.rhesus").change(function(){
        if($(this).children("option:selected").val() =="")
           if($(this).attr('name') === "rh")
            $("select#gs").val(''); 
          else
             $("select#gsf").val('');             
  });    
  $(document).on('click', '.selctetat', function(event){
      var data = '';
      $.ajax({
          type: 'GET',
          url: '/pdf/generate',
          data: data,
          xhrFields: {
              responseType: 'blob'
          },
          success: function(response){
              var blob = new Blob([response]);
              var link = document.createElement('a');
              link.href = window.URL.createObjectURL(blob);
              link.download = "Sample.pdf";
              link.click();
          },
          error: function(blob){
              console.log(blob);
          }
      });
  });
  $("#changePassword").click(function (e) {
    e.preventDefault();
    formSubmit($('#userChangePasswordForm')[0], this, function(xhr, form) {
      if (xhr.success) {  
        location.reload(true);
      } 
    });
  })
  $('#passwordResetbtn').click(function(e){//change by admin
      e.preventDefault();
      formSubmit($('#changePWD')[0], this, function(xhr, form) {
    }) 
  });
})
</script>
        @yield('page-script')
        @if( Auth::user()->is(1))
            @include('partials.sidebar_med')
        @elseif(Auth::user()->isIn([2,15]))
            @include('partials.sidebar_rec')
        @elseif(Auth::user()->is(4))
              @include('partials.sidebar')
        @elseif(Auth::user()->is(5))
               @include('partials.sidebar_sur')    
        @elseif(Auth::user()->is(6)) 
            @include('partials.sidebar_dele')
         @elseif(Auth::user()->is(8)) 
            @include('partials.sidebar_dir')           
        @elseif(Auth::user()->is(9))
            @include('partials.sidebar_agent_admis')
        @elseif(Auth::user()->is(10))
            @include('partials.sidebar_pharm')
        @elseif(Auth::user()->is(13))
            @include('partials.sidebar_med')
        @elseif(Auth::user()->is(3))
            @include('partials.sidebar_inf')
         @elseif(Auth::user()->is(11))
            @include('partials.sidebar_laboanalyses')    
        @elseif(Auth::user()->is(12))
            @include('partials.sidebar_radiologue')
        @elseif(Auth::user()->is(14))
            @include('partials.sidebar_med')           
        @endif
        <div class="main-content">
            <div class="main-content-inner"> {{-- @include('partials.breadcrumbs') --}}
              <div class="page-content">
               	 @yield('main-content')
              </div>
            </div>
        </div><!-- /main-content -->
        <div>{{-- @include('partials.footer') --}}
        </div>
    </div><!-- /main-container -->
</body>
</html>