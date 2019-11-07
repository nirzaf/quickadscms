{OVERALL_HEADER}
<link rel="stylesheet" href="{SITE_URL}templates/{TPL_NAME}/assets/plugins/datatables/jquery.dataTables.min.css">
<link rel="stylesheet" href="{SITE_URL}templates/{TPL_NAME}/assets/plugins/datatables/responsive.dataTables.min.css">
<div id="page-content">
    <div class="container">
        <ul class="breadcrumb bcstyle2">
            <li><a href="{LINK_INDEX}">{LANG_HOME}</a></li>
            <li class="active"><a>{LANG_TRANSACTION}</a></li>
        </ul>
        <a href="{LINK_POST-AD}" class="postadinner"><span> <i class="fa fa-plus-circle"></i> {LANG_POST_AD}</span></a>
        <!--end breadcrumb-->
        <section class="page-title center"><h1>{LANG_TRANSACTION}</h1></section>
        <!--end page-title-->

        <!-- Main Content -->
        <div class="row">
            <!-- Page-Content -->
            <div class="col-sm-12 page-content">
                <table class="table table-striped sep ver-mspace" id="myTable">
                    <thead>
                    <tr class="no-mar no-pad">
                        <th></th>
                        <th class="dl sep-right">{LANG_AD_TITLE}</th>
                        <th class="dl sep-right">{LANG_AMOUNT}</th>
                        <th class="dc sep-right ">{LANG_PREMIUM}</th>
                        <th class="dc sep-right">{LANG_PAYMENT_METHOD}</th>
                        <th class="dc sep-right">{LANG_DATE}</th>
                        <th class="dc sep-right ">{LANG_STATUS}</th>
                    </tr>
                    </thead>
                    IF("{T_BLANK}"=="0"){
                    <tbody>
                        <tr>
                            <td colspan="18" class="notice text-16 dc"> No transactions available</td>
                        </tr>
                    </tbody>
                    {:IF}
                    <tbody>
                    {LOOP: TRANSACTIONS}
                        <tr class="altrow">
                            <td class=" details-control"></td>
                            <td class="dc"><a href="{TRANSACTIONS.product_link}" target="_blank">{TRANSACTIONS.product_name}</a></td>
                            <td class="dl">
                                <div class="dl">
                                    IF("{CURRENCY_POS}"=="BEF"){ {CURRENCY_SIGN}{:IF}
                                    {TRANSACTIONS.amount}
                                    IF("{CURRENCY_POS}"=="AFT"){ {CURRENCY_SIGN}{:IF}
                                </div>
                            </td>
                            <td class="dc">{TRANSACTIONS.premium}</td>
                            <td class="dc"><span>{TRANSACTIONS.payment_by}</span></td>
                            <td class="dc"><span>{TRANSACTIONS.time}</span></td>
                            <td class="dc">{TRANSACTIONS.status}</td>
                        </tr>
                    {/LOOP: TRANSACTIONS}
                    </tbody>
                </table>
            </div>
            <!-- Page-Content -->
        </div>
        <!-- Main Content -->
    </div>
    <!-- container -->
</section>
<!-- ad-dashboard-page -->

<script src="{SITE_URL}templates/{TPL_NAME}/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{SITE_URL}templates/{TPL_NAME}/assets/plugins/datatables/dataTables.responsive.min.js"></script>

<script>
    $(document).ready(function(){
        $('#myTable').DataTable( {
            responsive: {
                details: {
                    type: 'column'
                }
            },
            "language": {
                "paginate": {
                    "previous": "{LANG_PREVIOUS}",
                    "next": "{LANG_NEXT}"
                },
                "search": "{LANG_SEARCH}",
                "lengthMenu": "{LANG_DISPLAY} _MENU_",
                "zeroRecords": "{LANG_NO_FOUND}",
                "info": "{LANG_PAGE} _PAGE_ - _PAGES_",
                "infoEmpty": "{LANG_NO_RESULT_FOUND}",
                "infoFiltered": "( {LANG_TOTAL_RECORD} _MAX_)"
            },
            columnDefs: [ {
                className: 'control',
                orderable: false,
                targets:   0
            } ]
        } );
    });

</script>
{OVERALL_FOOTER}