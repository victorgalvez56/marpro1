@php
$establishment = $document->establishment;
$supplier = $document->supplier;
//$path_style = app_path('CoreFacturalo'.DIRECTORY_SEPARATOR.'Templates'.DIRECTORY_SEPARATOR.'pdf'.DIRECTORY_SEPARATOR.'style.css');
$tittle = $document->series.'-'.str_pad($document->number, 8, '0', STR_PAD_LEFT);
$is_order_service = $document->series === '101' ? true: false;
@endphp
<html>

<head>
    {{--<title>{{ $tittle }}</title>--}}
    {{--<link href="{{ $path_style }}" rel="stylesheet" />--}}
</head>

<body>
    @if($document->purchase_order_state_id == '06')
    <div class="company_logo_box" style="position: absolute; text-align: center; top:30%;">
        <img src="data:{{mime_content_type(public_path("status_images".DIRECTORY_SEPARATOR."anulado.png"))}};base64, {{base64_encode(file_get_contents(public_path("status_images".DIRECTORY_SEPARATOR."anulado.png")))}}" alt="anulado" class="" style="opacity: 0.6;">
    </div>
    @endif
    <table class="full-width">
        <tr>
            @if(isset($company->logo))
            <td width="20%">
                <div class="company_logo_box">
                    <img src="data:{{mime_content_type(public_path("storage/uploads/logos/{$company->logo}"))}};base64, {{base64_encode(file_get_contents(public_path("storage/uploads/logos/{$company->logo}")))}}" alt="{{$company->name}}" class="company_logo" style="max-width: 150px;">
                </div>
            </td>
            @else
            <td width="20%">
                <img src="{{ asset('logo/logo.jpg') }}" class="company_logo" style="max-width: 150px">
            </td>
            @endif
            <td width="50%" class="pl-3">
                <div class="text-left">
                    <h4 class="">{{ $company->name }}</h4>
                    <h5>{{ 'RUC '.$company->number }}</h5>
                    <h6>
                        {{ ($establishment->address !== '-')? $establishment->address : '' }}
                        {{ ($establishment->department_id !== '-')? '- '.$establishment->department->description : '' }}
                    </h6>

                    @isset($establishment->trade_address)
                    <h6>{{ ($establishment->trade_address !== '-')? 'D. Comercial: '.$establishment->trade_address : '' }}</h6>
                    @endisset
                    <h6>{{ ($establishment->telephone !== '-')? 'Central telefónica: '.$establishment->telephone : '' }}</h6>

                    <h6>{{ 'Email: compras@mineraluren.com.pe' }}</h6>

                    @isset($establishment->web_address)
                    <h6>{{ ($establishment->web_address !== '-')? 'Web: '.$establishment->web_address : '' }}</h6>
                    @endisset

                    @isset($establishment->aditional_information)
                    <h6>{{ ($establishment->aditional_information !== '-')? $establishment->aditional_information : '' }}</h6>
                    @endisset
                </div>
            </td>
            <td width="30%" class="border-box py-4 px-2 text-center">
                @if($is_order_service)
                <h5 class="text-center"> ORDEN DE COMPRA <br> SERVICIOS</h5>
                @else
                <h5 class="text-center"> ORDEN DE COMPRA <br> BIENES</h5>
                @endif
                <h3 class="text-center">{{ $tittle }}</h3>
            </td>
        </tr>
    </table>

    <table class="full-width mt-5">
        <tr>
            <td width="15%">Proveedor:</td>
            <td width="45%">{{ $supplier->name }}</td>
            <td width="18%">Fecha de emisión:</td>
            <td width="15%">{{ $document->date_of_issue->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td>{{ $supplier->identity_document_type->description }}:</td>
            <td>{{ $supplier->number }}</td>
            @if($document->delivery_date)
            <td width="18%">Fecha entrega máx.:</td>
            <td width="15%">{{ $document->delivery_date->format('d/m/Y') }}</td>
            @endif
        </tr>
        @if ($supplier->address !== '')
        <tr>
            <td width="15%" class="align-top">Dirección:</td>
            <td width="25%" class="align-top">
                {{ $supplier->address }}
            </td>
            <!-- @if($document->delivery_date)
            <td width="18%" class="align-top">Fecha de entrega:</td>
            <td width="15%" class="align-top">{{ $document->delivery_date->format('d/m/Y') }}</td>
            @endif -->
        </tr>
        @endif
        @if ($document->shipping_address)
        <tr>
            <td class="align-top">Dir. Envío:</td>
            <td colspan="3">
                {{ $document->shipping_address }}
            </td>
        </tr>
        @endif
        @if ($supplier->telephone)
        <tr>
            <td class="align-top">Teléfono:</td>
            <td colspan="3">
                {{ $supplier->telephone }}
            </td>
        </tr>
        @endif
        @if ($document->payment_method_type)
        <tr>
            <td class="align-top">Forma de pago:</td>
            <td colspan="3">
                {{ $document->payment_method_type->description }}
            </td>
        </tr>
        @endif
        @if($document->sale_opportunity)
        <tr>
            <td class="align-top">O. Venta:</td>
            <td colspan="3">{{ $document->sale_opportunity->number_full }}</td>
        </tr>
        @endif
    </table>

    <table class="full-width ">
        <tr>
            @if ($document->purchase_quote)
            <td width="15%" class="align-top">Cotización: </td>
            <td width="53%">{{ $document->purchase_quote->series.' - '.$document->purchase_quote->number }}</td>
            @endif
            @if ($document->purchase_quotation)
            <td width="18%" class="align-top">Nro. Solicitud: </td>
            <td width="15%">{{ $document->purchase_quotation->series.' - '.$document->purchase_quotation->number }}</td>
            @endif
        </tr>
    </table>

    <!-- <table class="full-width ">
        <tr>
            <td width="15%" class="align-top">Observaciones: </td>
            <td width="85%">{!! $document->terms_condition ? $document->terms_condition: '-' !!}</td>
        </tr>
    </table> -->

    <table class="full-width mt-3">
        @if ($document->description)
        <tr>
            <td width="15%" class="align-top">Descripción: </td>
            <td width="85%" class="align-top">{{ $document->description }}</td>
        </tr>
        @endif
    </table>

    @if ($document->guides)
    <br />
    {{--<strong>Guías:</strong>--}}
    <table>
        @foreach($document->guides as $guide)
        <tr>
            @if(isset($guide->document_type_description))
            <td>{{ $guide->document_type_description }}</td>
            @else
            <td>{{ $guide->document_type_id }}</td>
            @endif
            <td>:</td>
            <td>{{ $guide->number }}</td>
        </tr>
        @endforeach
    </table>
    @endif

    <table class="full-width mt-10 mb-10">
        <thead class="">
            <tr class="bg-grey">
                <th class="border-top-bottom text-left py-2" width="4%">#</th>
                <th class="border-top-bottom text-left py-2" width="12%">Cod. Item</th>
                <th class="border-top-bottom text-left py-2">Descripción</th>
                <th class="border-top-bottom text-right py-2" width="10%">F. Entrega</th>
                <th class="border-top-bottom text-right py-2" width="7%">Cant.</th>
                <th class="border-top-bottom text-right py-2" width="5%">Und</th>
                <th class="border-top-bottom text-right py-2" width="12%">V. Unit</th>
                <!-- <th class="border-top-bottom text-right py-2" width="8%">Dto.</th> -->
                <th class="border-top-bottom text-right py-2" width="12%">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($document->items as $key => $row)
            <tr>
                <td class="text-left align-top">
                    {{$key + 1}}
                </td>
                <td class="text-left align-top">
                    @if($row->item->internal_id)
                    {{ $row->item->internal_id }}
                    @else
                    {{''}}
                    @endif
                </td>
                <td class="text-left">
                    {!!$row->item->description!!} @if (!empty($row->item->presentation)) {!!$row->item->presentation->description!!} @endif
                    @isset($row->item->item_glossary)
                    <br /><span style="font-size: 9px">{!!$row->item->item_glossary !!}</span>
                    @endisset
                    @if($row->attributes)
                    @foreach($row->attributes as $attr)
                    <br /><span style="font-size: 9px">{!! $attr->description !!} : {{ $attr->value }}</span>
                    @endforeach
                    @endif
                    @if($row->discounts)
                    @foreach($row->discounts as $dtos)
                    <br /><span style="font-size: 9px">{{ $dtos->factor * 100 }}% {{$dtos->description }}</span>
                    @endforeach
                    @endif
                </td>
                <td class="text-right align-top">
                    @if($row->delivery_date)
                    {{ $row->delivery_date->format('d/m/Y') }}
                    @else
                    {{$document->delivery_date->format('d/m/Y')}}
                    @endif
                </td>
                <td class="text-right align-top">
                    @if(((int)$row->quantity != $row->quantity))
                    {{ $row->quantity }}
                    @else
                    {{ number_format($row->quantity, 0) }}
                    @endif
                </td>
                @if(isset($row->item->unit_type_symbol))
                <td class="text-right align-top">{{ $row->item->unit_type_symbol }}</td>
                @else
                <td class="text-right align-top">{{ $row->item->unit_type_id }}</td>
                @endif

                <td class="text-right align-top">{{ number_format($row->unit_value, 4) }}</td>
                <!-- <td class="text-right align-top">
                    @if($row->discounts)
                    @php
                    $total_discount_line = 0;
                    foreach ($row->discounts as $disto) {
                    $total_discount_line = $total_discount_line + $disto->amount;
                    }
                    @endphp
                    {{ number_format($total_discount_line, 2) }}
                    @else
                    0
                    @endif
                </td> -->
                <td class="text-right align-top">{{ number_format($row->total_value, 2) }}</td>
            </tr>
            <tr>
                <td colspan="8" class="border-bottom"></td>
            </tr>
            @endforeach
            {{-- @if($document->total_exportation > 0)
            <tr>
                <td colspan="7" class="text-right font-bold">OP. EXPORTACIÓN: {{ $document->currency_type->symbol }}</td>
            <td class="text-right font-bold">{{ number_format($document->total_exportation, 2) }}</td>
            </tr>
            @endif
            @if($document->total_free > 0)
            <tr>
                <td colspan="7" class="text-right font-bold">OP. GRATUITAS: {{ $document->currency_type->symbol }}</td>
                <td class="text-right font-bold">{{ number_format($document->total_free, 2) }}</td>
            </tr>
            @endif
            @if($document->total_unaffected > 0)
            <tr>
                <td colspan="7" class="text-right font-bold">OP. INAFECTAS: {{ $document->currency_type->symbol }}</td>
                <td class="text-right font-bold">{{ number_format($document->total_unaffected, 2) }}</td>
            </tr>
            @endif
            @if($document->total_exonerated > 0)
            <tr>
                <td colspan="7" class="text-right font-bold">OP. EXONERADAS: {{ $document->currency_type->symbol }}</td>
                <td class="text-right font-bold">{{ number_format($document->total_exonerated, 2) }}</td>
            </tr>
            @endif
            @if($document->total_taxed > 0)
            <tr>
                <td colspan="7" class="text-right font-bold">OP. GRAVADAS: {{ $document->currency_type->symbol }}</td>
                <td class="text-right font-bold">{{ number_format($document->total_taxed, 2) }}</td>
            </tr>
            @endif
            @if($document->total_discount > 0)
            <tr>
                <td colspan="7" class="text-right font-bold">{{(($document->total_prepayment > 0) ? 'ANTICIPO':'DESCUENTO TOTAL')}}: {{ $document->currency_type->symbol }}</td>
                <td class="text-right font-bold">{{ number_format($document->total_discount, 2) }}</td>
            </tr>
            @endif
            <tr>
                <td colspan="7" class="text-right font-bold">IGV: {{ $document->currency_type->symbol }}</td>
                <td class="text-right font-bold">{{ number_format($document->total_igv, 2) }}</td>
            </tr>
            <tr>
                <td colspan="7" class="text-right font-bold">TOTAL A PAGAR: {{ $document->currency_type->symbol }}</td>
                <td class="text-right font-bold">{{ number_format($document->total, 2) }}</td>
            </tr> --}}
        </tbody>
    </table>
    <table class="full-width ">
        <tr>
            <td width="15%" class="align-top">Observaciones: </td>
        </tr>
        <tr>
            <td width="85%">{!! $document->terms_condition ? $document->terms_condition: '-' !!}</td>
        </tr>
    </table>
    <table class="full-width">
        <tr>
            {{-- <td width="65%">
            @foreach($document->legends as $row)
                <p>Son: <span class="font-bold">{{ $row->value }} {{ $document->currency_type->description }}</span></p>
            @endforeach
            <br />
            <strong>Información adicional</strong>
            @foreach($document->additional_information as $information)
            <p>{{ $information }}</p>
            @endforeach
            </td> --}}
        </tr>
    </table>
</body>

</html>