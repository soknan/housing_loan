@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">Product Name..<div class="pull-right">{{ HTML::link('','Edit Account Status') }}</div></div>
            <div class="panel-body">
                <p>Active in ... : </p>
                <p>Disbursal Date : </p>
                <p>Purpose Of Loan : </p>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Account Summary <div class="pull-right">{{ HTML::link('','View Repayment Schedule') }}</div></div>
            <div class="panel-body">
                <p>Total Amount Due on </p>
                <p>Amount In Arrears : </p>
                <div class="pull-right">{{ HTML::link('','View Installment Details') }}</div>
                <table class="table">
                    <tr>
                        <th></th>
                        <th>Original Loan</th>
                        <th>Amount Paid</th>
                        <th>Loan Balance</th>
                    </tr>
                    <tr>
                        <td>Principal</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Interest</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Fees</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Penalty</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Recent Activity<div class="pull-right">{{ HTML::link('','View All Account Activity') }}</div></div>
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Amount</th>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Account Details</div>
            <div class="panel-body">
                <p>Interest Rate Type :</p>
                <p>Interest Rate :</p>
                <p>Interest Rate TypDeducted at Disbursement :</p>
                <p>Currency :</p>
                <p>Frequency Of Installments :</p>
                <p>Principal Due On Last Installment :</p>
                <p>Grace Period Type :</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">Transaction</div>
            <div class="panel-body">
                {{ HTML::link('','Apply Payment').'</br>' }}
                {{ HTML::link('','Apply Fee').'</br>' }}
                {{ HTML::link('','Repay Loan') }}
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Performance History</div>
            <div class="panel-body">
                <p># Of Payments :</p>
                <p># Of Missed Payments :</p>
                <p>Days in Arrears :</p>
                <p>Loan Maturity Date :</p>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Question Groups</div>
            <div class="panel-body">
                Panel content
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Recent Notes</div>
            <div class="panel-body">
                <div class="pull-right">{{ HTML::link('','Add a Note') }}</div>
            </div>
        </div>
    </div>
</div>
@stop
