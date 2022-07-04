      <thead class="thin-border-bottom">
          <tr>
            <th class="center"><strong>Colloque de la semaine du</strong></th>
             <th class="center"><strong>Membres</strong></th>
            <th class="center"><strong>Colloque créer le</strong></th>
            <th class="center"><strong>Service</strong></h5></th>
            <th class="center"><strong>Etat</strong></h5></th>
            <th class="center"><em class="fa fa-cog"></em></th>
          </tr>
        </thead>
        <tbody>
    {{-- @foreach( $colloques as $cle=>$col)
          <tr>
            <td><?= date('Y-m-j',strtotime( $col->date .' sunday next week')-1);?></td>
            <td>
            @foreach($col->membres as $i=>$employe)
              <p class="text-primary">{{ $employe->full_name }}</p> 
            @endforeach
          </td>
          <td>{{ \Carbon\Carbon::parse($col->created_at)->format('y-m-d') }}</td>
          <td>{{ $col->Service->nom }}</td>
          <td>
            <span class="badge badge-{{( $col->getEtatID($col->etat)) === 0 ? 'warning':'primary' }}">
            {{ $col->etat }}
            </span>
          </td>
          <td class="center">
            <a href="{{ route('colloque.edit',$col->id)}} " class="btn btn-sm btn-success"><i class="ace-icon fa fa-pencil-square-o bigger-110"></i></a>
            @if($col->getEtatID($col->etat) == null)
              <a href="/runcolloque/{{ $col->id }}" class="btn btn-sm btn-green" title="Déroulement"><i class="ace-icon fa fa-cog  bigger-110"></i></a>
              <a href="{{ route('colloque.destroy',$col->id) }}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-sm btn-danger"><i class="ace-icon fa fa-trash-o bigger-110"></i>
            @endif
            </td>
          </tr>
          @endforeach --}}
              </tbody>