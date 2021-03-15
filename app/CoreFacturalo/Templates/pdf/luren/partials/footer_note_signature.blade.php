@php
$path_style = app_path('CoreFacturalo'.DIRECTORY_SEPARATOR.'Templates'.DIRECTORY_SEPARATOR.'pdf'.DIRECTORY_SEPARATOR.'style.css');
@endphp

<head>
    <link href="{{ $path_style }}" rel="stylesheet" />
</head>

<body>
    <table class="full-width mt-10 mb-10">
        <thead class="">
            <!-- <tr class="bg-grey">
                <th class="border-bottom text-center" colspan="8" style="font-size: 17px">COLOCAR EN LAS GUÍAS Y FACTURAS EL NÚMERO DE LA ORDEN DE COMPRA
                </th>
            </tr> -->
        </thead>
        <tbody>

            <tr>
                <td colspan="8" class="py-1"></td>
            </tr>
            <tr>
                <td colspan="7" class="text-right font-bold">OP. GRAVADAS: {{ $document->currency_type->symbol }}</td>
                <td class="text-right font-bold">{{ number_format($document->total_taxed, 2) }}</td>
            </tr>
            <tr>
                <td colspan="7" class="text-right font-bold">IGV: {{ $document->currency_type->symbol }}</td>
                <td class="text-right font-bold">{{ number_format($document->total_igv, 2) }}</td>
            </tr>
            <tr>
                <td colspan="7" class="text-right font-bold">TOTAL A PAGAR: {{ $document->currency_type->symbol }}</td>
                <td class="text-right font-bold">{{ number_format($document->total, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <table class="full-width mt-10 mb-10">
        <thead class="">
            <tr>
                <th class="border-top border-left text-left p-2" colspan="5">
                    <p class="font-xs">NOTA:</p>
                </th>
                <th class="border-top  border-left border-right  text-left p-2" colspan="3">
                    <p class="font-xs">FIRMA(s) AUTORIZADA(s): </p>

                </th>
            </tr>
        </thead>
        <tbody>
            {{-- <tr>
                <td colspan="8" class="py-2" ></td>
            </tr> --}}
            <tr>
                <td colspan="5" class="border-bottom border-left text-left p-2" width="45%">
                    <p class="font-xs">
                        Cualquier consulta enviar correo a <strong>compras@mineraluren.com.pe</strong>
                        <!-- Cuando las compras son al contado deben enviar la factura en original a la brevedad
                    posible.<br>
                    Recepción de materiales e insumos: Se realizará sólo en los Almacenes de Planta y
                    solamente a los encargados de Almacén, de Lunes a Sabado en el horario de 07:15 a
                    15:30 adjuntando la copia CONTROL ADMINISTRATIVO de su Guia de Remisión, Fotocopia
                    de la Orden de Compra y/o Servicios.<br>
                    Se adjunta las "CONDICIONES GENERALES DE CONTRATACION DE BIENES Y SERVICIOS
                    DE {{$company->name}}" relacionada a la presente Orden, la cual
                    debera ser firmada y faxeada al 248-3074. -->
                    </p>
                </td>
                <td class="border-bottom border-left border-right  text-center p-2" width="55%">
                    <div style="text-align: center;">
                        <img src="data:{{mime_content_type(public_path("status_images".DIRECTORY_SEPARATOR ."luren".DIRECTORY_SEPARATOR."firma.png"))}};base64, {{base64_encode(file_get_contents(public_path("status_images".DIRECTORY_SEPARATOR."luren".DIRECTORY_SEPARATOR."firma.png")))}}" alt="firma autorizada" style=" max-width:  230px; max-height: 80px;  width:50%; height:auto;">
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</body>