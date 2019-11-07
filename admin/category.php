<?php
require_once('includes.php');
?>

<link href="js/plugins/jqueryui/jquery-ui.min.css" rel="stylesheet">

<!-- /.Language Translation modal -->
<div id="modal_LangTranslation" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Language Translation</h4>
                </div>
                <div class="modal-body">
                    <div class="loader" style="text-align: center;">
                        <img src="../loading.gif"/>
                    </div>
                    <div class="form-horizontal" id="displayData">
                        <!--Dynamic form fields-->
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="saveEditLanguage">Save</button>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.Language Translation modal -->

<!-- Page Content -->
<main class="app-layout-content">

    <!-- Page Content -->
    <div class="container-fluid p-y-md">
        <!-- Partial Table -->
        <div class="card">
            <div class="card-header">
                <h4>Categories</h4>
            </div>
            <div class="card-block">
                <!-- /row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <div id="quickad-tbs" class="wrap">
                                <div class="quickad-tbs-body">
                                    <div class="row">
                                        <div id="quickad-sidebar" class="col-sm-4">
                                            <div id="quickad-categories-list" class="quickad-nav">
                                                <div class="quickad-nav-item active quickad-category-item quickad-js-all-services">
                                                    <div class="quickad-padding-vertical-xs">All Categories</div>
                                                </div>
                                                <ul id="quickad-category-item-list" class="ui-sortable">
                                                    <?php
                                                    $rows = ORM::for_table($config['db']['pre'].'catagory_main')
                                                        ->order_by_asc('cat_order')
                                                        ->find_many();

                                                    foreach ($rows as $row) {
                                                        $catid = $row['cat_id'];
                                                        $catname = $row['cat_name'];
                                                        $caticon = $row['icon'];
                                                        $catslug = $row['slug'];
                                                        $catpicture = $row['picture'];
                                                        ?>
                                                        <li class="quickad-nav-item quickad-category-item" data-category-id="<?php echo $catid; ?>">
                                                            <div class="quickad-flexbox">
                                                                <div class="quickad-flex-cell quickad-vertical-middle" style="width: 1%">
                                                                    <i class="quickad-js-handle quickad-icon quickad-icon-draghandle quickad-margin-right-sm quickad-cursor-move ui-sortable-handle" title="Reorder"></i>

                                                                </div>
                                                                <div class="quickad-flex-cell quickad-vertical-middle">
                                                            <span class="displayed-value" style="display: inline;">
                                                                <i id="quickad-cat-icon" class="quickad-margin-right-sm <?php echo $caticon; ?>"
                                                                   title="<?php echo $catname; ?>"></i> <?php echo $catname; ?>
                                                            </span>
                                                                    <form method="post" id="edit-category-form" style="display: none">
                                                                        <div class="form-field form-required">
                                                                            <label for="quickad-category-name" style="color:#000;">Title</label>
                                                                            <input class="form-control input-lg" id="cat-name" type="text" name="name"
                                                                                   value="<?php echo $catname; ?>">
                                                                        </div>
                                                                        <div class="form-field form-required">
                                                                            <label for="quickad-category-name" style="color:#000;">Category icon class</label>
                                                                            <input class="form-control input-lg" id="cat-icon" type="text" name="icon" placeholder="Add icon class"
                                                                                   value="<?php echo $caticon; ?>">
                                                                        </div>
                                                                        <div class="form-field form-required">
                                                                            <label for="quickad-category-slug" style="color:#000;">Slug</label>
                                                                            <input class="form-control input-lg" id="cat-slug" type="text" name="slug"
                                                                                   value="<?php echo $catslug; ?>">
                                                                        </div>
                                                                        <div class="form-field form-required">
                                                                            <label for="quickad-category-slug" style="color:#000;">Picture</label>
                                                                            <input class="form-control input-lg" id="cat-picture" type="text" name="picture"
                                                                                   value="<?php echo $catpicture; ?>">
                                                                        </div>
                                                                        <input class="form-control input-lg" id="cat-id" type="hidden" name="id"
                                                                               value="<?php echo $catid; ?>" >
                                                                        <div class="text-right">
                                                                            <button type="submit" class="btn btn-success confirm">Save</button>
                                                                            <button type="button" id="cancel-button" class="btn btn-default">Cancel</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="quickad-flex-cell quickad-vertical-middle" style="width: 1%;font-size: 18px;">
                                                                    <?php
                                                                    if(get_option("userlangsel") == '1'){
                                                                    ?>
                                                                    <a href="#" class="fa fa-language text-default quickad-margin-horizontal-xs quickad-cat-lang-edit" data-category-id="<?php echo $catid; ?>" data-category-type="main" title="Edit-language"></a>
                                                                    <?php } ?>
                                                                </div>
                                                                <div class="quickad-flex-cell quickad-vertical-middle" style="width: 1%;font-size: 18px;">
                                                                    <a href="#" class="fa fa-pencil-square-o quickad-margin-horizontal-xs quickad-js-edit" title="Edit"></a>
                                                                </div>
                                                                <div class="quickad-flex-cell quickad-vertical-middle" style="width: 1%;font-size: 18px;">
                                                                    <!--<a href="#" class="fa fa-trash-o text-danger quickad-js-delete"
                                                                       title="Delete"></a>-->
                                                                    <button type="button" class="text-danger quickad-js-delete" style="border:none;background:  transparent;"><i class="fa fa-trash-o"></i></button>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    <?php  } ?>
                                                </ul>
                                            </div>

                                            <div class="form-group">
                                                <button id="quickad-new-category" type="button" class="btn btn-lg btn-block btn-success-outline"
                                                        data-original-title="" title=""><i class="dashicons dashicons-plus-alt"></i>New Category
                                                </button>
                                            </div>
                                            <form method="post" id="new-category-form" style="display: none">
                                                <div class="form-group quickad-margin-bottom-md">
                                                    <div class="form-field form-required">
                                                        <label for="quickad-category-name">Title</label>
                                                        <input class="form-control" id="quickad-category-name" type="text" name="name" required=""/>
                                                    </div>
                                                    <div class="form-field form-required">
                                                        <label for="quickad-category-slug">Slug</label>
                                                        <input class="form-control" id="quickad-category-slug" type="text" name="slug" required=""/>
                                                    </div>
                                                    <div class="form-field form-required">
                                                        <label for="quickad-category-name">Icon class for Category</label>
                                                        <input class="form-control" id="quickad-category-icon" type="text" name="icon" placeholder="fa fa-usd" required=""/>
                                                    </div>
                                                    <div class="form-field form-required">
                                                        <label for="quickad-category-name">Picture url</label>
                                                        <input class="form-control" id="quickad-category-icon" type="text" name="picture"/>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-success confirm">Save</button>
                                                    <button type="button" id="cancel-button" class="btn btn-default">Cancel</button>
                                                </div>
                                            </form>


                                        </div>

                                        <div id="quickad-services-wrapper" class="col-sm-8">
                                            <div class="panel panel-default quickad-main">
                                                <div class="panel-body">
                                                    <h4 class="quickad-block-head">
                                                        <span class="quickad-category-title">All Categories</span>
                                                        <button type="button" class="new-subcategory  ladda-button pull-right btn btn-success"
                                                                data-spinner-size="40" data-style="zoom-in">
                                                            <span class="ladda-label"><i class="glyphicon glyphicon-plus"></i>Add Sub-Category</span>
                                                        </button>
                                                    </h4>
                                                    <form method="post" id="new-subcategory-form" style="display: none">
                                                        <div class="form-group quickad-margin-bottom-md">
                                                            <div class="form-field form-required">
                                                                <label for="new-subcategory-name">Title</label>
                                                                <input class="form-control" id="new-subcategory-name" type="text" name="name" required=""/>
                                                                <input type="hidden" id="cat-id" name="cat_id" value="0">
                                                            </div>
                                                        </div>
                                                        <div class="text-right">
                                                            <button type="submit" class="btn btn-success confirm">Save</button>
                                                            <button type="button" id="cancel-button" class="btn btn-default">Cancel</button>
                                                        </div>
                                                    </form>

                                                    <p class="quickad-margin-top-xlg no-result" style="display: none;">No services found. Please add services</p>

                                                    <div class="quickad-margin-top-xlg" id="ab-services-list">
                                                        <div class="panel-group ui-sortable" id="services_list" role="tablist" aria-multiselectable="true">

                                                        </div>
                                                    </div>
                                                    <div class="text-right">
                                                        <button type="button" id="quickad-delete" class="btn btn-danger ladda-button"
                                                                data-spinner-size="40" data-style="zoom-in"><span class="ladda-label"><i
                                                                    class="glyphicon glyphicon-trash"></i> Delete</span></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="quickad-alert" class="quickad-alert"></div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.row -->
            </div>
            <!-- .card-block -->
        </div>
        <!-- .card -->
        <!-- End Partial Table -->

    </div>
    <!-- .container-fluid -->
    <!-- End Page Content -->

</main>

<script>
    function editSubCat(id){
        $('.ajax-subcat-edit').addClass('bookme-progress');
        var data = $('#'+id).serialize();
        $.post(ajaxurl+'?action=editSubCat&'+data, function (response) {
            if (response != 0) {
                quickadAlert({success: ['Successfully edited']});
                $('.ajax-subcat-edit').removeClass('bookme-progress');
            } else {
                quickadAlert({error: ['Problem in saving, Please try again.']});
                $('.ajax-subcat-edit').removeClass('bookme-progress');
            }
        });
    }
</script>
<?php include("footer.php"); ?>
<script src="js/plugins/jqueryui/jquery-ui.min.js"></script>
<script src="js/custom-manage/category.js"></script>
<script src="js/custom-manage/alert.js"></script>
</body></html>
