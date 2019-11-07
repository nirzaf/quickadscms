{OVERALL_HEADER}
<link rel="stylesheet" href="{SITE_URL}templates/{TPL_NAME}/assets/plugins/datatables/jquery.dataTables.min.css">
<link rel="stylesheet" href="{SITE_URL}templates/{TPL_NAME}/assets/plugins/datatables/responsive.dataTables.min.css">
<section id="main" class="clearfix  ad-profile-page">
    <div class="container">
        <div class="breadcrumb-section">
            <!-- breadcrumb -->
            <ol class="breadcrumb">
                <li><a href="{LINK_INDEX}"><i class="fa fa-home"></i> {LANG_HOME}</a></li>
                <li class="active">{LANG_TRANSACTION}</li>
                <div class="pull-right back-result"><a href="{LINK_LISTING}"><i class="fa fa-angle-double-left"></i>{LANG_BACK_RESULT}</a></div>
            </ol>
            <!-- breadcrumb -->
        </div>
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
                        <td colspan="18" class="notice text-16 dc">{LANG_NO_RESULT_FOUND}</td>
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
                                IF("{CURRENCY_POS}"=="BEF"){ {CURRENCY_SIGN} {:IF}
                                {TRANSACTIONS.amount}
                                IF("{CURRENCY_POS}"=="AFT"){ {CURRENCY_SIGN} {:IF}
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
    //var LANG_SEARCH = "{LANG_SEARCH}";

    $(document).ready(function () {
        $('#myTable').DataTable({
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
            columnDefs: [{
                className: 'control',
                orderable: false,
                targets: 0
            }]
        });
    });

</script>
{OVERALL_FOOTER}