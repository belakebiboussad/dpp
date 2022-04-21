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
          <li class="tree-branch" data-template="treebranch" role="treeitem" aria-expanded="false">
            <i class="icon-caret ace-icon tree-plus"></i>&nbsp;
            <div class="tree-branch-header">
              <span class="tree-branch-name">
                <i class="icon-folder ace-icon fa fa-folder"></i>
                <span class="tree-label"></span>
              </span>
            </div>
            <ul class="tree-branch-children" role="group"></ul>
            <div class="tree-loader hidden" role="alert">
              <div class="tree-loading">
                <i class="ace-icon fa fa-refresh fa-spin blue"></i>
              </div>
            </div>
          </li>
          <li class="tree-item hide" data-template="treeitem" role="treeitem">
            <span class="tree-item-name">
              <span class="tree-label"></span>
            </span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>