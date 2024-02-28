<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report 9.1 Form</title>
    <style>
        .page-break {
            page-break-after: always;
        }
        /* @font-face {
            font-family: 'kalpana';
            font-style: normal;
            font-weight: normal;
            src: url({{asset('fonts/Kalpana/Kalpana UNICODE.ttf')}});
        } */
    </style>
    <style>
        *{
          margin:0;
          padding:0;box-sizing:border-box;
          /* font-family: 'kalpana'; */
        }
        .user-timeline-list{
            /* border-left:1px solid */
        }
        .user-timeline-list .single-timeline .badge{
          width:20px;
          height:20px !important;
          border-radius:50% !important;

        }
        h2{
            font-size:12px;
        }
        td,tr,th{
          text-align:left;
          padding:0.1rem !important;
          font-size:12px;
          /* border:1px solid black; */
        }
        .custom-control-primary{
          padding:0.5rem;
        }

        tfoot tr,tfoot tr td{
          height:20px !important;
           /* padding:20px 10px !important; */
           background:#fff;
        }
    </style>
</head>
<body>
    <section  class="mt-1" style="width:70%;margin:0 auto;">
        <table style="margin-bottom:0.2rem;margin-top:1rem;">
            <tr>
                <th>
                    <img
                        src="images/gonoprojatontri.jpg"
                        width="100px"
                        height="80px"
                    >
                </th>
                <th style="text-align:center;text-transform:uppercase;font-weight:bold;font-size:15px;">
                    Government Of the people's Republic of bangladesh national Board of Revenue value added tax return form<br/>
                    [Please read the instruction before filling up this form]
                    <p>[See rule 47(1)]</p>
                </th>
                <th style="border:1px solid black;display:flex;justify-content:center;align-items:center;margin-top:2rem;margin-left:2rem;">Mushak-9.1</th>
            </tr>

        </table>
        {{-- end of report nine point one header  --}}

        {{-- part -1  --}}
        <div class="taxpayer-information" style="margin-bottom:1rem;margin-top:1.3rem;">
            <h2
                style="text-align:center;background:#A9D08E;color:black;text-transform:uppercase;padding:5px;"
            >
                Part-1 : <span>Taxpayer's information</span>
            </h2>
            <div class="taxpayer-information-table">
                <table
                width="100%"
                style="border-collapse:collapse"
                >
                <tr>
                    <th width="2%" style="padding:0.5rem;border:1px solid black">1</th>
                    <th width="36%" style="padding:0.5rem;border:1px solid black">
                    BIN
                    </th>
                    <th width="2%" style="text-align:center;padding:0.5rem;border:1px solid black">
                    :
                    </th>
                    <th width="60%" style="padding:0.5rem;border:1px solid black">
                      {{$entity->bin ?? 0}}
                    </th>
                </tr>
                <tr >
                    <th style="border:1px solid black">2</th>
                    <th style="padding:0.5rem;border:1px solid black">
                    Name of Taxpayer
                    </th>
                    <th style="text-align:center;padding:0.5rem;border:1px solid black">
                    :
                    </th>
                    <th style="padding:0.5rem;border:1px solid black">
                        {{$entity->name ?? 0}}
                    </th>
                    {{-- <td style="padding:0.5rem;border:1px solid black"></td> --}}
                </tr>
                <tr>
                    <th style="padding:0.5rem;border:1px solid black">3</th>
                    <th style="padding:0.5rem;border:1px solid black">
                    Address Of TaxPayer
                    </th>
                    <th style="text-align:center;padding:0.5rem;border:1px solid black">
                    :
                    </th>
                    <th style="padding:0.5rem;border:1px solid black">
                        {{$entity->address ?? 0}}
                    </th>
                    {{-- <td style="padding:0.5rem;border:1px solid black"></td> --}}
                </tr>
                <tr >
                    <th style="padding:0.5rem;border:1px solid black">4</th>
                    <th style="padding:0.5rem;border:1px solid black">
                    Type Of OwnerShip
                    </th>
                    <th style="text-align:center;padding:0.5rem;border:1px solid black">
                    :
                    </th>
                    <th style="padding:0.5rem;border:1px solid black">
                      {{$entity->ownership_type}}
                    </th>
                    {{-- <td style="padding:0.5rem;border:1px solid black"></td> --}}
                </tr>
                <tr>
                    <th style="padding:0.5rem;border:1px solid black">5</th>
                    <th style="padding:0.5rem;border:1px solid black">
                    Economic Activity
                    </th>
                    <th style="text-align:center;padding:0.5rem;border:1px solid black">
                    :
                    </th>
                    <th style="padding:0.5rem;border:1px solid black">
                    Service, Retail/Wholesale Trading, Imports
                    </th>
                    {{-- <td style="padding:0.5rem;border:1px solid black"></td> --}}
                </tr>
                </table>
            </div>
        </div>
        {{-- end of part -1  --}}

        {{-- part-2  --}}
        <table  style="border-collapse:collapse;width:100%" style="margin-bottom:1rem;margin-top:0.5rem">
            <tr  style="text-align:center;background:#A9D08E;color:black;font-size:14px;">
                <th colspan="6" style="text-align:center;padding:1rem 0"> Part-2 : RETURN SUBMISSION DATA</th>
            </tr>
            <tr  style="border:1px solid black">
                <th width="2%" style="padding:0.2rem;border:1px solid black">1</th>
                <th width="60%" style="padding:0.2rem;border:1px solid black">
                Tax Period
                </th>
                <th width="2%" style="text-align:center;padding:10px;border:1px solid black">
                :
                </th>
                <th width="36%" colspan="3" style="padding:10px;border:1px solid black">
                Month January /Year 2022
                </th>
            </tr>
            <tr style="padding:10px;border:1px solid black">
                <th rowspan="4" width="2%" style="padding:0.2rem;border:1px solid black">2</th>
                <th
                rowspan="4" width="60%"
                style="padding-left:1rem;border:1px solid black"
                >
                    Type Of Return <br> [Please select your desired option]
                </th>
                <th width="2%" rowspan="4" style="text-align:center;padding:10px;border:1px solid black">
                :
                </th>
                <td colspan="2"  width="36%" style="padding:10px;text-transform:capitalize;border:1px solid black">
                        A)main/original return (section 64)
                </td>
                <td style="padding:10px;text-transform:capitalize;border:1px solid black">
                    <input type="checkbox" class="custom-control-primary">
                </td>
            </tr>
            <tr style="border:1px solid black">
                <td colspan="2"  width="36%" style="border:1px solid black;padding:10px;"> B)Late Return  (section 65)</td>
                <td style="border:1px solid black;padding:10px;">
                    <input type="checkbox" class="custom-control-primary">
                </td>
            </tr>
            <tr style="border:1px solid black;padding:10px;">
                <td colspan="2"  width="36%" style="border:1px solid black;padding:10px;">
                    C)Amended Return (section 65)</td>
                <td style="border:1px solid black;padding:10px;">
                    <input type="checkbox" class="custom-control-primary">
                </td>
            </tr>
            <tr  style="border:1px solid black;">
                <td  colspan="2"  width="36%" style="border:1px solid black;padding:10px;">
                    D) Full or Additional or Alternative Return (section 67)
                </td>
                <td style="border:1px solid black;padding:10px;">
                    <input type="checkbox" class="custom-control-primary">
                </td>
            </tr>
            <tr style="border:1px solid black;">
                <th width="2%" style="padding:0.2rem;border:1px solid black">3</th>
                <th width="60%" style="padding-left:10px;border:1px solid black">
                  Any Activities in this Tax Period?
                  [if Selected "No" please Fill only the relevant Part]
                </th>
                <th width="2%" style="text-align:center;padding:10px;border:1px solid black">
                :
                </th>
                <th colspan="3"  style="border:1px solid black">
                    <label style="padding:5px;"> <span style="margin-bottom:1rem">Yes</span>  <input type="checkbox" style="margin:10px;" id="right" name="right"></label>
                    <label style="padding:5px;"><span style="margin-bottom:1rem">No</span>  <input type="checkbox" style="margin:10px;" id="right" name="right"></label>
                </th>
                {{-- <td style="padding:10px;border:1px solid black"></td> --}}
            </tr>
            {{-- <tr style="border:1px solid black">
                <th style="padding:10px;border:1px solid black"></th>
                <th style="padding:10px;border:1px solid black"></th>
            </tr> --}}
            <tr style="padding:10px;border:1px solid black">
                <th width="2%" style="padding:0.2rem;border:1px solid black">4</th>
                <th width="60%" style="padding:10px;border:1px solid black">
                Date of Submission
                </th>
                <th width="2%" style="text-align:center;padding:10px;border:1px solid black">
                :
                </th>
                <th width="36%" colspan="3" style="border-collapse:collapse;">
                {{-- 13/03/2022 --}}
                13/03/2022
                    {{-- <table style="border-collapse:collapse;" width="100%">
                        <tr style="border:1px solid black">
                            <td style="border:1px solid black">1</td>
                            <td style="border:1px solid black">2</td>
                            <td style="border:1px solid black">/</td>
                            <td style="border:1px solid black">0</td>
                            <td style="border:1px solid black">3</td>
                            <td style="border:1px solid black">/</td>
                            <td style="border:1px solid black">2</td>
                            <td style="border:1px solid black">0</td>
                            <td style="border:1px solid black">2</td>
                            <td style="border:1px solid black">2 </td>
                        </tr>
                    </table> --}}
                </th>
            </tr>
        </table>
        {{-- end of part-2  --}}

        {{-- part 3  --}}
        <div class="taxpayer-information" style="margin-bottom:0.5rem;margin-top:2rem">
            {{-- <h2
                style="text-align:center;background:#A9D08E;color:black;padding:5px 0;width:100%"
                class="text-uppercase"
            >
                Part-3 : <span>SUPPLY-OUTPUT TAX</span>
            </h2> --}}
            <table width="100%"  style="border-collapse:collapse" >
                <tr style="text-align:center;background:#A9D08E;color:black;font-size:14px;">
                    <th colspan="6" style="text-align:center;padding:1rem 0">
                        Part-3 : <span>SUPPLY-OUTPUT TAX</span>
                    </th>
                </tr>
                <tr style="background:#BDD7EE;">
                    <th
                    colspan="2"
                    style="text-align:center;border:1px solid black"
                    width="40%"
                    >Nature of Supply</th>
                    <th style="text-align:center;border:1px solid black">
                    Note
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    Value (a)
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    SD(b)
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    VAT(c)
                    </th>
                    {{-- <th style="text-align:center;border:1px solid black">
                    Action
                    </th> --}}
                </tr>
                <tr style="border:1px solid black">
                    <th
                    style="padding-left:10px;border:1px solid black"
                    rowspan="2"
                    >
                    Zero Rated Goods/Service
                    </th>
                    <th  style="padding-left:10px;border:1px solid black">Direct Export</th>
                    <th  style="padding-left:10px;border:1px solid black">1</th>
                    <th  style="padding-left:10px;border:1px solid black">{{$zeroSellsInternationalTaxesValueSum}}</th>
                    <th style="text-align:center;background:#E7E6E6;border:1px solid black"></th>
                    <th style="text-align:center;background:#E7E6E6;border:1px solid black"></th>
                    <th style="text-align:center;border:1px solid black">
                    <a >Sub-form</a>
                    </th>
                </tr>
                <tr  style="border:1px solid black">
                    <th style="padding-left:10px;border:1px solid black">Deemed Export</th>
                    <th style="padding-left:10px;border:1px solid black;text-align:center"> 2</th>
                    <th style="padding-left:10px;border:1px solid black">{{$zeroSellsLocalTaxesValueSum}}</th>
                    <th style="text-align:center;background:#E7E6E6;border:1px solid black"></th>
                    <th style="text-align:center;background:#E7E6E6;border:1px solid black"></th>
                    <th style="text-align:center;border:1px solid black">
                    <a>Sub-form</a>
                    </th>
                </tr>
                <tr  style="border:1px solid black">
                    <th
                    colspan="2"
                    style="padding-left:1rem;border:1px solid black"
                    >
                    Exempted Goods/Service
                    </th>
                    <th style="border:1px solid black">3</th>
                    <th style="border:1px solid black">{{$exemptedRatedSellsTaxesValueSum}}</th>
                    <th style="text-align:center;background:#E7E6E6;border:1px solid black"></th>
                    <th style="text-align:center;background:#E7E6E6;border:1px solid black"></th>
                    <th style="text-align:center;border:1px solid black">
                    <a>Sub-form</a>
                    </th>
                </tr>
                <tr  style="padding-left:1rem;border:1px solid black">
                    <th
                    colspan="2"
                    style="padding-left:1rem;border:1px solid black"
                    >
                    Standard Rated Goods/Service
                    </th>
                    <th style="padding-left:1rem;border:1px solid black">4</th>
                    <th style="padding-left:1rem;border:1px solid black">{{$standardRatedSellsTaxesValueSum}}</th>
                    <th style="padding-left:1rem;border:1px solid black">{{$standardRatedSellsSDSum}}</th>
                    <th style="padding-left:1rem;border:1px solid black">{{$standardRatedSellsTaxSum}}</th>
                    <th style="text-align:center;border:1px solid black">
                       <a>Sub-form</a>
                    </th>
                </tr>
                <tr  style="padding-left:1rem;border:1px solid black">
                    <th
                    colspan="2"
                    style="padding-left:1rem;border:1px solid black"
                    >
                    <p>Goods Based on MRP</p>
                    </th>
                    <th style="padding-left:1rem;border:1px solid black">5</th>
                    <th style="padding-left:1rem;border:1px solid black">0.00</th>
                    <th style="padding-left:1rem;border:1px solid black">0.00</th>
                    <th style="padding-left:1rem;border:1px solid black">0.00</th>
                    <th style="text-align:center;border:1px solid black">
                       <a>Sub-form</a>
                    </th>
                </tr>
                <tr style="border:1px solid black">
                    <th
                    colspan="2"
                    style="padding-left:1rem;border:1px solid black"
                    >
                    <p>Goods/Service Based on Specific VAT</p>
                    </th>
                    <th style="padding-left:1rem;border:1px solid black">6</th>
                    <th style="padding-left:1rem;border:1px solid black">0.00</th>
                    <th style="padding-left:1rem;border:1px solid black">0.00</th>
                    <th style="padding-left:1rem;border:1px solid black">0.00</th>
                    <th style="text-align:center;border:1px solid black">
                    <a>Sub-form</a>
                    </th>
                </tr>
                <tr  style="border:1px solid black">
                    <th
                    colspan="2"
                    style="padding-left:1rem;border:1px solid black"
                    >
                    <p>Goods/Service Other than Standard Vat</p>
                    </th>
                    <th style="padding-left:1rem;border:1px solid black">7</th>
                    <th style="padding-left:1rem;border:1px solid black">{{ $nonStandardRatedSellsTaxesValueSum}}</th>
                    <th style="padding-left:1rem;border:1px solid black">{{$nonStandardRatedSellsSDSum}}</th>
                    <th style="padding-left:1rem;border:1px solid black">{{ $nonStandardRatedSellsTaxSum}}</th>
                    <th style="text-align:center;border:1px solid black">
                        <a>Sub-form</a>
                    </th>
                </tr>
                <tr style="border:1px solid black">
                    <th
                    colspan="2"
                    style="padding-left:1rem;border:1px solid black"
                    >
                       <p>Retail/WholeSale/Trade Based Supply</p>
                    </th>
                    <th style="padding-left:1rem;border:1px solid black">8</th>
                    <th style="padding-left:1rem;border:1px solid black">{{$nonStandardRatedSellsTaxesValueSum}}</th>
                    <th style="padding-left:1rem;border:1px solid black">{{$nonStandardRatedSellsSDSum}}</th>
                    <th style="padding-left:1rem;border:1px solid black">{{$nonStandardRatedSellsTaxSum}}</th>
                    <th style="text-align:center;border:1px solid black">
                    <a>Sub-form</a>
                    </th>
                </tr>
                <tr >
                    <th
                    colspan="2"
                    style="padding-left:1rem;border:1px solid black"
                    >
                    <p>Total Sales Value & Total Payable Taxes</p>
                    </th>
                    <th style="border:1px solid black">9</th>
                    <th style="text-align:center;background:#E7E6E6;border:1px solid black">
                      {{$totalSellsTaxableValue}}
                    </th>
                    <th style="text-align:center;background:#E7E6E6;border:1px solid black">
                        {{$totalSellsSDValue}}
                    </th>
                    <th style="text-align:center;background:#E7E6E6;border:1px solid black">
                     {{$totalSellsTaxValue}}
                    </th>
                </tr>
            </table>
        </div>
        {{-- part 3  end  --}}
        <div class="page-break"></div>

        {{-- part-4  --}}
        <div class="taxpayer-information" style="margin-bottom:0.5rem;margin-top:4rem">
            <div style="border:1px solid black">
                <h2
                    style="text-align:center;background:#A9D08E;color:black;padding:5px 0"
                >
                    Part-4 : <span>PURCHASE - INPUT TAX</span>
                </h2>
                <p class="border py-1 pl-1" style="padding:5px 0">
                    1) If all the products/services you supply are standard rated, fill up note 10-20
                </p>
                <p class="border py-1 pl-1" style="padding-bottom:5px">
                    2) All the products/services you supply are not standard rated or input tax credit not taken within stitulated time period under section 46, fill up note 21-22
                </p>
                <p class="border py-1 pl-1" style="padding-top:5px">
                    3) If the product/services you supply consists of both standard rated and non-standard rated then fill up  note 10-20 for the raw material that ware use to produce/supply standard rated goods/services and fill up note 21-22 for the raw materials that ware used to produce/supply non-standard rated goods/services and show the value proportionately in note 10-22 as applicable.
                </p>

            </div>
            <div class="taxpayer-information-table"  style="margin-bottom:0.5rem;">
                <table
                class="table-bordered"
                width="100%"
                style="border:1px solid black;border-collapse:collapse"
                >
                    <tr style="background:#BDD7EE;border:1px solid black">
                        <th
                        colspan="2"
                        style="text-align:center;border:1px solid black"
                        width="40%"
                        >
                        Nature of Purchases
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        Note
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        Value (a)
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        VAT(b)
                        </th>
                        <th
                        width="5%"
                        style="text-align:center;border:1px solid black"
                        >
                        Action
                        </th>
                    </tr>
                    <!-- .single nature  -->
                    <tr  style="border:1px solid black">
                        <th
                        rowspan="2"
                        style="padding-left:1rem;border:1px solid black"
                        >
                        Zero Rated Goods/Service
                        </th>
                        <th style="border:1px solid black">Local Purchase</th>
                        <th style="text-align:center;border:1px solid black">
                        10
                        </th>
                        <th style="text-align:center;border:1px solid black">
                      {{  $zeroPurchaseLocalTaxesValueSum}}
                        </th>
                        <th style="text-align:center;background:#E7E6E6"></th>
                        <th style="text-align:center;border:1px solid black">
                        <a>Sub-form</a>
                        </th>
                    </tr>
                    <tr style="border:1px solid black">
                        <th style="border:1px solid black">import</th>
                        <th style="text-align:center;border:1px solid black">
                        11
                        </th>
                        <th style="text-align:center;border:1px solid black">
                       {{$zeroPurchaseInternationalTaxesValueSum}}
                        </th>
                        <th style="text-align:center; background:#E7E6E6;border:1px solid black"></th>
                        <th style="text-align:center;border:1px solid black">
                        <a>Sub-form</a>
                        </th>
                    </tr>
                    <!-- end of single nature  -->
                    <!-- .single nature  -->
                    <tr style="border:1px solid black">
                        <th
                        style="padding-left:1rem;border:1px solid black"
                        rowspan="2"
                        >
                        Exempted Goods/ Service
                        </th>
                        <th style="border:1px solid black">
                        Local Purchase
                        </th>
                        <th style="text-align:center;border:1px solid black">
                        12
                        </th>
                        <th style="text-align:center;border:1px solid black">
                         {{$exemptedPurchaseInternationalTaxesValueSum}}
                        </th>
                        <th style="text-align:center;background:#E7E6E6;border:1px solid black"></th>
                        <th style="text-align:center;border:1px solid black">
                        <a>Sub-form</a>
                        </th>
                    </tr>
                    <tr style="border:1px solid black">
                        <th style="border:1px solid black">import</th>
                        <th style="text-align:center;border:1px solid black">
                        13
                        </th>
                        <th style="text-align:center;border:1px solid black">
                        {{$exemptedPurchaseInternationalTaxesValueSum}}
                        </th>
                        <th style="text-align:center;background:#E7E6E6;border:1px solid black"></th>
                        <th style="text-align:center;border:1px solid black">
                            <a>Sub-form</a>
                        </th>
                    </tr>
                    <!-- end of single nature  -->
                    <!-- .single nature  -->
                    <tr style="border:1px solid black">
                        <th
                        style="padding-left:1rem;border:1px solid black"
                        rowspan="2"
                        >
                        Standard Rated Goods/Service
                        </th>
                        <th  style="border:1px solid black">Local Purchase</th>
                        <th style="text-align:center;border:1px solid black">
                        14
                        </th>
                        <th style="text-align:center;border:1px solid black">
                       {{$standardPurchaseLocalTaxesValueSum}}
                        </th>
                        <th style="text-align:center;border:1px solid black">
                       {{$standardPurchaseLocalTaxSum}}
                        </th>
                        <th style="text-align:center;border:1px solid black">
                        <a>Sub-form</a>
                        </th>
                    </tr>
                    <tr style="border:1px solid black">
                        <th style="border:1px solid black">import</th>
                        <th style="text-align:center;border:1px solid black">
                        15
                        </th>
                        <th style="text-align:center;border:1px solid black">
                        {{$standardPurchaseInternationalTaxesValueSum}}
                        </th>
                        <th style="text-align:center;border:1px solid black">
                        {{$standardPurchaseInternationalTaxSum}}
                        </th>
                        <th style="text-align:center;border:1px solid black">
                        <a>Sub-form</a>
                        </th>
                    </tr>
                    <!-- end of single nature  -->
                    <!-- .single nature  -->
                    <tr style="border:1px solid black">
                        <th
                        style="padding-left:1rem;border:1px solid black"
                        rowspan="2"
                        >
                        Goods/Service Other than Standard Rate
                        </th>
                        <th style="border:1px solid black">Local Purchase</th>
                        <th style="text-align:center;border:1px solid black">
                        16
                        </th>
                        <th style="text-align:center;border:1px solid black">
                           {{$nonStandardPurchaseLocalTaxesValueSum}}
                        </th>
                        <th style="text-align:center;border:1px solid black">
                          {{$nonStandardPurchaseLocalTaxSum}}
                        </th>
                        <th style="text-align:center;border:1px solid black">
                        <a>Sub-form</a>
                        </th>
                    </tr>
                    <tr style="border:1px solid black">
                        <th style="border:1px solid black">import</th>
                        <th style="text-align:center;border:1px solid black">
                        17
                        </th>
                        <th style="text-align:center;border:1px solid black">
                        {{$nonStandardPurchaseInternationalTaxesValueSum}}
                        </th>
                        <th style="text-align:center;border:1px solid black">
                        {{$nonStandardPurchaseInternationalTaxSum}}
                        </th>
                        <th style="text-align:center;border:1px solid black">
                            <a>Sub-form</a>
                        </th>
                    </tr>
                    <!-- end of single nature  -->
                    <!-- .single nature  -->
                    <tr style="border:1px solid black">
                        <th
                        style="padding-left:1rem;border:1px solid black"
                        >
                        Goods/Service Based on Specific VAT
                        </th>
                        <th style="border:1px solid black">Local Purchase</th>
                        <th style="text-align:center;border:1px solid black">
                        18
                        </th>
                        <th style="text-align:center;border:1px solid black">
                        0.00
                        </th>
                        <th style="text-align:center;border:1px solid black">
                        0.00
                        </th>
                        <th style="text-align:center;border:1px solid black">
                        <a>Sub-form</a>
                        </th>
                    </tr>
                    <!-- .single nature  -->
                    <tr style="border:1px solid black">
                        <th
                        style="padding-left:1rem;border:1px solid black"
                        rowspan="2"
                        >
                        Goods/Service Not Admissible for Credit (Local Purchase)
                        </th>
                        <th style="border:1px solid black">From Turnover Tax Units</th>
                        <th style="text-align:center;border:1px solid black">
                        19
                        </th>
                        <th style="text-align:center;border:1px solid black">
                        0.00
                        </th>
                        <th style="text-align:center;background:#E7E6E6;border:1px solid black"></th>
                        <th style="text-align:center;border:1px solid black">
                        <a>Sub-form</a>
                        </th>
                    </tr>
                    <tr style="border:1px solid black">
                        <th style="border:1px solid black">From Unregistered Entites</th>
                        <th style="text-align:center;border:1px solid black">
                        20
                        </th>
                        <th style="text-align:center;border:1px solid black">
                       {{$unRegisteredPurchaseLocalForNote20TaxesValueSum}}
                        </th>
                        <th style="text-align:center;background:#E7E6E6;border:1px solid black"></th>
                        <th style="text-align:center;border:1px solid black">
                        <a>Sub-form</a>
                        </th>
                    </tr>
                    <!-- end of single nature  -->
                    <!-- .single nature  -->
                    <tr style="border:1px solid black">
                        <th
                        rowspan="2"
                        style="border:1px solid black"
                        >
                        <p>
                            Goods/Service Not Admissible for Credit (Taxpayers who sell only Exempted / Specific VAT <br> and Goods/Service Other than <br> Standard Rate/Credits not taken within stipulated time)
                        </p>
                        </th>
                        <th style="border:1px solid black">Local Purchase</th>
                        <th style="text-align:center;border:1px solid black">
                        21
                        </th>
                        <th style="text-align:center;border:1px solid black">
                        0.00
                        </th>
                        <th style="text-align:center;background:#E7E6E6;border:1px solid black"></th>
                        <th style="text-align:center;border:1px solid black">
                            <a>Sub-form</a>
                        </th>
                    </tr>
                    <tr style="border:1px solid black">
                        <th style="border:1px solid black">import</th>
                        <th style="text-align:center;border:1px solid black">
                        22
                        </th>
                        <th style="text-align:center;background:#E7E6E6;border:1px solid black"></th>
                        <th style="text-align:center;background:#E7E6E6;border:1px solid black"></th>
                        <th style="text-align:center;border:1px solid black">
                            <a>Sub-form</a>
                        </th>
                    </tr>
                    <!-- end of single nature  -->
                    <tr style="border:1px solid black">
                        <th
                        colspan="2"
                        style="text-transform:capitalize;border:1px solid black"
                        >
                        total Input Tax Credit
                        </th>
                        <th style="text-align:center;border:1px solid black">
                        23
                        </th>
                        <th style="text-align:center;background:#E7E6E6;border:1px solid black">
                        {{$totalPurchaseTaxableValue}}
                        </th>
                        <th style="text-align:center;background:#E7E6E6;border:1px solid black">
                            {{$totalPurchaseTaxValue}}
                        </th>
                        <th></th>

                    </tr>
                    <tfoot>
                        <tr style="border:1px solid black">
                        <th
                            colspan="6"
                            style="text-align:center;border:1px solid black;font-size:10px;"
                        >
                            1 এস. আর. ও নং -৩৮৭-আইন/২০১৯/৯০-মূসক, তারিখ: ১১ ডিসেম্বর, ২০১৯ দ্বারা প্রতিস্থাপিত ।
                        </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        {{-- part-4 end  --}}


        {{-- part -5  --}}
        <div class="taxpayer-information" style="margin-bottom:0.5rem;margin-top:3rem">
            {{-- <h2

                class="py-1 text-uppercase"
            >

            </h2> --}}
            <div class="taxpayer-information-table">
                <table
                class="table-bordered"
                width="100%"
                style="border:1px solid black;border-collapse:collapse"
                >
                <tr  style="text-align:center;background:#A9D08E;color:black;padding:5px 0">
                    <th colspan="3"> Part-5 : <span>INCREASING ADJUSTMENTS(VAT)</span></th>
                </tr>
                <tr style="background:#BDD7EE;border:1px solid black">
                    <th

                    style="text-align:center;border:1px solid black"
                    class="py-1 pl-1"
                    width="40%"
                    >Adjustment Details</th>
                    <th
                    width="10%"
                    style="text-align:center;border:1px solid black"
                    >
                    Note
                    </th>
                    <th
                    width="10%"
                    style="text-align:center;border:1px solid black"
                    >
                    Vat Amount
                    </th>
                    {{-- <th width="5%"></th> --}}
                    {{-- <th
                    width="5%"
                    style="text-align:center;border:1px solid black"
                    >
                    Action
                    </th> --}}
                </tr>
                <!-- .single nature  -->
                <tr style="border:1px solid black">
                    <th
                    style="padding-left:1rem;border:1px solid black"
                    >Due to VAT Deducted at source by the supply receiver</th>
                    <th style="text-align:center;border:1px solid black">
                    24
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    -
                    </th>
                    <th style="text-align:center;border:1px solid black">
                        Sub-form
                    </th>
                </tr>
                <!-- end of single nature  -->
                <!-- .single nature  -->
                <tr style="border:1px solid black">
                    <th
                    style="padding-left:1rem;border:1px solid black"
                    >
                    Payment Not Made Through Banking Channel
                    </th>
                    <th style="text-align:center;border:1px solid black">
                       25
                    </th>
                    <th style="text-align:center;border:1px solid black">
                       -
                    </th>
                    <th></th>
                    {{-- <th style="text-align:center;border:1px solid black">
                    <a >Sub-form</a>
                    </th> --}}
                </tr>
                <!-- .single nature  -->
                <!-- .single nature  -->
                <tr style="border:1px solid black">
                    <th
                    style="padding-left:1rem;border:1px solid black"
                    >
                    Issuance of Debit Note
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    26
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    -
                    </th>
                    <th style="text-align:center;border:1px solid black">
                      Sub-form
                    </th>
                    {{-- <th></th> --}}
                </tr>
                <!-- .single nature  -->
                <!-- .single nature  -->
                <tr  rowspan="2" style="border:1px solid black">
                    <th
                    style="padding-left:1rem;border:1px solid black"
                    >
                       Any Other Adjustments (please specify below)<br/>
                      <textarea name="any_other_adjustments" id="any_other_adjustments"></textarea>
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    27
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    00.0
                    </th>
                    {{-- <th></th> --}}
                </tr>
                <!-- .single nature  -->
                <tr  style="border:1px solid black">
                    <th
                    style="padding-left:1rem;border:1px solid black"
                    >
                    Total Increasing Adjustment
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    28
                    </th>
                    <th style="text-align:center;background:#E7E6E6;border:1px solid black">
                    00.0
                    </th>
                    {{-- <th></th> --}}
                </tr>
                <!-- .single nature  -->
                </table>
            </div>
        </div>
        {{-- part -5 end --}}
        <div class="page-break"></div>
        {{-- part-6  --}}
        <div class="taxpayer-information" style="margin-bottom:0.5rem;margin-top:3rem;">
            <h2
                style="text-align:center;background:#A9D08E;color:black;padding:5px 0"
                class="py-1 text-uppercase"
            >
                Part-6 : <span>DECREASING ADJUSTMENTS(VAT)</span>
            </h2>
            <div class="taxpayer-information-table">
                <table
                class="table-bordered"
                width="100%"
                style="border:1px solid black;border-collapse:collapse"
                >
                <tr style="background:#BDD7EE;border:1px solid black">
                    <th
                    style="text-align:center;border:1px solid black"
                    class=" py-1 pl-1"
                    width="40%"
                    >Adjustment Details</th>
                    <th
                    width="10%"
                    style="text-align:center;border:1px solid black"
                    >
                    Note
                    </th>
                    <th
                    width="10%"
                    style="text-align:center;border:1px solid black"
                    >
                    Vat Amount
                    </th>
                    <th
                    width="5%"
                    style="text-align:center;border:1px solid black"
                    >
                    Action
                    </th>
                </tr>
                <!-- .single nature  -->
                <tr style="border:1px solid black">
                    <th
                    style="padding-left:1rem;border:1px solid black"
                    >Due to VAT Deducted at source from the supplies delivered</th>
                    <th style="text-align:center;border:1px solid black">
                    29
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    45,000
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    <a >Sub-form</a>
                    </th>
                </tr>
                <!-- end of single nature  -->
                <!-- .single nature  -->
                <tr style="border:1px solid black">
                    <th
                    style="padding-left:1rem;border:1px solid black"
                    >
                    Advance Tax Paid at Import Stage

                    </th>
                    <th style="text-align:center;border:1px solid black">
                    30
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    -
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    <a >Sub-form</a>
                    </th>
                </tr>
                <!-- .single nature  -->
                <!-- .single nature  -->
                <tr style="border:1px solid black">
                    <th
                    style="padding-left:1rem;border:1px solid black"
                    >
                    Issuance of Credit Note

                    </th>
                    <th style="text-align:center;border:1px solid black">
                    30
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    1,500.00
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    <a>Sub-form</a>
                    </th>
                </tr>
                <!-- .single nature  -->
                <!-- .single nature  -->
                <tr style="border:1px solid black">
                    <th
                    style="padding-left:1rem;border:1px solid black"
                    >
                    Any Other Adjustments (please specify below)
                    <p><textarea name="any_other_adjustments_decreasing" id="any_other_adjustments_decreasing"></textarea></p>
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    32
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    -
                    </th>
                </tr>
                <!-- .single nature  -->
                <tr style="border:1px solid black">
                    <th
                    style="padding-left:1rem;border:1px solid black"
                    >
                    Total Decreasing Adjustment
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    33
                    </th>
                    <th style="text-align:center;background:#E7E6E6;border:1px solid black">
                    451,500.00
                    </th>
                </tr>
                <!-- .single nature  -->
                </table>
            </div>
        </div>
        {{-- part-6  --}}


        {{-- part-7  --}}
        <div class="taxpayer-information" style="margin-bottom:0.5rem;margin-top:2rem">
            <h2
                style="text-align:center;background:#A9D08E;color:black;padding:5px 0"
                class="py-1 text-uppercase"
            >
                Part-7 : <span>NET TAX CALCULATION</span>
            </h2>
            <div class="taxpayer-information-table">
                <table class="table-bordered" width="100%" style="border-collapse:collapse" >
                <tr style="background:#BDD7EE;border:1px solid black">
                    <th
                    style="text-align:center;border:1px solid black"
                    class=" py-1 pl-1"
                    width="40%"
                    >Items</th>
                    <th
                    width="10%"
                    style="text-align:center;border:1px solid black"
                    >
                    Note
                    </th>
                    <th
                    width="10%"
                    style="text-align:center;border:1px solid black"
                    >
                    Amount
                    </th>
                </tr>
                <!-- .single nature  -->
                <tr style="text-align:center;border:1px solid black">
                    <th
                    style="padding-left:1rem;border:1px solid black"
                    >Net Payable VAT for the Tax Period (Section-45) (9C-23B+28-33)</th>
                    <th style="text-align:center;border:1px solid black">
                    34
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    45,000
                    </th>
                </tr>
                <!-- end of single nature  -->
                <!-- .single nature  -->
                <tr style="text-align:center;border:1px solid black">
                    <th
                    style="padding-left:1rem;border:1px solid black"
                    >
                    Net Payable VAT for the Tax Period after Adjustment with Closing Balance and balance of form 18.6 [34-(52+56)]
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    35
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    81,541.05
                    </th>
                </tr>
                <!-- .single nature  -->
                <!-- .single nature  -->
                <tr style="text-align:center;border:1px solid black">
                    <th
                    style="padding-left:1rem;border:1px solid black"
                    >
                    Net Payable Supplementary Duty for the Tax Period (Before adjustment with Closing Balance) [9B+38-(39+40)]
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    36
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    1,500.00
                    </th>
                </tr>
                <!-- .single nature  -->
                <!-- .single nature  -->
                <tr style="text-align:center;border:1px solid black">
                    <th
                    style="padding-left:1rem;border:1px solid black"
                    >
                    Net Payable Supplementary Duty for the Tax Period after Adjusted with Closing Balance and balance of form 18.6 [36-(53+57)]
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    37
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    00000
                    </th>
                </tr>
                <!-- .single nature  -->
                <!-- .single nature  -->
                <tr style="text-align:center;border:1px solid black">
                    <th
                    style="padding-left:1rem;border:1px solid black"
                    >
                    Supplementary Duty Against Issuance of Debit Note
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    38
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    -
                    </th>
                </tr>
                <!-- .single nature  -->
                <!-- .single nature  -->
                <tr style="text-align:center;border:1px solid black">
                    <th
                    style="padding-left:1rem;border:1px solid black"
                    >
                    Supplementary Duty Against Issuance of Credit Note

                    </th>
                    <th style="text-align:center;border:1px solid black">
                    39
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    -
                    </th>
                </tr>
                <!-- .single nature  -->
                <!-- .single nature  -->
                <tr style="text-align:center;border:1px solid black">
                    <th
                    style="padding-left:1rem;border:1px solid black"
                    >
                    Supplementary Duty Paid on Inputs Against Exports
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    40
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    -
                    </th>
                </tr>
                <!-- .single nature  -->
                <!-- .single nature  -->
                <tr style="text-align:center;border:1px solid black">
                    <th
                    style="padding-left:1rem;border:1px solid black"
                    >
                    Interest on Overdue VAT (Based on note 35)
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    41
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    -
                    </th>
                </tr>
                <!-- .single nature  -->
                <!-- .single nature  -->
                <tr style="text-align:center;border:1px solid black">
                    <th
                    style="padding-left:1rem;border:1px solid black"
                    >
                    Interest on Overdue SD (Based on note 37)
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    42
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    -
                    </th>
                </tr>
                <!-- .single nature  -->
                <!-- .single nature  -->
                <tr style="text-align:center;border:1px solid black">
                    <th
                    style="padding-left:1rem;border:1px solid black"
                    >
                    Fine/Penalty for Non-submission of Return
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    43
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    -
                    </th>
                </tr>
                <!-- .single nature  -->
                <!-- .single nature  -->
                <tr style="text-align:center;border:1px solid black">
                    <th
                    style="padding-left:1rem;border:1px solid black"
                    >
                    Other Fine/Penalty/Interest
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    44
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    -
                    </th>
                </tr>
                <!-- .single nature  -->
                <!-- .single nature  -->
                <tr style="text-align:center;border:1px solid black">
                    <th
                    style="padding-left:1rem;border:1px solid black"
                    >Payable Excise Duty</th>
                    <th style="text-align:center;border:1px solid black">
                    45
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    -
                    </th>
                </tr>
                <!-- .single nature  -->
                <!-- .single nature  -->
                <tr style="text-align:center;border:1px solid black">
                    <th
                    style="padding-left:1rem;border:1px solid black"
                    >
                    Payable Development Surcharge
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    46
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    -
                    </th>
                </tr>
                <!-- .single nature  -->
                <!-- .single nature  -->
                <tr style="text-align:center;border:1px solid black">
                    <th
                    style="padding-left:1rem;border:1px solid black"
                    >
                    Payable ICT Development Surcharge

                    </th>
                    <th style="text-align:center;border:1px solid black">
                    47
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    -
                    </th>
                </tr>
                <!-- .single nature  -->
                <!-- .single nature  -->
                <tr style="text-align:center;border:1px solid black">
                    <th
                    style="padding-left:1rem;border:1px solid black"
                    >Payable Health Care Surcharge</th>
                    <th style="text-align:center;border:1px solid black">
                    48
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    -
                    </th>
                </tr>
                <!-- .single nature  -->

                <!-- .single nature  -->
                <tr style="text-align:center;border:1px solid black">
                    <th
                    style="padding-left:1rem;border:1px solid black"
                    >Payable Environmental Protection Surcharge</th>
                    <th style="text-align:center;border:1px solid black">
                    49
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    -
                    </th>
                </tr>
                <!-- .single nature  -->

                <!-- .single nature  -->
                <tr style="text-align:center;border:1px solid black">
                    <th
                    style="padding-left:1rem;border:1px solid black"
                    >Net Payable VAT for treasury deposit (35+41+43+44)</th>
                    <th style="text-align:center;border:1px solid black">
                    50
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    00000
                    </th>
                </tr>
                <!-- .single nature  -->

                <!-- .single nature  -->
                <tr style="text-align:center;border:1px solid black">
                    <th
                    style="padding-left:1rem;border:1px solid black"
                    >Net Payable SD for treasury deposit (37+42)</th>
                    <th style="text-align:center;border:1px solid black">
                    51
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    000
                    </th>
                </tr>
                <!-- .single nature  -->

                <!-- .single nature  -->
                <tr style="text-align:center;border:1px solid black">
                    <th
                    style="padding-left:1rem;border:1px solid black"
                    >Closing Balance of Last Tax Period (VAT)</th>
                    <th style="text-align:center;border:1px solid black">
                    52
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    00000
                    </th>
                </tr>
                <!-- .single nature  -->
                <!-- .single nature  -->
                <tr style="text-align:center;border:1px solid black">
                    <th
                    style="padding-left:1rem;border:1px solid black"
                    >Closing Balance of Last Tax Period (SD)</th>
                    <th style="text-align:center;border:1px solid black">
                    53
                    </th>
                    <th style="text-align:center;border:1px solid black">
                    0000
                    </th>
                </tr>
                <!-- .single nature  -->
                </table>
            </div>
        </div>
        {{-- part-7 end   --}}

        {{-- part-8  --}}
        <div class="taxpayer-information" style="margin-bottom:0.5rem;margin-top:2rem">
            <h2
                style="text-align:center;background:#A9D08E;color:black;padding:5px 0"
                class="py-1 text-uppercase"
            >
                Part-8 : <span>ADJUSTMENT FOR OLD ACCOUNT CURRENT BALANCE</span>
            </h2>
            <div class="taxpayer-information-table">
                <table class="table-bordered" width="100%" style="border-collapse:collapse" >
                    <tr style="background:#BDD7EE;border:1px solid black">
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        Item
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        Note
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                       Amount
                        </th>
                    </tr>
                    <tr style="border:1px solid black">
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        Remaining Balance (VAT) from Mushak 18.6 [Rule 118(5)]
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        54
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        -
                        </th>
                    </tr>
                    <tr style="border:1px solid black">
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        Remaining Balance (SD) from Mushak 18.6 [Rule 118(5)]
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        55
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        Amount
                        </th>
                    </tr>
                    <tr style="border:1px solid black">
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        Decreasing Adjustment for note 54 (up  to 10% of Note 34)
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        56
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        000
                        </th>
                    </tr>
                    <tr style="border:1px solid black">
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        Decreasing Adjustment for note 55 (up  to 10% of Note 36)
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        57
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        000
                        </th>
                    </tr>
                 </table>
            </div>
        </div>
        {{-- part-8 end   --}}
        <div class="page-break"></div>
        {{-- part-9  --}}
        <div class="taxpayer-information" style="margin-bottom:1rem;margin-top:2rem">
            <div class="taxpayer-information-table">
                <table class="table-bordered" width="100%" style="border-collapse:collapse" >
                    <tr  style="text-align:center;background:#A9D08E;color:black;padding:5px 0"
                    class="py-1 text-uppercase">
                        <th colspan="6" style="text-align:center"> Part-9 : <span>ACCOUNT CODE WISE PAYMENT SCHEDULE (TREASURY DEPOSIT)</span></th>
                    </tr>
                    <tr >
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        Items
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        Note
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        Account Code
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                       Amount
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                       Action
                        </th>
                    </tr>
                    <tr style="border:1px solid black">
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                          VAT Deposit for the Current Tax Period
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        58
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        1-1133-0015-0311
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >8295</th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                          <a>Sub-form</a>
                        </th>
                    </tr>
                    <tr style="border:1px solid black">
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                          SD Deposit for the Current Tax Period
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        59
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                          1-1133-0015-0311
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >-</th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                          <a>Sub-form</a>
                        </th>
                    </tr>
                    <tr style="border:1px solid black">
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                          Excise Duty
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        60
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                          1-1133-0015-0311
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >-</th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                          <a>Sub-form</a>
                        </th>
                    </tr>
                    <tr style="border:1px solid black">
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                         Development Surcharge
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        61
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                          1-1133-0015-0311
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >-</th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                          <a>Sub-form</a>
                        </th>
                    </tr>
                    <tr style="border:1px solid black">
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        ICT Development Surcharge
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        62
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                          1-1133-0015-0311
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >-</th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                          <a>Sub-form</a>
                        </th>
                    </tr>
                    <tr style="border:1px solid black">
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                         Health Care Surcharge
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        63
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                          1-1133-0015-0311
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >-</th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                          <a>Sub-form</a>
                        </th>
                    </tr>
                    <tr style="border:1px solid black">
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                         Environmental Protection Surcharge
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        64
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                          1-1133-0015-0311
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >-</th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                          <a>Sub-form</a>
                        </th>
                    </tr>

                 </table>
            </div>
        </div>
        {{-- part-9 end   --}}



        <div class="taxpayer-information" style="margin-bottom:1rem;margin-top:0.5rem">
            <h2
                style="text-align:center;background:#A9D08E;color:black;padding:5px 0"
                class="py-1 text-uppercase"
            >
                Part-10 : <span>CLOASING BALANCE</span>
            </h2>
            <div class="taxpayer-information-table">
                <table class="table-bordered" width="100%" style="border-collapse:collapse" >
                    <tr style="background:#BDD7EE;border:1px solid black">
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        Items
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        Note
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                       Amount
                        </th>
                    </tr>
                    <tr style="border:1px solid black">
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        Closing Balance (VAT) [58-(50+67) + The refund amount not approved]
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        65
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        1,003,679.00
                        </th>
                    </tr>
                    <tr style="border:1px solid black">
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        Closing Balance (SD) [59-(51+68) + The refund amount not approved]
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        66
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        0.00
                        </th>
                    </tr>

                 </table>
            </div>
        </div>
        {{-- part-10 end   --}}

        <div class="taxpayer-information" style="margin-bottom:1rem;margin-top:0.5rem">
            <h2
                style="text-align:center;background:#A9D08E;color:black;padding:5px 0"
                class="py-1 text-uppercase"
            >
                Part-11 : <span>REFUND</span>
            </h2>
            <div class="taxpayer-information-table">
                <table class="table-bordered" width="100%" style="border-collapse:collapse" >
                    <tr style="border:1px solid black">
                        <th rowspan="3" width="30%">
                            <textarea style="width:90%;height:100px;padding:10px;">I am interested to get refund of my closing balance</textarea>
                        </th>
                        <th
                        width="30%"
                        style="text-align:center;border:1px solid black"
                        >
                        Items
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        Note
                        </th>
                        <th
                         width="30%"
                        style="text-align:center;display:flex;justify-content:space-between;align-items:center;"
                        >
                          <p >
                            <label style="padding:10px;" >Yes</label><input type="checkbox" name="refund" /></p>
                          <p >
                            <label style="padding:10px;">No</label><input type="checkbox" name="refund" /></p>
                        </th>
                    </tr>

                    <tr style="border:1px solid black">
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                          Requested Amount for Refund (VAT)
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        67
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        0.00
                        </th>
                    </tr>
                    <tr style="border:1px solid black">
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                          Requested Amount for Refund (SD)
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        68
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        0.00
                        </th>
                    </tr>

                 </table>
            </div>
        </div>
        {{-- part-11 end   --}}

        <div class="taxpayer-information" style="margin-bottom:0.5rem;margin-top:0.5rem">
            <h2
                style="text-align:center;background:#A9D08E;color:black;padding:5px 0"
                class="py-1 text-uppercase"
            >
                Part-12 : <span>DECLARATION</span>
            </h2>
            <div class="taxpayer-information-table">
                <p style="border:1px solid black">I hereby declare that all information provided in this Return Form are complete, true & accurate. In case of any untrue/incomplete statement, I may be subjected to penal action under The Value Added Tax and Supplementary Duty Act, 2012 or any other applicable Act prevailing at present.</p>
                <table class="table-bordered" width="100%" style="border-collapse:collapse" >
                    <tr style="border:1px solid black">

                        <th
                        width="10%"
                        style="border:1px solid black"
                        >
                        Name
                        </th>
                        <th
                        width="10%"
                        style="text-align:center;border:1px solid black"
                        >
                        :
                        </th>
                        <th

                        style="border:1px solid black"
                        >
                            noor alam khan
                        </th>
                    </tr>
                    <tr style="border:1px solid black">

                        <th
                          width="20%"
                        style="border:1px solid black"
                        >
                        Designation
                        </th>
                        <th
                          width="10%"
                          style="text-align:center;border:1px solid black"
                        >
                        :
                        </th>
                        <th

                        style="text-align:center;display:flex;justify-content:space-between;align-items:center;"
                        >
                          Vat expert
                        </th>
                    </tr>
                    <tr style="border:1px solid black">

                        <th
                          width="20%"
                          style="border:1px solid black"
                        >
                        Mobile number
                        </th>
                        <th
                          width="10%"
                          style="text-align:center;border:1px solid black"
                        >
                        :
                        </th>
                        <th

                        style="text-align:center;display:flex;justify-content:space-between;align-items:center;"
                        >
                          01725760300
                        </th>
                    </tr>
                    <tr style="border:1px solid black">

                        <th width="20%" style="border:1px solid black"
                        > National ID/Passport Number</th>
                        <th
                          width="10%"
                          style="text-align:center;border:1px solid black"
                        >:</th>
                        <th>43243424242355334</th>
                    </tr>
                    <tr style="border:1px solid black">
                        <th
                           width="20%"
                           style="border:1px solid black"
                        >
                        Email
                        </th>
                        <th
                          width="10%"
                          style="text-align:center;border:1px solid black">
                        :
                        </th>
                        <th style="border:1px solid black">
                           nooralamkhan@gmail.com
                        </th>
                    </tr>
                    <tr rowspan="2" style="border:1px solid black">
                        <th
                        width="20%"
                        style="text-align:left;border:1px solid black"
                        >
                        Signature <br/>
                        <p>Not required for electronic submission</p>
                        </th>
                        <th
                        width="5%"
                        style="text-align:center;border:1px solid black"
                        >
                        :
                        </th>
                        <th
                        >
                       nooralamkhan@gmail.com
                        </th>
                    </tr>

                 </table>
            </div>
        </div>
        {{-- part-12 end   --}}
    </section>
</body>
</html>
