<?php
//=========================
// 1. Define Dynamic Data
//=========================

// Invoice header data (cbc elements)
$invoiceData = [
    'ProfileID'            => 'reporting:1.0', // BT-23
    'ID'                   => 'SME00010', // BT-1
    'UUID'                 => '8e6000cf-1a98-4174-b3e7-b5d5954bc10d', // KSA-1
    'IssueDate'            => '2022-08-17', // BT-2
    'IssueTime'            => '17:41:08', // KSA-25
    /**
     * For Tax Invoice, code is 388 and subtype is 0100000
     * For Simplified Tax Invoice, code is 388 and subtype is 0200000
     * For tax invoice debit note, code is 383 and subtype is 0100000
     * For simplified debit note, code is 383 and subtype is 0200000
     * For tax invoice credit note, code is 381 and subtype is 0100000
     * For simplified credit note, code is 381 and subtype is 0200000
     * For Prepayment Tax Invoice, code is 386 and subtype is 0100000
     * For Prepayment Simplified Tax Invoice, code is 386 and subtype is 0200000
     */
    'InvoiceTypeCode'      => [
        'value'      => '388', // code
        'attributes' => ['name' => '0200000'] // subtype
    ],
    'Note'                 => [
        'value'      => 'ABC',
        'attributes' => ['languageID' => 'ar']
    ],
    'DocumentCurrencyCode' => 'SAR',
    'TaxCurrencyCode'      => 'SAR'
];

// BillingReference (fixed in this example)
/**
 * The sequential number (Invoice number BT-1) of the original invoice(s) that the credit/debit note is related to.
 * BT-25
 */
$billingReferenceData = [
    'InvoiceDocumentReference' => [
        'cbc:ID' => 'Invoice Number: 354; Invoice Issue Date: 2021-02-10'
    ]
];

// AdditionalDocumentReference(s)
$additionalDocumentReferences = [
    [
        'cbc:ID'   => 'ICV',
        'cbc:UUID' => '10'
    ],
    [
        'cbc:ID' => 'PIH',
        'Attachment' => [
            'cbc:EmbeddedDocumentBinaryObject' => [
                'value'      => 'NWZlY2ViNjZmZmM4NmYzOGQ5NTI3ODZjNmQ2OTZjNzljMmRiYzIzOWRkNGU5MWI0NjcyOWQ3M2EyN2ZiNTdlOQ==',
                'attributes' => ['mimeCode' => 'text/plain']
            ]
        ]
    ]
];

/** Seller Party Identification (Additional ID) is always required, and it can be
 * Commercial Registration Number (CRN)
 * MOMRAH License (MOM)
 * MHRSD License (MLS)
 * 700 Number (700)
 * MISA License (SAG)
 * Other (OTH)
 */

$accountingSupplierParty = [
    'Party' => [
        'PartyIdentification' => [
            'cbc:ID' => [
                'value'      => '1010010000',
                'attributes' => ['schemeID' => 'CRN']
            ]
        ],
        'PostalAddress' => [
            'cbc:StreetName'        => 'الامير سلطان | Prince Sultan',
            'cbc:BuildingNumber'      => '2322',
            'cbc:CitySubdivisionName' => 'المربع | Al-Murabba',
            'cbc:CityName'            => 'الرياض | Riyadh',
            'cbc:PostalZone'          => '23333',
            'Country' => [
                'cbc:IdentificationCode' => 'SA'
            ]
        ],
        'PartyTaxScheme' => [
            'cbc:CompanyID' => '399999999900003',
            'TaxScheme' => [
                'cbc:ID' => 'VAT'
            ]
        ],
        'PartyLegalEntity' => [
            'cbc:RegistrationName' => 'LTD'
        ]
    ]
];


/** Buyer Party Identification (required only for B2B if the buyer is not VAT registered)
 * Tax Identification Number (TIN)
 * Commercial registration number (CRN)
 * MOMRAH license (MOM)
 * MHRSD license (MLS)
 * 700 Number (700)
 * MISA license (SAG)
 * National ID (NAT)
 * GCC ID (GCC)
 * Iqama Number (IQA)
 * Passport ID (PAS)
 * Other ID (OTH)
 */

$accountingCustomerParty = [
    'Party' => [
        'PostalAddress' => [
            'cbc:StreetName'        => 'صلاح الدين | Salah Al-Din',
            'cbc:BuildingNumber'      => '1111',
            'cbc:CitySubdivisionName' => 'المروج | Al-Murooj',
            'cbc:CityName'            => 'الرياض | Riyadh',
            'cbc:PostalZone'          => '12222',
            'Country' => [
                'cbc:IdentificationCode' => 'SA'
            ]
        ],
        'PartyTaxScheme' => [
            'cbc:CompanyID' => '399999999800003',
            'TaxScheme' => [
                'cbc:ID' => 'NAT'
            ]
        ],
        'PartyLegalEntity' => [
            'cbc:RegistrationName' => 'LTD'
        ]
    ]
];

// Delivery data
/** Delivery date contains two fields
 * Actual Delivery Date (Supply Date)
 * Latest Delivery Date (Latest Supply Date) (Only for summary invoices)
 */
$deliveryData = [
    'cbc:ActualDeliveryDate' => '2022-09-07'
    // 'cbc:LatestDeliveryDate' => '2022-09-30',
];


/** PaymentMeans data
 * 10: Cash
 * 20: Cheque
 * 54: Credit Card
 * 55: Debit Card
 */

$paymentMeansData = [
    'cbc:PaymentMeansCode' => '10'
];


/** AllowanceCharge data with two TaxCategory entries
 * Allowance Reason Codes
 * 41: Bonus for works ahead of schedule
 * 42: Other bonus
 * 60: Manufacturer’s consumer discount
 * 62: Due to military status
 * 63: Due to work accident
 * 64: Special agreement
 * 65: Production error discount
 * 66: New outlet discount
 * 67: Sample discount
 * 68: End-of-range discount
 * 70: Incoterm discount
 * 71: Point of sales threshold allowance
 * 88: Material surcharge/deduction
 * 95: Discount
 * 100: Special rebate
 * 102: Fixed long term
 * 103: Temporary
 * 104: Standard
 * 105: Yearly turnover
 */
$allowanceChargeData = [
    'cbc:ChargeIndicator'     => 'false',
    'cbc:AllowanceChargeReasonCode' => '95',
    'cbc:AllowanceChargeReason' => 'discount',
    'cbc:Amount'              => [
        'value'      => '0.00',
        'attributes' => ['currencyID' => 'SAR']
    ],

    // Two TaxCategory elements
    /**
     * S: Standard VAT Value (15%)
     * Z: Zero-rated Goods
     * E: Exempted from VAT
     * O: Not Subject to VAT
     */
    'TaxCategories' => [
        [
            'cbc:ID'      => [
                'value'      => 'S',
                'attributes' => ['schemeID' => 'UN/ECE 5305', 'schemeAgencyID' => '6']
            ],
            'cbc:Percent' => '15',
            'TaxScheme'   => [
                'cbc:ID' => [
                    'value'      => 'VAT',
                    'attributes' => ['schemeID' => 'UN/ECE 5153', 'schemeAgencyID' => '6']
                ]
            ]
        ],
        [
            'cbc:ID'      => [
                'value'      => 'S',
                'attributes' => ['schemeID' => 'UN/ECE 5305', 'schemeAgencyID' => '6']
            ],
            'cbc:Percent' => '15',
            'TaxScheme'   => [
                'cbc:ID' => [
                    'value'      => 'VAT',
                    'attributes' => ['schemeID' => 'UN/ECE 5153', 'schemeAgencyID' => '6']
                ]
            ]
        ]
    ]
];

// TaxTotal data – two separate TaxTotal elements
$taxTotalData = [
    'first' => [
        'cbc:TaxAmount' => [
            'value'      => '30.15',
            'attributes' => ['currencyID' => 'SAR']
        ]
    ],
    'second' => [
        'cbc:TaxAmount' => [
            'value'      => '30.15',
            'attributes' => ['currencyID' => 'SAR']
        ],
        'TaxSubtotal' => [
            'cbc:TaxableAmount' => [
                'value'      => '201.00',
                'attributes' => ['currencyID' => 'SAR']
            ],
            'cbc:TaxAmount' => [
                'value'      => '30.15',
                'attributes' => ['currencyID' => 'SAR']
            ],
            'TaxCategory' => [
                'cbc:ID'      => [
                    'value'      => 'S',
                    'attributes' => ['schemeID' => 'UN/ECE 5305', 'schemeAgencyID' => '6']
                ],
                'cbc:Percent' => '15.00',
                'TaxScheme'   => [
                    'cbc:ID' => [
                        'value'      => 'VAT',
                        'attributes' => ['schemeID' => 'UN/ECE 5153', 'schemeAgencyID' => '6']
                    ]
                ]
            ]
        ]
    ]
];

// LegalMonetaryTotal data
$legalMonetaryTotalData = [
    'cbc:LineExtensionAmount'  => [
        'value'      => '201.00',
        'attributes' => ['currencyID' => 'SAR']
    ],
    'cbc:TaxExclusiveAmount'   => [
        'value'      => '201.00',
        'attributes' => ['currencyID' => 'SAR']
    ],
    'cbc:TaxInclusiveAmount'   => [
        'value'      => '231.15',
        'attributes' => ['currencyID' => 'SAR']
    ],
    'cbc:AllowanceTotalAmount' => [
        'value'      => '0.00',
        'attributes' => ['currencyID' => 'SAR']
    ],
    'cbc:PrepaidAmount'        => [
        'value'      => '0.00',
        'attributes' => ['currencyID' => 'SAR']
    ],
    'cbc:PayableAmount'        => [
        'value'      => '231.15',
        'attributes' => ['currencyID' => 'SAR']
    ]
];

// Invoice Lines (dynamic array)
/**
 * S: Standard VAT Value (15%)
 * Z: Zero-rated Goods
 * E: Exempted from VAT
 * O: Not Subject to VAT
 */
$invoiceLines = [
    [
        'ID' => '1',
        'InvoicedQuantity' => [
            'value'      => '33.000000',
            'attributes' => ['unitCode' => 'PCE']
        ],
        'LineExtensionAmount' => [
            'value'      => '99.00',
            'attributes' => ['currencyID' => 'SAR']
        ],
        'TaxTotal' => [
            'TaxAmount' => [
                'value'      => '14.85',
                'attributes' => ['currencyID' => 'SAR']
            ],
            'RoundingAmount' => [
                'value'      => '113.85',
                'attributes' => ['currencyID' => 'SAR']
            ]
        ],
        'Item' => [
            'cbc:Name' => 'كتاب',
            'ClassifiedTaxCategory' => [
                'cbc:ID'      => 'S',
                'cbc:Percent' => '15.00',
                'TaxScheme'   => [
                    'cbc:ID' => 'VAT'
                ]
            ]
        ],
        'Price' => [
            'PriceAmount' => [
                'value'      => '3.00',
                'attributes' => ['currencyID' => 'SAR']
            ],
            'AllowanceCharge' => [
                'ChargeIndicator'      => 'false',
                'AllowanceChargeReason'=> 'discount',
                'Amount' => [
                    'value'      => '0.00',
                    'attributes' => ['currencyID' => 'SAR']
                ]
            ]
        ]
    ],
    [
        'ID' => '2',
        'InvoicedQuantity' => [
            'value'      => '3.000000',
            'attributes' => ['unitCode' => 'PCE']
        ],
        'LineExtensionAmount' => [
            'value'      => '102.00',
            'attributes' => ['currencyID' => 'SAR']
        ],
        'TaxTotal' => [
            'TaxAmount' => [
                'value'      => '15.30',
                'attributes' => ['currencyID' => 'SAR']
            ],
            'RoundingAmount' => [
                'value'      => '117.30',
                'attributes' => ['currencyID' => 'SAR']
            ]
        ],
        'Item' => [
            'cbc:Name' => 'قلم',
            'ClassifiedTaxCategory' => [
                'cbc:ID'      => 'S',
                'cbc:Percent' => '15.00',
                'TaxScheme'   => [
                    'cbc:ID' => 'VAT'
                ]
            ]
        ],
        'Price' => [
            'PriceAmount' => [
                'value'      => '34.00',
                'attributes' => ['currencyID' => 'SAR']
            ],
            'AllowanceCharge' => [
                'ChargeIndicator'      => 'true',
                'AllowanceChargeReason'=> 'discount',
                'Amount' => [
                    'value'      => '0.00',
                    'attributes' => ['currencyID' => 'SAR']
                ]
            ]
        ]
    ]
];

//=======================================
// 2. Create the DOMDocument and Root Element
//=======================================
$doc = new DOMDocument('1.0', 'UTF-8');
$doc->formatOutput = true;

// Create the root <Invoice> element with default namespace
$invoiceElem = $doc->createElementNS('urn:oasis:names:specification:ubl:schema:xsd:Invoice-2', 'Invoice');
$doc->appendChild($invoiceElem);

// Add additional namespaces
$invoiceElem->setAttribute('xmlns:cac', 'urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2');
$invoiceElem->setAttribute('xmlns:cbc', 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2');
$invoiceElem->setAttribute('xmlns:ext', 'urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2');

//---------------------------------------
// Helper function to append an element with data
//---------------------------------------
function appendElementData($doc, $parent, $tag, $data) {
    if (is_array($data)) {
        $value = isset($data['value']) ? $data['value'] : '';
        $element = $doc->createElement($tag, $value);
        if (isset($data['attributes']) && is_array($data['attributes'])) {
            foreach ($data['attributes'] as $attr => $val) {
                $element->setAttribute($attr, $val);
            }
        }
    } else {
        $element = $doc->createElement($tag, $data);
    }
    $parent->appendChild($element);
    return $element;
}

//=======================================
// 3. Build the XML Structure
//=======================================

// 3.1 Invoice Header Elements (cbc: elements)
foreach ($invoiceData as $tag => $data) {
    appendElementData($doc, $invoiceElem, 'cbc:' . $tag, $data);
}

// 3.2 BillingReference
$billingRef = $doc->createElement('cac:BillingReference');
$invoiceElem->appendChild($billingRef);
$invDocRef = $doc->createElement('cac:InvoiceDocumentReference');
$billingRef->appendChild($invDocRef);
appendElementData($doc, $invDocRef, 'cbc:ID', $billingReferenceData['InvoiceDocumentReference']['cbc:ID']);

// 3.3 AdditionalDocumentReference(s)
foreach ($additionalDocumentReferences as $refData) {
    $addDocRef = $doc->createElement('cac:AdditionalDocumentReference');
    $invoiceElem->appendChild($addDocRef);
    foreach ($refData as $key => $value) {
        if ($key === 'Attachment') {
            $attachment = $doc->createElement('cac:Attachment');
            $addDocRef->appendChild($attachment);
            foreach ($value as $attKey => $attValue) {
                appendElementData($doc, $attachment, 'cbc:' . $attKey, $attValue);
            }
        } else {
            appendElementData($doc, $addDocRef, $key, $value);
        }
    }
}

// 3.4 AccountingSupplierParty
$accSuppPartyElem = $doc->createElement('cac:AccountingSupplierParty');
$invoiceElem->appendChild($accSuppPartyElem);
$partySupp = $doc->createElement('cac:Party');
$accSuppPartyElem->appendChild($partySupp);

// PartyIdentification
if (isset($accountingSupplierParty['Party']['PartyIdentification'])) {
    $partyIdent = $doc->createElement('cac:PartyIdentification');
    $partySupp->appendChild($partyIdent);
    appendElementData($doc, $partyIdent, 'cbc:ID', $accountingSupplierParty['Party']['PartyIdentification']['cbc:ID']);
}

// PostalAddress
if (isset($accountingSupplierParty['Party']['PostalAddress'])) {
    $postalAddr = $doc->createElement('cac:PostalAddress');
    $partySupp->appendChild($postalAddr);
    foreach ($accountingSupplierParty['Party']['PostalAddress'] as $tag => $data) {
        if ($tag === 'Country') {
            $countryElem = $doc->createElement('cac:Country');
            $postalAddr->appendChild($countryElem);
            appendElementData($doc, $countryElem, 'cbc:IdentificationCode', $data['cbc:IdentificationCode']);
        } else {
            appendElementData($doc, $postalAddr, $tag, $data);
        }
    }
}

// PartyTaxScheme
if (isset($accountingSupplierParty['Party']['PartyTaxScheme'])) {
    $partyTax = $doc->createElement('cac:PartyTaxScheme');
    $partySupp->appendChild($partyTax);
    appendElementData($doc, $partyTax, 'cbc:CompanyID', $accountingSupplierParty['Party']['PartyTaxScheme']['cbc:CompanyID']);
    $taxScheme = $doc->createElement('cac:TaxScheme');
    $partyTax->appendChild($taxScheme);
    appendElementData($doc, $taxScheme, 'cbc:ID', $accountingSupplierParty['Party']['PartyTaxScheme']['TaxScheme']['cbc:ID']);
}

// PartyLegalEntity
if (isset($accountingSupplierParty['Party']['PartyLegalEntity'])) {
    $partyLegal = $doc->createElement('cac:PartyLegalEntity');
    $partySupp->appendChild($partyLegal);
    appendElementData($doc, $partyLegal, 'cbc:RegistrationName', $accountingSupplierParty['Party']['PartyLegalEntity']['cbc:RegistrationName']);
}

// 3.5 AccountingCustomerParty
$accCustPartyElem = $doc->createElement('cac:AccountingCustomerParty');
$invoiceElem->appendChild($accCustPartyElem);
$partyCust = $doc->createElement('cac:Party');
$accCustPartyElem->appendChild($partyCust);

// Customer PostalAddress
if (isset($accountingCustomerParty['Party']['PostalAddress'])) {
    $postalAddrCust = $doc->createElement('cac:PostalAddress');
    $partyCust->appendChild($postalAddrCust);
    foreach ($accountingCustomerParty['Party']['PostalAddress'] as $tag => $data) {
        if ($tag === 'Country') {
            $countryCust = $doc->createElement('cac:Country');
            $postalAddrCust->appendChild($countryCust);
            appendElementData($doc, $countryCust, 'cbc:IdentificationCode', $data['cbc:IdentificationCode']);
        } else {
            appendElementData($doc, $postalAddrCust, $tag, $data);
        }
    }
}

// Customer PartyTaxScheme
if (isset($accountingCustomerParty['Party']['PartyTaxScheme'])) {
    $partyTaxCust = $doc->createElement('cac:PartyTaxScheme');
    $partyCust->appendChild($partyTaxCust);
    appendElementData($doc, $partyTaxCust, 'cbc:CompanyID', $accountingCustomerParty['Party']['PartyTaxScheme']['cbc:CompanyID']);
    $taxSchemeCust = $doc->createElement('cac:TaxScheme');
    $partyTaxCust->appendChild($taxSchemeCust);
    appendElementData($doc, $taxSchemeCust, 'cbc:ID', $accountingCustomerParty['Party']['PartyTaxScheme']['TaxScheme']['cbc:ID']);
}

// Customer PartyLegalEntity
if (isset($accountingCustomerParty['Party']['PartyLegalEntity'])) {
    $partyLegalCust = $doc->createElement('cac:PartyLegalEntity');
    $partyCust->appendChild($partyLegalCust);
    appendElementData($doc, $partyLegalCust, 'cbc:RegistrationName', $accountingCustomerParty['Party']['PartyLegalEntity']['cbc:RegistrationName']);
}

// 3.6 Delivery
$deliveryElem = $doc->createElement('cac:Delivery');
$invoiceElem->appendChild($deliveryElem);
foreach ($deliveryData as $tag => $data) {
    appendElementData($doc, $deliveryElem, $tag, $data);
}

// 3.7 PaymentMeans
$paymentMeansElem = $doc->createElement('cac:PaymentMeans');
$invoiceElem->appendChild($paymentMeansElem);
foreach ($paymentMeansData as $tag => $data) {
    appendElementData($doc, $paymentMeansElem, $tag, $data);
}

// 3.8 AllowanceCharge
$allowanceChargeElem = $doc->createElement('cac:AllowanceCharge');
$invoiceElem->appendChild($allowanceChargeElem);
foreach ($allowanceChargeData as $tag => $data) {
    if ($tag === 'TaxCategories') {
        foreach ($data as $taxCatData) {
            $taxCatElem = $doc->createElement('cac:TaxCategory');
            $allowanceChargeElem->appendChild($taxCatElem);
            appendElementData($doc, $taxCatElem, 'cbc:ID', $taxCatData['cbc:ID']);
            appendElementData($doc, $taxCatElem, 'cbc:Percent', $taxCatData['cbc:Percent']);
            $taxSchemeElem = $doc->createElement('cac:TaxScheme');
            $taxCatElem->appendChild($taxSchemeElem);
            appendElementData($doc, $taxSchemeElem, 'cbc:ID', $taxCatData['TaxScheme']['cbc:ID']);
        }
    } else {
        appendElementData($doc, $allowanceChargeElem, $tag, $data);
    }
}

// 3.9 TaxTotal – First instance
$taxTotalElem1 = $doc->createElement('cac:TaxTotal');
$invoiceElem->appendChild($taxTotalElem1);
appendElementData($doc, $taxTotalElem1, 'cbc:TaxAmount', $taxTotalData['first']['cbc:TaxAmount']);

// 3.10 TaxTotal – Second instance with TaxSubtotal
$taxTotalElem2 = $doc->createElement('cac:TaxTotal');
$invoiceElem->appendChild($taxTotalElem2);
appendElementData($doc, $taxTotalElem2, 'cbc:TaxAmount', $taxTotalData['second']['cbc:TaxAmount']);
$taxSubtotalElem = $doc->createElement('cac:TaxSubtotal');
$taxTotalElem2->appendChild($taxSubtotalElem);
appendElementData($doc, $taxSubtotalElem, 'cbc:TaxableAmount', $taxTotalData['second']['TaxSubtotal']['cbc:TaxableAmount']);
appendElementData($doc, $taxSubtotalElem, 'cbc:TaxAmount', $taxTotalData['second']['TaxSubtotal']['cbc:TaxAmount']);
$taxCategoryElem = $doc->createElement('cac:TaxCategory');
$taxSubtotalElem->appendChild($taxCategoryElem);
appendElementData($doc, $taxCategoryElem, 'cbc:ID', $taxTotalData['second']['TaxSubtotal']['TaxCategory']['cbc:ID']);
appendElementData($doc, $taxCategoryElem, 'cbc:Percent', $taxTotalData['second']['TaxSubtotal']['TaxCategory']['cbc:Percent']);
$taxSchemeElem2 = $doc->createElement('cac:TaxScheme');
$taxCategoryElem->appendChild($taxSchemeElem2);
appendElementData($doc, $taxSchemeElem2, 'cbc:ID', $taxTotalData['second']['TaxSubtotal']['TaxCategory']['TaxScheme']['cbc:ID']);

// 3.11 LegalMonetaryTotal
$legalMonetaryTotalElem = $doc->createElement('cac:LegalMonetaryTotal');
$invoiceElem->appendChild($legalMonetaryTotalElem);
foreach ($legalMonetaryTotalData as $tag => $data) {
    appendElementData($doc, $legalMonetaryTotalElem, $tag, $data);
}

// 3.12 InvoiceLines (dynamic)
foreach ($invoiceLines as $line) {
    $invoiceLineElem = $doc->createElement('cac:InvoiceLine');
    $invoiceElem->appendChild($invoiceLineElem);
    
    if (isset($line['ID'])) {
        appendElementData($doc, $invoiceLineElem, 'cbc:ID', $line['ID']);
    }
    if (isset($line['InvoicedQuantity'])) {
        appendElementData($doc, $invoiceLineElem, 'cbc:InvoicedQuantity', $line['InvoicedQuantity']);
    }
    if (isset($line['LineExtensionAmount'])) {
        appendElementData($doc, $invoiceLineElem, 'cbc:LineExtensionAmount', $line['LineExtensionAmount']);
    }
    
    // InvoiceLine TaxTotal
    if (isset($line['TaxTotal'])) {
        $taxTotalLineElem = $doc->createElement('cac:TaxTotal');
        $invoiceLineElem->appendChild($taxTotalLineElem);
        if (isset($line['TaxTotal']['TaxAmount'])) {
            appendElementData($doc, $taxTotalLineElem, 'cbc:TaxAmount', $line['TaxTotal']['TaxAmount']);
        }
        if (isset($line['TaxTotal']['RoundingAmount'])) {
            appendElementData($doc, $taxTotalLineElem, 'cbc:RoundingAmount', $line['TaxTotal']['RoundingAmount']);
        }
    }
    
    // InvoiceLine Item
    if (isset($line['Item'])) {
        $itemElem = $doc->createElement('cac:Item');
        $invoiceLineElem->appendChild($itemElem);
        if (isset($line['Item']['cbc:Name'])) {
            appendElementData($doc, $itemElem, 'cbc:Name', $line['Item']['cbc:Name']);
        }
        if (isset($line['Item']['ClassifiedTaxCategory'])) {
            $ctcElem = $doc->createElement('cac:ClassifiedTaxCategory');
            $itemElem->appendChild($ctcElem);
            appendElementData($doc, $ctcElem, 'cbc:ID', $line['Item']['ClassifiedTaxCategory']['cbc:ID']);
            appendElementData($doc, $ctcElem, 'cbc:Percent', $line['Item']['ClassifiedTaxCategory']['cbc:Percent']);
            $taxSchemeItemElem = $doc->createElement('cac:TaxScheme');
            $ctcElem->appendChild($taxSchemeItemElem);
            appendElementData($doc, $taxSchemeItemElem, 'cbc:ID', $line['Item']['ClassifiedTaxCategory']['TaxScheme']['cbc:ID']);
        }
    }
    
    // InvoiceLine Price
    if (isset($line['Price'])) {
        $priceElem = $doc->createElement('cac:Price');
        $invoiceLineElem->appendChild($priceElem);
        if (isset($line['Price']['PriceAmount'])) {
            appendElementData($doc, $priceElem, 'cbc:PriceAmount', $line['Price']['PriceAmount']);
        }
        if (isset($line['Price']['AllowanceCharge'])) {
            $allowChargeElem = $doc->createElement('cac:AllowanceCharge');
            $priceElem->appendChild($allowChargeElem);
            appendElementData($doc, $allowChargeElem, 'cbc:ChargeIndicator', $line['Price']['AllowanceCharge']['ChargeIndicator']);
            appendElementData($doc, $allowChargeElem, 'cbc:AllowanceChargeReason', $line['Price']['AllowanceCharge']['AllowanceChargeReason']);
            appendElementData($doc, $allowChargeElem, 'cbc:Amount', $line['Price']['AllowanceCharge']['Amount']);
        }
    }
}

//=======================================
// 4. Save the XML to a File
//=======================================
$filename = 'full_invoice.xml';

if ($doc->save($filename)) {
    echo "XML file saved successfully to {$filename}";
} else {
    echo "Error saving XML file.";
}
?>
