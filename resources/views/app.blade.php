<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
   <meta charset="UTF-8">
    <title>@yield('title','Dossier patient')</title>
     @include('partials.htmlheader')
     @yield('style')
</head>
<body class="no-skin">
      @include('partials.navbar')
      @include('partials.scripts')
      <div class="main-container" id="main-container">
     <script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
        function createRDVModal(debut, fin, pid = 0, fixe=1)
        { 
          var debut = moment(debut).format('YYYY-MM-DD HH:mm'); 
          var fin = moment(fin).format('YYYY-MM-DD HH:mm');  
          if(pid != 0)
          {
            if('{{ Auth::user()->role_id }}' == 1)
            {
              var formData = { id_patient:pid,Debut_RDV:debut, Fin_RDV:fin, fixe:fixe  };
              $.ajaxSetup({
                   headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
              }); 
              $.ajax({
                    type : 'POST',
                    url : '/createRDV',
                    data:formData,  //dataType: 'json',
                    success:function(data){         
                        var color = (data['rdv']['fixe'] != 1)? '#87CEFA':'#378006';
                        var event = new Object();
                        event = {
                                title: data['patient']['Nom'] + "  " + data['patient']['Prenom']+" ,("+data['age']+" ans)",
                                start: debut,
                                end: fin,
                                id : data['rdv']['id'],
                                idPatient:data['patient']['id'],
                                fixe: data['rdv']['fixe'],
                                tel:data['patient']['tele_mobile1'] ,
                                age:data['age'],         
                                allDay: false,
                                //color:color, //'#87CEFA'
                        };
                         $('.calendar1').fullCalendar( 'renderEvent', event );//, true
                    },
                    error: function (data) {
                          console.log('Error:', data);
                    }
              });
            }else{
                    $('#Debut_RDV').val(debut);
                    $('#Fin_RDV').val(fin);
                    $('#fixe').val(fixe);
                    $('#addRDVModal').modal({
                           show: 'true'
                    }); 
            }
          }else{
                $('#Debut_RDV').val(debut);
                $('#Fin_RDV').val(fin);
                $(".es-list").empty(); 
                $('#fixe').val(fixe);
                $('#addRDVModal').modal({
                      show: 'true'
                }); 
          }   
      }
</script>
        @yield('page-script')
        @if( Auth::user()->role_id == 1)
            @include('partials.sidebar_med')
        @elseif( Auth::user()->role_id == 2)
            @include('partials.sidebar_rec')
        @elseif(Auth::user()->role_id == 4)
            @include('partials.sidebar')
        @elseif(Auth::user()->role_id == 5)
            @include('partials.sidebar_sur')    
        @elseif(Auth::user()->role_id == 6) 
            @include('partials.sidebar_dele')      
        @elseif(Auth::user()->role_id == 9)
            @include('partials.sidebar_agent_admis')
        @elseif(Auth::user()->role_id == 10)
            @include('partials.sidebar_pharm')
        @elseif(Auth::user()->role_id == 13)
            @include('partials.sidebar_chef_ser') 
        @elseif(Auth::user()->role_id == 3)
            @include('partials.sidebar_inf')
        @elseif(Auth::user()->role_id == 12)
            @include('partials.sidebar_radiologue')
        @elseif(Auth::user()->role_id == 14)
            @include('partials.sidebar_med')           
        @endif
        <div class="main-content">
            <div class="main-content-inner"> {{-- @include('partials.breadcrumbs') --}}
                <div class="page-content">
                  @include('flashy::message')
              	  @yield('main-content')
                </div>
                <!-- /page-content -->
            </div>
            <!-- /main-content-inner -->
        </div>
        <!-- /main-content -->
        <div>
            @include('partials.footer')
        </div>
    </div>
    <!-- /main-container -->
</body>
</html>
