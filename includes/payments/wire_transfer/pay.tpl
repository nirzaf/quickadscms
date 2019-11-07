{OVERALL_HEADER}
<style>
    .quickad-template{
        margin: 20px;
        font-family: Roboto,"Helvetica Neue",Helvetica,Arial,sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    .PaymentMethod-content-inner {
        position: relative;
        padding: 16px 24px 24px;
        border-radius: 0 0 3px 3px;
        background-color: #fff;
    }
    .quickad-template .default-table {
        width: 100%!important;
        border: none;
        border-collapse: collapse;
    }
    .PaymentMethod-infoTable {
        margin-bottom: 24px;
    }

    .quickad-template .default-table tbody {
        border: none;
        border-bottom: 1px solid #DEDEDE;
    }
    .quickad-template .default-table.table-alt-row tr:nth-child(even) {
        background-color: #F0F0F0;
    }
    .quickad-template .default-table tbody tr {
        border-top: 1px solid #DEDEDE;
        border-left: 1px solid #DEDEDE;
        border-right: 1px solid #DEDEDE;
        -webkit-transition: all .2s ease-out;
        transition: all .2s ease-out;
    }
    .quickad-template .default-table tbody tr:hover {
        -webkit-transition: all .2s ease-out;
        transition: all .2s ease-out;
        background-color: #dbf4ff!important;
        border: 1px solid #75d5ff!important;
    }
    .quickad-template .default-table tbody td {
        vertical-align: top;
    }
    .quickad-template .default-table td, .quickad-template .default-table th {
        padding: 13px;
    }
    .PaymentMethod-heading {
        font-size: 14px;
        line-height: 1.43;
        margin-bottom: 4px;
        color: #1f2836;
        font-weight: bold;
    }
    .PaymentMethod-label {
        border-radius: 3px 3px 0 0;
        font-size: 20px;
        font-weight: 700;
        color: #F7F7F7;
        background-color: #000;
        padding: 15px;
    }
    .PaymentMethod-info{font-size: 14px;
        line-height: 1.4;
        color: #1f2836;}
    .PaymentMethod-info b{font-weight: 600;}
</style>


<div class="container">
    <div class="quickad-template">
        <div class="PaymentMethod-label">
            <span><i class="fa fa-university" aria-hidden="true"></i> {LANG_BANK_DEPOSIT}</span>
        </div>
        <div class="PaymentMethod-content-inner">
            <div class="alert alert-success">

                {LANG_OFFLINE_PAYMENT_REQUEST}
            </div>
            <table class="default-table table-alt-row PaymentMethod-infoTable">
                <tbody>
                <tr>
                    <td>
                        <h5 class="PaymentMethod-heading">{LANG_BANK_ACCOUNT_DETAILS}</h5>
                        <span class="PaymentMethod-info">{BANK_INFO}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5 class="PaymentMethod-heading">{LANG_REFERENCE}</h5>
                        <span class="PaymentMethod-info">
                            {LANG_ORDER} : {ORDER_TITLE}<br>
                            {LANG_USERNAME}: {USERNAME}<br><br>
                            {LANG_OFFLINE_CREDIT_NOTE}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5 class="PaymentMethod-heading">{LANG_AMOUNT_TO_SEND}</h5>
                        <span class="PaymentMethod-info">{CURRENCY_SIGN}{AMOUNT} {CURRENCY_CODE}</span>
                    </td>
                </tr>
                </tbody>
            </table>
            <div style="text-align: right"><a href="{LINK_TRANSACTION}" class="btn btn-primary">{LANG_TRANSACTION}</a></div>
        </div>
    </div>
</div>
{OVERALL_FOOTER}