@extends('app')
@section('main-content')
<div class="container-fluid">
  <div class="page-header"> @include('patient._patientInfo',['patient'=>$visite->hospitalisation->patient])</div>
  <div class="row">
    <div class="col-xs-12">
      <div class="ui-jqgrid ui-widget ui-widget-content ui-corner-all" id="gbox_grid-table" dir="ltr" style="width: 1163px;">
        <div class="jqgrid-overlay ui-widget-overlay" id="lui_grid-table" style="display: none;"></div>
        <div class="loading ui-state-default ui-state-active" id="load_grid-table" style="display: none;">Saving...
        </div>
        <div class="ui-jqgrid-view " role="grid" id="gview_grid-table" style="width: 1163px;">
          <div class="ui-jqgrid-titlebar ui-jqgrid-caption ui-widget-header ui-corner-top ui-helper-clearfix">
            <a role="link" class="ui-jqgrid-titlebar-close HeaderButton ui-corner-all" title="Toggle Expand Collapse Grid" style="right: 0px;"><span class="ui-jqgrid-headlink ui-icon ui-icon-circle-triangle-n"></span>
            </a><span class="ui-jqgrid-title">jqGrid with inline editing</span>
        </div>
        <div class="ui-jqgrid-hdiv ui-state-default" style="width: 1163px;">
          <div class="ui-jqgrid-hbox">
            <table class="ui-jqgrid-htable ui-common-table " style="width: 1145px;" role="presentation" aria-labelledby="gbox_grid-table">
            <thead>
              <tr class="ui-jqgrid-labels" role="row">
                <th id="grid-table_cb" role="columnheader" class="ui-th-column ui-th-ltr ui-state-default" style="width: 35px;">
                  <div id="jqgh_grid-table_cb">
                    <input role="checkbox" id="cb_grid-table" class="cbox" type="checkbox">
                    <span class="s-ico" style="display:none">
                      <span sort="asc" class="ui-grid-ico-sort ui-icon-asc ui-sort-ltr ui-state-disabled ui-icon ui-icon-triangle-1-n">
                      </span>
                      <span sort="desc" class="ui-grid-ico-sort ui-icon-desc ui-sort-ltr ui-state-disabled ui-icon ui-icon-triangle-1-s">
                      </span>
                    </span>
                  </div>
                </th>
                <th id="grid-table_id" role="columnheader" class="ui-th-column ui-th-ltr ui-state-default" style="width: 99px;">
                <span class="ui-jqgrid-resize ui-jqgrid-resize-ltr" style="cursor: col-resize;">&nbsp;</span>
                <div id="jqgh_grid-table_id" class="ui-jqgrid-sortable">ID
                  <span class="s-ico" style="display:none">
                    <span sort="asc" class="ui-grid-ico-sort ui-icon-asc ui-sort-ltr ui-state-disabled ui-icon ui-icon-triangle-1-n"></span>
                    <span sort="desc" class="ui-grid-ico-sort ui-icon-desc ui-sort-ltr ui-state-disabled ui-icon ui-icon-triangle-1-s"></span>
                  </span>
                </div>
              </th>
              <th id="grid-table_sdate" role="columnheader" class="ui-th-column ui-th-ltr ui-state-default" style="width: 148px;">
                <span class="ui-jqgrid-resize ui-jqgrid-resize-ltr" style="cursor: col-resize;">&nbsp;</span>
                <div id="jqgh_grid-table_sdate" class="ui-jqgrid-sortable">Last Sales
                  <span class="s-ico" style="display:none">
                    <span sort="asc" class="ui-grid-ico-sort ui-icon-asc ui-sort-ltr ui-state-disabled ui-icon ui-icon-triangle-1-n"></span>
                    <span sort="desc" class="ui-grid-ico-sort ui-icon-desc ui-sort-ltr ui-state-disabled ui-icon ui-icon-triangle-1-s"></span>
                  </span>
                </div>
              </th>
              <th id="grid-table_name" role="columnheader" class="ui-th-column ui-th-ltr ui-state-default" style="width: 247px;">
                <span class="ui-jqgrid-resize ui-jqgrid-resize-ltr" style="cursor: col-resize;">&nbsp;</span>
                <div id="jqgh_grid-table_name" class="ui-jqgrid-sortable">Name
                  <span class="s-ico" style="display:none">
                    <span sort="asc" class="ui-grid-ico-sort ui-icon-asc ui-sort-ltr ui-state-disabled ui-icon ui-icon-triangle-1-n"></span>
                    <span sort="desc" class="ui-grid-ico-sort ui-icon-desc ui-sort-ltr ui-state-disabled ui-icon ui-icon-triangle-1-s"></span>
                  </span>
                </div>
              </th>
              <th id="grid-table_stock" role="columnheader" class="ui-th-column ui-th-ltr ui-state-default" style="width: 115px;">
                <span class="ui-jqgrid-resize ui-jqgrid-resize-ltr" style="cursor: col-resize;">&nbsp;</span>
                <div id="jqgh_grid-table_stock" class="ui-jqgrid-sortable">Stock
                  <span class="s-ico" style="display:none">
                    <span sort="asc" class="ui-grid-ico-sort ui-icon-asc ui-sort-ltr ui-state-disabled ui-icon ui-icon-triangle-1-n"></span>
                   <span sort="desc" class="ui-grid-ico-sort ui-icon-desc ui-sort-ltr ui-state-disabled ui-icon ui-icon-triangle-1-s"></span>
                  </span>
                </div>
              </th>
              <th id="grid-table_ship" role="columnheader" class="ui-th-column ui-th-ltr ui-state-default" style="width: 148px;"><span class="ui-jqgrid-resize ui-jqgrid-resize-ltr" style="cursor: col-resize;">&nbsp;</span><div id="jqgh_grid-table_ship" class="ui-jqgrid-sortable">Ship via<span class="s-ico" style="display:none"><span sort="asc" class="ui-grid-ico-sort ui-icon-asc ui-sort-ltr ui-state-disabled ui-icon ui-icon-triangle-1-n"></span><span sort="desc" class="ui-grid-ico-sort ui-icon-desc ui-sort-ltr ui-state-disabled ui-icon ui-icon-triangle-1-s"></span></span></div></th>
              <th id="grid-table_note" role="columnheader" class="ui-th-column ui-th-ltr ui-state-default" style="width: 248px;">
                <span class="ui-jqgrid-resize ui-jqgrid-resize-ltr" style="cursor: col-resize;">&nbsp;</span>
                <div id="jqgh_grid-table_note" class="ui-jqgrid-sortable">Notes<span class="s-ico" style="display:none"><span sort="asc" class="ui-grid-ico-sort ui-icon-asc ui-sort-ltr ui-state-disabled ui-icon ui-icon-triangle-1-n"></span><span sort="desc" class="ui-grid-ico-sort ui-icon-desc ui-sort-ltr ui-state-disabled ui-icon ui-icon-triangle-1-s"></span></span>
                </div>
              </th>
                 <th id="grid-table_subgrid" role="columnheader" class="ui-th-column ui-th-ltr ui-state-default" style="width: 25px;">
                  <div id="jqgh_grid-table_subgrid">
                    <span class="s-ico" style="display:none">
                      <span sort="asc" class="ui-grid-ico-sort ui-icon-asc ui-sort-ltr ui-state-disabled ui-icon ui-icon-triangle-1-n"></span>
                      <span sort="desc" class="ui-grid-ico-sort ui-icon-desc ui-sort-ltr ui-state-disabled ui-icon ui-icon-triangle-1-s">
                      </span>
                    </span>
                  </div>
                </th>
                <th id="grid-table_myac" role="columnheader" class="ui-th-column ui-th-ltr ui-state-default" style="width: 80px;">
                  <span class="ui-jqgrid-resize ui-jqgrid-resize-ltr" style="cursor: col-resize;">&nbsp;</span>
                  <div id="jqgh_grid-table_myac" class="ui-jqgrid-sortable">
                   <span class="s-ico" style="display:none">
                    <span sort="asc" class="ui-grid-ico-sort ui-icon-asc ui-sort-ltr ui-state-disabled ui-icon ui-icon-triangle-1-n"></span>
                    <span sort="desc" class="ui-grid-ico-sort ui-icon-desc ui-sort-ltr ui-state-disabled ui-icon ui-icon-triangle-1-s"></span>
                  </span>
                </div>
              </th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
    <div class="ui-jqgrid-bdiv" style="height: 250px; width: 1163px;">
      <div style="position:relative;">
        <div></div>
        <table id="grid-table" tabindex="0" role="presentation" aria-multiselectable="true" aria-labelledby="gbox_grid-table" class="ui-jqgrid-btable ui-common-table" style="width: 1145px;">
          <tbody>
            <tr class="jqgfirstrow" role="row">
              <td role="gridcell" style="height:0px;width:35px;"></td>
              <td role="gridcell" style="height:0px;width:25px;"></td>
              <td role="gridcell" style="height:0px;width:80px;"></td>
              <td role="gridcell" style="height: 0px; width: 99px;"></td>
              <td role="gridcell" style="height: 0px; width: 148px;"></td>
              <td role="gridcell" style="height: 0px; width: 247px;"></td>
              <td role="gridcell" style="height: 0px; width: 115px;"></td>
              <td role="gridcell" style="height: 0px; width: 148px;"></td>
              <td role="gridcell" style="height: 0px; width: 248px;"></td>
            </tr>
            <tr role="row" id="1" tabindex="-1" class="jqgrow ui-row-ltr ui-widget-content">
              <td role="gridcell" style="text-align:center;width: 35px;" aria-describedby="grid-table_cb"><input role="checkbox" type="checkbox" id="jqg_grid-table_1" class="cbox cbox" name="jqg_grid-table_1">
              </td>
              <td role="gridcell" aria-describedby="grid-table_subgrid" class="ui-sgcollapsed sgcollapsed" style="">
                <a style="cursor:pointer;" class="ui-sghref"><span class="ui-icon ace-icon fa fa-plus center bigger-110 blue"></span></a>
              </td>
              <td role="gridcell" style="" title="" aria-describedby="grid-table_myac">
                <div style="margin-left:8px;">
                  <div title="" style="float:left;cursor:pointer;" class="ui-pg-div ui-inline-edit" id="jEditButton_1" onclick="jQuery.fn.fmatter.rowactions.call(this,'edit');" onmouseover="jQuery(this).addClass('ui-state-hover');" onmouseout="jQuery(this).removeClass('ui-state-hover');" data-original-title="Edit selected row">
                    <span class="ui-icon ui-icon-pencil"></span>
                  </div>
                  <div title="" style="float:left;" class="ui-pg-div ui-inline-del" id="jDeleteButton_1" onclick="jQuery.fn.fmatter.rowactions.call(this,'del');" onmouseover="jQuery(this).addClass('ui-state-hover');" onmouseout="jQuery(this).removeClass('ui-state-hover');" data-original-title="Delete selected row">
                    <span class="ui-icon ui-icon-trash"></span>
                  </div>
                  <div title="" style="float:left;display:none" class="ui-pg-div ui-inline-save" id="jSaveButton_1" onclick="jQuery.fn.fmatter.rowactions.call(this,'save');" onmouseover="jQuery(this).addClass('ui-state-hover');" onmouseout="jQuery(this).removeClass('ui-state-hover');" data-original-title="Save row">
                    <span class="ui-icon ui-icon-disk"></span>
                  </div>
                  <div title="" style="float:left;display:none;" class="ui-pg-div ui-inline-cancel" id="jCancelButton_1" onclick="jQuery.fn.fmatter.rowactions.call(this,'cancel');" onmouseover="jQuery(this).addClass('ui-state-hover');" onmouseout="jQuery(this).removeClass('ui-state-hover');" data-original-title="Cancel row editing">
                    <span class="ui-icon ui-icon-cancel"></span>
                  </div>
                </div>
              </td>
              <td role="gridcell" style="" title="1" aria-describedby="grid-table_id">1</td>
              <td role="gridcell" style="" title="2007-12-03" aria-describedby="grid-table_sdate">2007-12-03</td>
              <td role="gridcell" style="" title="Desktop Computer" aria-describedby="grid-table_name">Desktop Computer</td>
              <td role="gridcell" style="" title="Yes" aria-describedby="grid-table_stock">Yes</td>
              <td role="gridcell" style="" title="FedEx" aria-describedby="grid-table_ship">FedEx</td>
              <td role="gridcell" style="" title="note" aria-describedby="grid-table_note">note</td>
            </tr>

          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="ui-jqgrid-resize-mark" id="rs_mgrid-table">&nbsp;</div><div id="grid-pager" class="ui-jqgrid-pager ui-state-default ui-corner-bottom" dir="ltr" style="width: 1163px;"><div id="pg_grid-pager" class="ui-pager-control" role="group"><table class="ui-pg-table ui-common-table ui-pager-table "><tbody><tr><td id="grid-pager_left" align="left"><table class="ui-pg-table navtable ui-common-table"><tbody><tr><td class="ui-pg-button ui-corner-all" title="" id="add_grid-table" data-original-title="Add new row"><div class="ui-pg-div"><span class="ui-icon ace-icon fa fa-plus-circle purple"></span></div></td><td class="ui-pg-button ui-corner-all" title="" id="edit_grid-table" data-original-title="Edit selected row"><div class="ui-pg-div"><span class="ui-icon ace-icon fa fa-pencil blue"></span></div></td><td class="ui-pg-button ui-corner-all" title="" id="view_grid-table" data-original-title="View selected row"><div class="ui-pg-div"><span class="ui-icon ace-icon fa fa-search-plus grey"></span></div></td><td class="ui-pg-button ui-corner-all" title="" id="del_grid-table" data-original-title="Delete selected row"><div class="ui-pg-div"><span class="ui-icon ace-icon fa fa-trash-o red"></span></div></td><td class="ui-pg-button ui-state-disabled" style="width:4px;" data-original-title="" title=""><span class="ui-separator"></span></td><td class="ui-pg-button ui-corner-all" title="" id="search_grid-table" data-original-title="Find records"><div class="ui-pg-div"><span class="ui-icon ace-icon fa fa-search orange"></span></div></td><td class="ui-pg-button ui-corner-all" title="" id="refresh_grid-table" data-original-title="Reload Grid"><div class="ui-pg-div"><span class="ui-icon ace-icon fa fa-refresh green"></span></div></td></tr></tbody></table></td><td id="grid-pager_center" align="center" style="white-space: pre; width: 335px;"><table class="ui-pg-table ui-common-table ui-paging-pager"><tbody><tr><td id="first_grid-pager" class="ui-pg-button ui-corner-all ui-state-disabled" title="First Page"><span class="ui-icon ace-icon fa fa-angle-double-left bigger-140"></span></td><td id="prev_grid-pager" class="ui-pg-button ui-corner-all ui-state-disabled" title="Previous Page"><span class="ui-icon ace-icon fa fa-angle-left bigger-140"></span></td><td class="ui-pg-button ui-state-disabled"><span class="ui-separator"></span></td><td id="input_grid-pager" dir="ltr">Page <input class="ui-pg-input ui-corner-all" type="text" size="2" maxlength="7" value="0" role="textbox"> of <span id="sp_1_grid-pager">3</span></td><td class="ui-pg-button ui-state-disabled"><span class="ui-separator"></span></td><td id="next_grid-pager" class="ui-pg-button ui-corner-all" title="Next Page"><span class="ui-icon ace-icon fa fa-angle-right bigger-140"></span></td><td id="last_grid-pager" class="ui-pg-button ui-corner-all" title="Last Page"><span class="ui-icon ace-icon fa fa-angle-double-right bigger-140"></span></td><td dir="ltr"><select class="ui-pg-selbox ui-widget-content ui-corner-all" role="listbox" title="Records per Page"><option role="option" value="10" selected="selected">10</option><option role="option" value="20">20</option><option role="option" value="30">30</option></select></td></tr></tbody></table></td><td id="grid-pager_right" align="right"><div dir="ltr" style="text-align:right" class="ui-paging-info">View 1 - 10 of 23</div></td></tr></tbody></table></div></div></div>
    </div>
  </div>
</div>
@endsection