<?php
require_once('includes.php');

?>
<!-- Page JS Plugins CSS -->

<main class="app-layout-content">

    <!-- Page Content -->
    <div class="container-fluid p-y-md">
        <!-- Partial Table -->
        <div class="card">
            <div class="card-header">
                <h4>Cities in <?php echo $_GET['name']; ?></h4>
                <div class="pull-right">
                    <p class="text-muted">
                        <a href="loc_region.php?code=<?php echo get_countryID_by_state_id($_GET['code']); ?>" class="btn btn-info waves-effect waves-light m-r-10"><i class="fa fa-mail-reply"></i> Back</a>
                        <a href="#" data-url="panel/loc_city_add.php?code=<?php echo $_GET['code'] ?>" data-toggle="slidePanel" class="btn btn-success waves-effect waves-light m-r-10">Add City</a>
                    </p>
                </div>
            </div>
            <div class="card-block">
                <div id="js-table-list">
                    <table id="ajax_datatable" data-jsonfile="cities.php?code=<?php echo $_GET['code'] ?>" class="js-table-checkable table table-vcenter table-hover" data-tablesaw-mode="stack" data-plugin="animateList" data-animate="fade" data-child="tr" data-selectable="selectable">
                        <thead>
                        <tr>
                            <th class="text-center w-5 sortingNone">
                                <label class="css-input css-checkbox css-checkbox-default m-t-0 m-b-0">
                                    <input type="checkbox" id="check-all" name="check-all"><span></span>
                                </label>
                            </th>
                            <th>#ID</th>
                            <th>Local Name</th>
                            <th>Name</th>
                            <th>Admin1 Code</th>
                            <th>Admin2 Code</th>
                            <th class="sortingNone">Status</th>
                            <th class="sortingNone">Action</th>
                        </tr>
                        </thead>
                        <tbody id="ajax-services">

                        </tbody>
                    </table>

                </div>


            </div>
            <!-- .card-block -->
        </div>
        <!-- .card -->
        <!-- End Partial Table -->

    </div>
    <!-- .container-fluid -->
    <!-- End Page Content -->

</main>

<!-- Site Action -->
<div class="site-action">
    <button data-url="panel/loc_city_add.php?code=<?php echo $_GET['code'] ?>" data-toggle="slidePanel" id="slidepanel-show" style="display: none;"> </button>
    <button type="button" class="site-action-toggle btn-raised btn btn-success btn-floating">
        <i class="front-icon ion-android-add animation-scale-up" aria-hidden="true"></i>
        <i class="back-icon ion-android-close animation-scale-up" aria-hidden="true"></i>
    </button>
    <div class="site-action-buttons">
        <button type="button" data-ajax-response="deletemarked" data-ajax-action="deleteCity"
                class="btn-raised btn btn-danger btn-floating animation-slide-bottom">
            <i class="icon ion-android-delete" aria-hidden="true"></i>
        </button>
    </div>
</div>
<!-- End Site Action -->

<?php include("footer.php"); ?>


<script>
    $(function()
    {
        // Init page helpers (Table Tools helper)
        App.initHelpers('table-tools');
    });
</script>
</body>

</html>
