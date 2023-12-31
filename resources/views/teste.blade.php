@extends('app')
@section('main-content')
<form action="">
<div class="col-sm-6">
                    <div class="widget-box widget-color-green2">
                      <div class="widget-header">
                        <h4 class="widget-title lighter smaller">
                          Browse Files
                          <span class="smaller-80">(with selectable folders)</span>
                        </h4>
                      </div>

                      <div class="widget-body">
                        <div class="widget-main padding-8">
                          <ul id="tree2" class="tree tree-unselectable tree-folder-select" role="tree">
                          <li class="tree-branch hide" data-template="treebranch" role="treeitem" aria-expanded="false">       <i class="icon-caret ace-icon tree-plus"></i>&nbsp;       <div class="tree-branch-header">          <span class="tree-branch-name">           <i class="icon-folder ace-icon fa fa-folder"></i>           <span class="tree-label"></span>          </span>       </div>        <ul class="tree-branch-children" role="group"></ul>       <div class="tree-loader hidden" role="alert"><div class="tree-loading"><i class="ace-icon fa fa-refresh fa-spin blue"></i></div></div>      </li>     <li class="tree-item hide" data-template="treeitem" role="treeitem">        <span class="tree-item-name">                   <span class="tree-label"></span>        </span>     </li><li class="tree-branch tree-open" role="treeitem" aria-expanded="true">        <i class="icon-caret ace-icon tree-minus"></i>&nbsp;        <div class="tree-branch-header">          <span class="tree-branch-name">           <i class="icon-folder red ace-icon fa fa-folder-open"></i>            <span class="tree-label">Pictures</span>          </span>       </div>        <ul class="tree-branch-children" role="group"><li class="tree-branch" role="treeitem" aria-expanded="false">        <i class="icon-caret ace-icon tree-plus"></i>&nbsp;       <div class="tree-branch-header">          <span class="tree-branch-name">           <i class="icon-folder ace-icon fa fa-folder pink"></i>            <span class="tree-label">Wallpapers</span>          </span>       </div>        <ul class="tree-branch-children" role="group"></ul>       <div class="tree-loader hidden" role="alert"><div class="tree-loading"><i class="ace-icon fa fa-refresh fa-spin blue"></i></div></div>      </li><li class="tree-branch" role="treeitem" aria-expanded="false">       <i class="icon-caret ace-icon tree-plus"></i>&nbsp;       <div class="tree-branch-header">          <span class="tree-branch-name">           <i class="icon-folder ace-icon fa fa-folder pink"></i>            <span class="tree-label">Camera</span>          </span>       </div>        <ul class="tree-branch-children" role="group"></ul>       <div class="tree-loader hidden" role="alert"><div class="tree-loading"><i class="ace-icon fa fa-refresh fa-spin blue"></i></div></div>      </li></ul>        <div class="tree-loader hidden" role="alert"><div class="tree-loading"><i class="ace-icon fa fa-refresh fa-spin blue"></i></div></div>      </li><li class="tree-branch" role="treeitem" aria-expanded="false">       <i class="icon-caret ace-icon tree-plus"></i>&nbsp;       <div class="tree-branch-header">          <span class="tree-branch-name">           <i class="icon-folder ace-icon fa fa-folder orange"></i>            <span class="tree-label">Music</span>         </span>       </div>        <ul class="tree-branch-children" role="group"></ul>       <div class="tree-loader hidden" role="alert"><div class="tree-loading"><i class="ace-icon fa fa-refresh fa-spin blue"></i></div></div>      </li><li class="tree-branch" role="treeitem" aria-expanded="false">       <i class="icon-caret ace-icon tree-plus"></i>&nbsp;       <div class="tree-branch-header">          <span class="tree-branch-name">           <i class="icon-folder ace-icon fa fa-folder blue"></i>            <span class="tree-label">Video</span>         </span>       </div>        <ul class="tree-branch-children" role="group"></ul>       <div class="tree-loader hidden" role="alert"><div class="tree-loading"><i class="ace-icon fa fa-refresh fa-spin blue"></i></div></div>      </li><li class="tree-branch" role="treeitem" aria-expanded="false">       <i class="icon-caret ace-icon tree-plus"></i>&nbsp;       <div class="tree-branch-header">          <span class="tree-branch-name">           <i class="icon-folder ace-icon fa fa-folder green"></i>           <span class="tree-label">Documents</span>         </span>       </div>        <ul class="tree-branch-children" role="group"></ul>       <div class="tree-loader hidden" role="alert"><div class="tree-loading"><i class="ace-icon fa fa-refresh fa-spin blue"></i></div></div>      </li><li class="tree-branch" role="treeitem" aria-expanded="false">       <i class="icon-caret ace-icon tree-plus"></i>&nbsp;       <div class="tree-branch-header">          <span class="tree-branch-name">           <i class="icon-folder ace-icon fa fa-folder"></i>           <span class="tree-label">Backup</span>          </span>       </div>        <ul class="tree-branch-children" role="group"></ul>       <div class="tree-loader hidden" role="alert"><div class="tree-loading"><i class="ace-icon fa fa-refresh fa-spin blue"></i></div></div>      </li><li class="tree-item" role="treeitem">       <span class="tree-item-name">                   <span class="tree-label"><i class="ace-icon fa fa-file-text grey"></i> ReadMe.txt</span>        </span>     </li><li class="tree-item" role="treeitem">       <span class="tree-item-name">                   <span class="tree-label"><i class="ace-icon fa fa-book blue"></i> Manual.html</span>        </span>     </li></ul>
                        </div>
                      </div>
                    </div>
                  </div>
</form>
<script>  
$(function(){
    var sampleData = initiateDemoData();//see below


  $('#tree1').ace_tree({
    dataSource: sampleData['dataSource1'],
    multiSelect: true,
    cacheItems: true,
    'open-icon' : 'ace-icon tree-minus',
    'close-icon' : 'ace-icon tree-plus',
    'itemSelect' : true,
    'folderSelect': false,
    'selected-icon' : 'ace-icon fa fa-check',
    'unselected-icon' : 'ace-icon fa fa-times',
    loadingHTML : '<div class="tree-loading"><i class="ace-icon fa fa-refresh fa-spin blue"></i></div>'
  });
  
  $('#tree2').ace_tree({
    dataSource: sampleData['dataSource2'] ,
    loadingHTML:'<div class="tree-loading"><i class="ace-icon fa fa-refresh fa-spin blue"></i></div>',
    'open-icon' : 'ace-icon fa fa-folder-open',
    'close-icon' : 'ace-icon fa fa-folder',
    'itemSelect' : true,
    'folderSelect': true,
    'multiSelect': true,
    'selected-icon' : null,
    'unselected-icon' : null,
    'folder-open-icon' : 'ace-icon tree-plus',
    'folder-close-icon' : 'ace-icon tree-minus'
  });
  
  
  /**
  //Use something like this to reload data  
  $('#tree1').find("li:not([data-template])").remove();
  $('#tree1').tree('render');
  */
  
  
  /**
  //please refer to docs for more info
  $('#tree1')
  .on('loaded.fu.tree', function(e) {
  })
  .on('updated.fu.tree', function(e, result) {
  })
  .on('selected.fu.tree', function(e) {
  })
  .on('deselected.fu.tree', function(e) {
  })
  .on('opened.fu.tree', function(e) {
  })
  .on('closed.fu.tree', function(e) {
  });
  */
  
  
  function initiateDemoData(){
    var tree_data = {
      'for-sale' : {text: 'For Sale', type: 'folder'} ,
      'vehicles' : {text: 'Vehicles', type: 'folder'} ,
      'rentals' : {text: 'Rentals', type: 'folder'} ,
      'real-estate' : {text: 'Real Estate', type: 'folder'} ,
      'pets' : {text: 'Pets', type: 'folder'} ,
      'tickets' : {text: 'Tickets', type: 'item'} ,
      'services' : {text: 'Services', type: 'item'} ,
      'personals' : {text: 'Personals', type: 'item'}
    }

   
    var tree_data_2 = {
      'pictures' : {text: 'Pictures', type: 'folder', 'icon-class':'red'} ,
      'music' : {text: 'Music', type: 'folder', 'icon-class':'orange'}  ,
      'video' : {text: 'Video', type: 'folder', 'icon-class':'blue'}  ,
      'documents' : {text: 'Documents', type: 'folder', 'icon-class':'green'} ,
      'backup' : {text: 'Backup', type: 'folder'} ,
      'readme' : {text: '<i class="ace-icon fa fa-file-text grey"></i> ReadMe.txt', type: 'item'},
      'manual' : {text: '<i class="ace-icon fa fa-book blue"></i> Manual.html', type: 'item'}
    }
    tree_data_2['music']['additionalParameters'] = {
      'children' : [
        {text: '<i class="ace-icon fa fa-music blue"></i> song1.ogg', type: 'item'},
        {text: '<i class="ace-icon fa fa-music blue"></i> song2.ogg', type: 'item'},
        {text: '<i class="ace-icon fa fa-music blue"></i> song3.ogg', type: 'item'},
        {text: '<i class="ace-icon fa fa-music blue"></i> song4.ogg', type: 'item'},
        {text: '<i class="ace-icon fa fa-music blue"></i> song5.ogg', type: 'item'}
      ]
    }
    tree_data_2['video']['additionalParameters'] = {
      'children' : [
        {text: '<i class="ace-icon fa fa-film blue"></i> movie1.avi', type: 'item'},
        {text: '<i class="ace-icon fa fa-film blue"></i> movie2.avi', type: 'item'},
        {text: '<i class="ace-icon fa fa-film blue"></i> movie3.avi', type: 'item'},
        {text: '<i class="ace-icon fa fa-film blue"></i> movie4.avi', type: 'item'},
        {text: '<i class="ace-icon fa fa-film blue"></i> movie5.avi', type: 'item'}
      ]
    }
    tree_data_2['pictures']['additionalParameters'] = {
      'children' : {
        'wallpapers' : {text: 'Wallpapers', type: 'folder', 'icon-class':'pink'},
        'camera' : {text: 'Camera', type: 'folder', 'icon-class':'pink'}
      }
    }
    tree_data_2['pictures']['additionalParameters']['children']['wallpapers']['additionalParameters'] = {
      'children' : [
        {text: '<i class="ace-icon fa fa-picture-o green"></i> wallpaper1.jpg', type: 'item'},
        {text: '<i class="ace-icon fa fa-picture-o green"></i> wallpaper2.jpg', type: 'item'},
        {text: '<i class="ace-icon fa fa-picture-o green"></i> wallpaper3.jpg', type: 'item'},
        {text: '<i class="ace-icon fa fa-picture-o green"></i> wallpaper4.jpg', type: 'item'}
      ]
    }
    tree_data_2['pictures']['additionalParameters']['children']['camera']['additionalParameters'] = {
      'children' : [
        {text: '<i class="ace-icon fa fa-picture-o green"></i> photo1.jpg', type: 'item'},
        {text: '<i class="ace-icon fa fa-picture-o green"></i> photo2.jpg', type: 'item'},
        {text: '<i class="ace-icon fa fa-picture-o green"></i> photo3.jpg', type: 'item'},
        {text: '<i class="ace-icon fa fa-picture-o green"></i> photo4.jpg', type: 'item'},
        {text: '<i class="ace-icon fa fa-picture-o green"></i> photo5.jpg', type: 'item'},
        {text: '<i class="ace-icon fa fa-picture-o green"></i> photo6.jpg', type: 'item'}
      ]
    }


    tree_data_2['documents']['additionalParameters'] = {
      'children' : [
        {text: '<i class="ace-icon fa fa-file-text red"></i> document1.pdf', type: 'item'},
        {text: '<i class="ace-icon fa fa-file-text grey"></i> document2.doc', type: 'item'},
        {text: '<i class="ace-icon fa fa-file-text grey"></i> document3.doc', type: 'item'},
        {text: '<i class="ace-icon fa fa-file-text red"></i> document4.pdf', type: 'item'},
        {text: '<i class="ace-icon fa fa-file-text grey"></i> document5.doc', type: 'item'}
      ]
    }

    tree_data_2['backup']['additionalParameters'] = {
      'children' : [
        {text: '<i class="ace-icon fa fa-archive brown"></i> backup1.zip', type: 'item'},
        {text: '<i class="ace-icon fa fa-archive brown"></i> backup2.zip', type: 'item'},
        {text: '<i class="ace-icon fa fa-archive brown"></i> backup3.zip', type: 'item'},
        {text: '<i class="ace-icon fa fa-archive brown"></i> backup4.zip', type: 'item'}
      ]
    }
    var dataSource2 = function(options, callback){
      var $data = null
      if(!("text" in options) && !("type" in options)){
        $data = tree_data_2;//the root tree
        callback({ data: $data });
        return;
      }
      else if("type" in options && options.type == "folder") {
        if("additionalParameters" in options && "children" in options.additionalParameters)
          $data = options.additionalParameters.children || {};
        else $data = {}//no data
      }
      
      if($data != null)//this setTimeout is only for mimicking some random delay
        setTimeout(function(){callback({ data: $data });} , parseInt(Math.random() * 500) + 200);
    }

    
    return { 'dataSource2' : dataSource2}
  }

})
</script>
@stop