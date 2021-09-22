<?php
require '..\vendor\autoload.php';

use PHPFECP\FECPClient;
use PHPFECP\FabrickError;
use PHPFECP\FabrickInvestorAccount;
use PHPFECP\FabrickPortalSuccessFee;

$doCompanySection = true;
$doInvestorSection = true;
$doCampaignSection = false;
$doOrderSection = false;
$doPaymentSection = false;
$doUnidentifiedTransferSection = true;
$doDisputeSection = false;
$doTestCase = false;
$doTestCase2 = false;

$portalId = 'PRTIT5B03000261';
$apiKey = 'CHPOEJCOKZYEOHXTSWABGDXJNFUTIPDKNT';
$investorIBAN = 'IT88R0326801602052609648050';

$client = new FECPClient( $portalId, $apiKey, 'sandbox' );

//COMPANY SECTION
if ( $doCompanySection ) {
    echo 'COMPANY SECTION' . PHP_EOL;

    //getCompanies
    $companies = $client->getCompanies();
    if ( $companies instanceof FabrickError ) {
        echo 'getCompanies() failed!' . PHP_EOL;
        var_dump( $companies );
        die();
    }
    else {
        echo 'getCompanies() success!' . PHP_EOL;
    }

    //getCompany
    $companyId = end( $companies )->companyId;
    $company = $client->getCompany( $companyId );
    if ( $company instanceof FabrickError ) {
        echo 'getCompany() failed!' . PHP_EOL;
        var_dump( $company );
        die();
    }
    else {
        echo 'getCompany() success!' . PHP_EOL;
    }
}
else {
    echo 'Company section skipped!' . PHP_EOL;
}

//INVESTOR SECTION
if ( $doInvestorSection ) {
    echo 'INVESTOR SECTION' . PHP_EOL;

    //createInvestor
    $investor = $client->createInvestor(
        '',
        '',
        'TEST INVESTOR',
        genRandomNumber(),
        'LEGAL_PERSON',
        'ADDRESS',
        '00100',
        'ROMA',
        'ITALIA',
        'surname.name@test.it',
        '+3902123456789'
    );
    if ( $investor instanceof FabrickError ) {
        echo 'createInvestor() failed!' . PHP_EOL;
        var_dump( $investor );
        die();
    }
    else {
        echo 'createInvestor() success!' . PHP_EOL;
    }

    //getInvestor
    $investorId = $investor->investorId;
    $investor = $client->getInvestor( $investorId );
    if ( $investor instanceof FabrickError ) {
        echo 'getInvestor() failed!' . PHP_EOL;
        var_dump( $investor );
        die();
    }
    else {
        echo 'getInvestor() success!' . PHP_EOL;
    }

    //updateInvestor
    $investorId = $investor->investorId;
    $investor = $client->updateInvestor(
        $investorId,
        $investor->name,
        $investor->surname,
        $investor->businessName,
        $investor->fiscalCode,
        $investor->type,
        $investor->address,
        $investor->postalCode,
        $investor->city,
        $investor->country,
        $investor->email,
        '+3906123456789'
    );
    if ( $investor instanceof FabrickError ) {
        echo 'updateInvestor() failed!' . PHP_EOL;
        var_dump( $investor );
        die();
    }
    else {
        echo 'updateInvestor() success!' . PHP_EOL;
    }

    //searchInvestors
    $investors = $client->searchInvestors();
    if ( $investors instanceof FabrickError ) {
        echo 'searchInvestors() failed!' . PHP_EOL;
        var_dump( $investors );
        die();
    }
    else {
        echo 'searchInvestors() success!' . PHP_EOL;
    }
}
else {
    echo 'Investor section skipped!' . PHP_EOL;
}

//CAMPAIGN SECTION
if ( $doCampaignSection ) {
    echo 'CAMPAIGN SECTION' . PHP_EOL;

    //createCampaign
    $campaign = $client->createCampaign(
        $companyId,
        genRandomString(),
        'TEST CAMPAIGN DESCRIPTION',
        10000,
        20000,
        'EUR',
        '2020-02-28',
        new FabrickPortalSuccessFee(
            '0',
            '5.00'
        )
    );
    if ( $campaign instanceof FabrickError ) {
        echo 'createCampaign() failed!' . PHP_EOL;
        var_dump( $campaign );
        die();
    }
    else {
        echo 'createCampaign() success!' . PHP_EOL;
    }

    //searchCampaigns
    $campaigns = $client->searchCampaigns();
    if ( $campaigns instanceof FabrickError ) {
        echo 'searchCampaigns() failed!' . PHP_EOL;
        var_dump( $campaigns );
        die();
    }
    else {
        echo 'searchCampaigns() success!' . PHP_EOL;
    }

    //getCampaign
    $campaignId = $campaign->campaignId;
    $campaign = $client->getCampaign( $campaignId );
    if ( $campaign instanceof FabrickError ) {
        echo 'getCampaign() failed!' . PHP_EOL;
        var_dump( $campaign );
        die();
    }
    else {
        echo 'getCampaign() success!' . PHP_EOL;
    }

    //updateCampaign
    $campaignId = $campaign->campaignId;
    $campaign = $client->updateCampaign(
        $campaignId,
        null,
        null,
        null,
        30000
    );
    if ( $campaign instanceof FabrickError ) {
        echo 'updateCampaign() failed!' . PHP_EOL;
        var_dump( $campaign );
        die();
    }
    else {
        echo 'updateCampaign() success!' . PHP_EOL;
    }

    //getCampaignAmount
    $campaignId = $campaign->campaignId;
    $campaignAmount = $client->getCampaignAmount( $campaignId );
    if ( $campaignAmount instanceof FabrickError ) {
        echo 'getCampaignAmount() failed!' . PHP_EOL;
        var_dump( $campaignAmount );
        die();
    }
    else {
        echo 'getCampaignAmount() success!' . PHP_EOL;
    }

    //getCampaignInvestors
    /*
    $campaignId = $campaign->campaignId;
    $campaignInvestors = $client->getCampaignInvestors( $campaignId );
    if ( $campaignInvestors instanceof FabrickError ) {
        echo 'getCampaignInvestors() failed!' . PHP_EOL;
        var_dump( $campaignInvestors );
        die();
    }
    else {
        echo 'getCampaignInvestors() success!' . PHP_EOL;
    }
    */

    //getCampaignOrders
    /*
    $campaignId = $campaign->campaignId;
    $campaignOrders = $client->getCampaignOrders( $campaignId );
    if ( $campaignOrders instanceof FabrickError ) {
        echo 'getCampaignOrders() failed!' . PHP_EOL;
        var_dump( $campaignOrders );
        die();
    }
    else {
        echo 'getCampaignOrders() success!' . PHP_EOL;
    }
    */

    //setCampaignOpen
    $campaignId = $campaign->campaignId;
    $campaign = $client->setCampaignOpen( $campaignId );
    if ( $campaign instanceof FabrickError ) {
        echo 'setCampaignOpen() failed!' . PHP_EOL;
        var_dump( $campaign );
        die();
    }
    else {
        echo 'setCampaignOpen() success!' . PHP_EOL;
    }

    //setCampaignClosed
    $campaignId = $campaign->campaignId;
    $campaign = $client->setCampaignClosed( $campaignId );
    if ( $campaign instanceof FabrickError ) {
        echo 'setCampaignClosed() failed!' . PHP_EOL;
        var_dump( $campaign );
        die();
    }
    else {
        echo 'setCampaignClosed() success!' . PHP_EOL;
    }

    //setCampaignCancelled
    /*
    $campaignId = $campaign->campaignId;
    $campaign = $client->setCampaignCancelled( $campaignId );
    if ( $campaign instanceof FabrickError ) {
        echo 'setCampaignCancelled() failed!' . PHP_EOL;
        var_dump( $campaign );
        die();
    }
    else {
        echo 'setCampaignCancelled() success!' . PHP_EOL;
    }
    */

    //setCampaignSuccess
    //TODO

    //setCampaignFailure
    /*
    $campaignId = $campaign->campaignId;
    $campaign = $client->setCampaignFailure( $campaignId );
    if ( $campaign instanceof FabrickError ) {
        echo 'setCampaignFailure() failed!' . PHP_EOL;
        var_dump( $campaign );
        die();
    }
    else {
        echo 'setCampaignFailure() success!' . PHP_EOL;
    }
    */
}
else {
    echo 'Campaign section skipped!' . PHP_EOL;
}

if ( $doOrderSection ) {
    echo 'ORDER SECTION' . PHP_EOL;

    //createOrder

    //searchOrders

    //getOrder

    //setOrderWaiting

    //setOrderFailed

    //setOrderCancelled
}
else {
    echo 'Order section skipped!' . PHP_EOL;
}

if ( $doPaymentSection ) {
    echo 'PAYMENT SECTION' . PHP_EOL;

    //getOrderPayment

    //getOrderPaymentMoneyin

    //getOrderPaymentMoneyout

    //getOrderPaymentRefund
}
else {
    echo 'Payment section skipped!' . PHP_EOL;
}

if ( $doUnidentifiedTransferSection ) {
    echo 'UNIDENTIFIEDTRANSFER SECTION' . PHP_EOL;

    //searchUnidentifiedTransfers
    $unidentifiedTransfers = $client->searchUnidentifiedTransfers();
    if ( $unidentifiedTransfers instanceof FabrickError ) {
        echo 'searchUnidentifiedTransfers() failed!' . PHP_EOL;
        var_dump( $unidentifiedTransfers );
        die();
    }
    else {
        echo 'searchUnidentifiedTransfers() success!' . PHP_EOL;
    }

    //getUnidentifiedTransfer
    if ( count( $unidentifiedTransfers ) > 0 ) {
        $unidentifiedTransferId = end( $unidentifiedTransfers )->unidentifiedTransferId;
        $unidentifiedTransfer = $client->getUnidentifiedTransfer( $unidentifiedTransferId );
        if ( $unidentifiedTransfer instanceof FabrickError ) {
            echo 'getUnidentifiedTransfer() failed!' . PHP_EOL;
            var_dump( $unidentifiedTransfer );
            die();
        }
        else {
            echo 'getUnidentifiedTransfer() success!' . PHP_EOL;
        }
    }
    else {
        echo 'unable to test getUnidentifiedTransfer()' . PHP_EOL;
    }
}
else {
    echo 'UnidentifiedTransfer section skipped!' . PHP_EOL;
}

if ( $doDisputeSection ) {
    echo 'DISPUTE SECTION' . PHP_EOL;

    //searchDisputes
    $disputes = $client->searchDisputes();
    if ( $disputes instanceof FabrickError ) {
        echo 'searchDisputes() failed!' . PHP_EOL;
        var_dump( $disputes );
        die();
    }
    else {
        echo 'searchDisputes() success!' . PHP_EOL;
    }

    //getDispute
    if ( count( $disputes ) > 0 ) {
        $disputeId = end( $disputes )->disputeId;
        $dispute = $client->getDispute( $disputeId );
        if ( $dispute instanceof FabrickError ) {
            echo 'getDispute() failed!' . PHP_EOL;
            var_dump( $dispute );
            die();
        }
        else {
            echo 'getDispute() success!' . PHP_EOL;
        }
    }
    else {
        echo 'unable to test getDispute()' . PHP_EOL;
    }
}
else {
    echo 'Dispute section skipped!' . PHP_EOL;
}

if ( $doTestCase ) {
    echo 'TEST CASE SECTION' . PHP_EOL;

    //getCompanies
    $companies = $client->getCompanies();
    if ( $companies instanceof FabrickError ) {
        echo 'getCompanies() failed!' . PHP_EOL;
        var_dump( $companies );
        die();
    }
    else {
        $companyId = end( $companies )->companyId;
        echo 'getCompanies() success!' . PHP_EOL;
        echo 'companyId: ' . $companyId . PHP_EOL;
    }

    //createInvestor
    $investor = $client->createInvestor(
        genRandomString(),
        genRandomString(),
        '',
        genRandomNumber(),
        'NATURAL_PERSON',
        'ADDRESS',
        '00100',
        'ROMA',
        'ITALIA',
        'surname.name@test.it',
        '+3902123456789'
    );
    if ( $investor instanceof FabrickError ) {
        echo 'createInvestor() failed!' . PHP_EOL;
        var_dump( $investor );
        die();
    }
    else {
        $investorId = $investor->investorId;
        echo 'createInvestor() success!' . PHP_EOL;
        echo 'investorId: ' . $investorId . PHP_EOL;
    }    

    //createCampaign
    $campaign = $client->createCampaign(
        $companyId,
        genRandomString(),
        'TEST CAMPAIGN DESCRIPTION',
        100,
        120,
        'EUR',
        '2020-02-28',
        new FabrickPortalSuccessFee(
            '20',
            '0'
        )
    );
    if ( $campaign instanceof FabrickError ) {
        echo 'createCampaign() failed!' . PHP_EOL;
        var_dump( $campaign );
        die();
    }
    else {
        $campaignId = $campaign->campaignId;
        echo 'createCampaign() success!' . PHP_EOL;
        echo 'campaignId: ' . $campaignId . PHP_EOL;
    }

    //setCampaignOpen
    $campaignOpen = $client->setCampaignOpen( $campaignId );
    if ( $campaignOpen instanceof FabrickError ) {
        echo 'setCampaignOpen() failed!' . PHP_EOL;
        var_dump( $campaignOpen );
        die();
    }
    else {
        echo 'setCampaignOpen() success!' . PHP_EOL;
    }

    //createOrder
    $order = $client->createOrder(
        $investorId,
        $companyId,
        $campaignId,
        new FabrickInvestorAccount(
            $investorIBAN,
            $investor->name,
            $investor->surname,
            $investor->businessName
        ),
        100,
        100,
        0,
        'EUR',
        'MONEY_TRANSFER',
        'ORDER DESCRIPTION',
        '1',
        date( 'c' ),
        '1',
        '1',
        '1'
    );
    if ( $order instanceof FabrickError ) {
        echo 'createOrder() failed!' . PHP_EOL;
        var_dump( $order );
        die();
    }
    else {
        $orderId = $order->orderId;
        echo 'createOrder() success!' . PHP_EOL;
        echo 'orderId: ' . $orderId . PHP_EOL;
    }

    //setOrderWaiting()
    $orderWaiting = $client->setOrderWaiting( $orderId );
    if ( $orderWaiting instanceof FabrickError ) {
        echo 'setOrderWaiting() failed!' . PHP_EOL;
        var_dump( $orderWaiting );
        die();
    }
    else {
        echo 'setOrderWaiting() success!' . PHP_EOL;
    }
    
    //getCampaignOrders()
    $campaignOrders = $client->getCampaignOrders( $campaignId );
    if ( $campaignOrders instanceof FabrickError ) {
        echo 'getCampaignOrders() failed!' . PHP_EOL;
        var_dump( $campaignOrders );
        die();
    }
    else {
        echo 'getCampaignOrders() success!' . PHP_EOL;
    }

    //getCampaignInvestors
    $campaignInvestors = $client->getCampaignInvestors( $campaignId );
    if ( $campaignInvestors instanceof FabrickError ) {
        echo 'getCampaignInvestors() failed!' . PHP_EOL;
        var_dump( $campaignInvestors );
        die();
    }
    else {
        echo 'getCampaignInvestors() success!' . PHP_EOL;
    }

    //getCampaignAmount
    $campaignAmount = $client->getCampaignAmount( $campaignId );
    if ( $campaignAmount instanceof FabrickError ) {
        echo 'getCampaignAmount() failed!' . PHP_EOL;
        var_dump( $campaignAmount );
        die();
    }
    else {
        echo 'getCampaignAmount() success!' . PHP_EOL;
    }

    //getOrderPayment
    $orderPayment = $client->getOrderPayment( $orderId );
    if ( $orderPayment instanceof FabrickError ) {
        echo 'getOrderPayment() failed!' . PHP_EOL;
        var_dump( $orderPayment );
        die();
    }
    else {
        $moneyinId = $orderPayment->moneyinId;
        $moneyoutId = end( $orderPayment->moneyoutIds );
        echo 'getOrderPayment() success!' . PHP_EOL;
    }

    //getOrderPaymentMoneyin
    $moneyIn = $client->getOrderPaymentMoneyin( $moneyinId );
    if ( $moneyIn instanceof FabrickError ) {
        echo 'getOrderPaymentMoneyin() failed!' . PHP_EOL;
        var_dump( $moneyIn );
        die();
    }
    else {
        echo 'getOrderPaymentMoneyin() success!' . PHP_EOL;
    }

    //getOrderPaymentMoneyout
    $moneyOut = $client->getOrderPaymentMoneyout( $moneyoutId );
    if ( $moneyOut instanceof FabrickError ) {
        echo 'getOrderPaymentMoneyout() failed!' . PHP_EOL;
        var_dump( $moneyOut );
        die();
    }
    else {
        echo 'getOrderPaymentMoneyout() success!' . PHP_EOL;
    }

}
else {
    echo 'Test case section skipped!' . PHP_EOL;
}

if ( $doTestCase2 ) {
    echo 'TEST CASE 2 SECTION' . PHP_EOL;

    $campaignId = 'COL200224VHXS183927000301';
    $orderId = 'TRX2020022418393281QI';
    
    //getCampaignOrders()
    $campaignOrders = $client->getCampaignOrders( $campaignId );
    if ( $campaignOrders instanceof FabrickError ) {
        echo 'getCampaignOrders() failed!' . PHP_EOL;
        var_dump( $campaignOrders );
        die();
    }
    else {
        echo 'getCampaignOrders() success!' . PHP_EOL;
    }

    //getCampaignAmount
    $campaignAmount = $client->getCampaignAmount( $campaignId );
    if ( $campaignAmount instanceof FabrickError ) {
        echo 'getCampaignAmount() failed!' . PHP_EOL;
        var_dump( $campaignAmount );
        die();
    }
    else {
        echo 'getCampaignAmount() success!' . PHP_EOL;
    }

    //setCampaignClosed
    $campaignClosed = $client->setCampaignClosed( $campaignId );
    if ( $campaignClosed instanceof FabrickError ) {
        echo 'setCampaignClosed() failed!' . PHP_EOL;
        var_dump( $campaignClosed );
        die();
    }
    else {
        echo 'setCampaignClosed() success!' . PHP_EOL;
    }

    //setCampaignSuccess
    $campaignSuccess = $client->setCampaignSuccess( $campaignId, array( $orderId ) );
    if ( $campaignSuccess instanceof FabrickError ) {
        echo 'setCampaignSuccess() failed!' . PHP_EOL;
        var_dump( $campaignSuccess );
        die();
    }
    else {
        echo 'setCampaignSuccess() success!' . PHP_EOL;
        echo 'companyFunds: ' . $campaignSuccess->amounts->companyFunds . PHP_EOL;
        echo 'portalSuccessFee: ' . $campaignSuccess->amounts->portalSuccessFee . PHP_EOL;
        echo 'portalInvestorFee: ' . $campaignSuccess->amounts->portalInvestorFee . PHP_EOL;
        echo 'investorsRefunds: ' . $campaignSuccess->amounts->investorsRefunds . PHP_EOL;
        echo 'totalCampaignExecuted: ' . $campaignSuccess->amounts->totalCampaignExecuted . PHP_EOL;
        echo 'totalManagedFunds: ' . $campaignSuccess->amounts->totalManagedFunds . PHP_EOL;
    }

}
else {
    echo 'Test case 2 section skipped!' . PHP_EOL;
}

echo 'All tests are succesful!' . PHP_EOL;

function genRandomNumber( $length = 10 ) {
    $nums = '0123456789';

    $out = $nums[mt_rand( 1, strlen( $nums ) -1 )];  

    for ( $p = 0; $p < $length-1; $p++ )
        $out .= $nums[mt_rand( 0, strlen( $nums ) -1 )];
    
    return $out;
}

function genRandomString( $length = 10 ) {
    $chars = 'ABCDEFGHIJKLMNOPQRTSUVWXYZ';

    $out = $chars[mt_rand( 1, strlen( $chars ) -1 )];  

    for ( $p = 0; $p < $length-1; $p++ )
        $out .= $chars[mt_rand( 0, strlen( $chars ) -1 )];
    
    return $out;
}