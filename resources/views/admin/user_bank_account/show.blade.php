<div class="container">
    <div class="row">
        <div class="toppad" >


            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $account->account_name }}</h3>
                </div>
                <div class="panel-body">
                    <div class="row">

                        <div class=" col-md-9 col-lg-9 ">
                            <table class="table table-user-information">
                                <tbody>
                                <tr>
                                    <td>Account Name:</td>
                                    <td>{{ $account->account_name }}</td>
                                </tr>

                                <tr>
                                    <td>Bank Name:</td>
                                    <td>{{ $account->bank_name }}</td>
                                </tr>

                                <tr>
                                    <td>Account Number:</td>
                                    <td>{{ $account->account_number }}</td>
                                </tr>

                                <tr>
                                    <td>Mobile Number:</td>
                                    <td>{{ $account->mobile_number }}</td>
                                </tr>

                                <tr>
                                    <td>NID:</td>
                                    <td>{{ $account->nid_number }}</td>
                                </tr>

                                <tr>
                                    <td>Bkash Number:</td>
                                    <td>{{ $account->bkash_number }}</td>
                                </tr>

                                <tr>
                                    <td>Details:</td>
                                    <td>{{ $account->details }}</td>
                                </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
